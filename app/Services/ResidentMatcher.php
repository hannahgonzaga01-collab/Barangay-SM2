<?php

namespace App\Services;

use App\Models\Resident;
use Carbon\Carbon;

class ResidentMatcher
{
    /**
     * Find best matching resident in masterlist and compute similarity score.
     */
    public static function match(string $firstName, string $lastName, ?string $birthday = null): array
    {
        $residents = Resident::whereNull('archived_at')->get();

        $bestMatch = null;
        $highestScore = 0;

        $inputFirst = strtolower(trim($firstName));
        $inputLast  = strtolower(trim($lastName));
        $inputFull  = $inputFirst . ' ' . $inputLast;

        foreach ($residents as $resident) {
            $rFirst = strtolower(trim($resident->first_name ?? ''));
            $rLast  = strtolower(trim($resident->last_name ?? ''));
            $rFull  = $rFirst . ' ' . $rLast;

            // 1. First name similarity
            similar_text($inputFirst, $rFirst, $fnPct);
            $fnLev = self::levenshteinSimilarity($inputFirst, $rFirst);
            $fnScore = ($fnPct * 0.6) + ($fnLev * 0.4);

            // 2. Last name similarity
            similar_text($inputLast, $rLast, $lnPct);
            $lnLev = self::levenshteinSimilarity($inputLast, $rLast);
            $lnScore = ($lnPct * 0.6) + ($lnLev * 0.4);

            // 3. Full name similarity
            similar_text($inputFull, $rFull, $fullPct);

            // Soundex / Metaphone phonetic bonus
            $phoneticBonus = 0;
            if (metaphone($inputFirst) === metaphone($rFirst) && !empty($inputFirst)) {
                $phoneticBonus += 5;
            }
            if (metaphone($inputLast) === metaphone($rLast) && !empty($inputLast)) {
                $phoneticBonus += 5;
            }

            $nameScore = min(100, (($fnScore * 0.45) + ($lnScore * 0.45) + ($fullPct * 0.10)) + $phoneticBonus);

            // 4. Birthday similarity
            $bdayScore = 50; // Neutral baseline if no birthday provided
            if (!empty($birthday) && !empty($resident->birthday)) {
                try {
                    $inDate = Carbon::parse($birthday);
                    $rDate  = Carbon::parse($resident->birthday);

                    if ($inDate->isSameDay($rDate)) {
                        $bdayScore = 100;
                    } elseif ($inDate->year === $rDate->year && $inDate->month === $rDate->month) {
                        $bdayScore = 80;
                    } elseif ($inDate->year === $rDate->year) {
                        $bdayScore = 60;
                    } elseif ($inDate->month === $rDate->month && $inDate->day === $rDate->day) {
                        $bdayScore = 70; // Typo in birth year
                    } else {
                        $bdayScore = 20;
                    }
                } catch (\Exception $e) {
                    $bdayScore = 40;
                }
            }

            // Total Weighted Confidence Score
            $totalConfidence = ($nameScore * 0.75) + ($bdayScore * 0.25);
            $totalConfidence = round(min(100, max(0, $totalConfidence)), 1);

            if ($totalConfidence > $highestScore) {
                $highestScore = $totalConfidence;
                $bestMatch = $resident;
            }
        }

        return [
            'matched_resident' => $bestMatch,
            'confidence_score' => $highestScore,
            'is_exact' => $highestScore >= 98.0,
            'confidence_level' => $highestScore >= 85 ? 'High' : ($highestScore >= 65 ? 'Medium' : 'Low'),
        ];
    }

    private static function levenshteinSimilarity(string $s1, string $s2): float
    {
        $l1 = strlen($s1);
        $l2 = strlen($s2);
        if ($l1 === 0 && $l2 === 0) return 100.0;
        if ($l1 === 0 || $l2 === 0) return 0.0;

        $dist = levenshtein($s1, $s2);
        $maxLen = max($l1, $l2);
        return max(0, (1 - ($dist / $maxLen)) * 100);
    }
}
