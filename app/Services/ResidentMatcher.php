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

        $inputFirst = self::normalizeString($firstName);
        $inputLast  = self::normalizeString($lastName);
        $inputFull  = trim($inputFirst . ' ' . $inputLast);

        if (empty($inputFirst) && empty($inputLast)) {
            return self::emptyResult();
        }

        foreach ($residents as $resident) {
            $rFirst = self::normalizeString($resident->first_name ?? '');
            $rLast  = self::normalizeString($resident->last_name ?? '');
            $rFull  = trim($rFirst . ' ' . $rLast);

            if (empty($rFirst) && empty($rLast)) {
                continue;
            }

            // 1. Calculate similarities
            $fnScore   = self::computeStringSimilarity($inputFirst, $rFirst);
            $lnScore   = self::computeStringSimilarity($inputLast, $rLast);
            $fullScore = self::computeStringSimilarity($inputFull, $rFull);

            // SANITY CHECK FOR REAL TYPOS VS TOTALLY DIFFERENT PEOPLE:
            // A legitimate typo candidate in a masterlist must have either:
            // - A close surname (>= 60%) AND plausible first name (>= 40%)
            // - A close first name (>= 75%) AND plausible surname (>= 50%)
            // - A close full name (>= 65%)
            // If the surname is completely different (< 50%) AND full name is completely different (< 50%),
            // they are DIFFERENT individuals entirely. A typo does NOT turn "Silang" into "Rivera" or "Sto.Cristo" into "Manubis"!
            if (($lnScore < 50 && $fullScore < 50) || ($fnScore < 40 && $lnScore < 55)) {
                continue;
            }

            // Weighted name similarity: 45% first name, 45% last name, 10% full name
            $nameScore = ($fnScore * 0.45) + ($lnScore * 0.45) + ($fullScore * 0.10);

            // Bonus for phonetic match (Soundex / Metaphone) ONLY if string similarity is already plausible (>= 60%)
            if ($fnScore >= 60 && !empty($inputFirst) && metaphone($inputFirst) === metaphone($rFirst)) {
                $nameScore += 3;
            }
            if ($lnScore >= 60 && !empty($inputLast) && metaphone($inputLast) === metaphone($rLast)) {
                $nameScore += 3;
            }
            $nameScore = min(100, $nameScore);

            // If name similarity itself is below 50%, reject as candidate
            if ($nameScore < 50) {
                continue;
            }

            // 2. Birthday similarity (ONLY computed if both records have valid birthdays)
            $bdayScore = 0;
            $hasBothBdays = false;

            if (!empty($birthday) && !empty($resident->birthday)) {
                try {
                    $inDate = Carbon::parse($birthday);
                    $rDate  = Carbon::parse($resident->birthday);
                    $hasBothBdays = true;

                    if ($inDate->isSameDay($rDate)) {
                        $bdayScore = 100;
                    } elseif ($inDate->year === $rDate->year && $inDate->month === $rDate->month) {
                        $bdayScore = 75; // Same month and year, likely day typo
                    } elseif ($inDate->month === $rDate->month && $inDate->day === $rDate->day) {
                        $bdayScore = 70; // Typo in birth year (e.g. 2004 vs 2005)
                    } elseif ($inDate->year === $rDate->year) {
                        $bdayScore = 40; // Same year only
                    } else {
                        // Completely different birthdates
                        $bdayScore = 0;
                    }
                } catch (\Exception $e) {
                    $hasBothBdays = false;
                }
            }

            // Total Weighted Confidence Score
            if ($hasBothBdays) {
                if ($bdayScore === 0) {
                    // Penalty for mismatched birth dates when both are provided
                    $totalConfidence = $nameScore * 0.70;
                } else {
                    $totalConfidence = ($nameScore * 0.75) + ($bdayScore * 0.25);
                }
            } else {
                $totalConfidence = $nameScore;
            }

            $totalConfidence = round(min(100, max(0, $totalConfidence)), 1);

            // Only consider it a candidate match if confidence is at least 50%
            if ($totalConfidence >= 50.0 && $totalConfidence > $highestScore) {
                $highestScore = $totalConfidence;
                $bestMatch = $resident;
            }
        }

        // If no candidate achieved >= 50%, return 0% match and null
        if ($highestScore < 50.0 || !$bestMatch) {
            return self::emptyResult();
        }

        return [
            'matched_resident' => $bestMatch,
            'confidence_score' => $highestScore,
            'is_exact' => $highestScore >= 98.0,
            'confidence_level' => $highestScore >= 85 ? 'High' : ($highestScore >= 65 ? 'Medium' : 'Low'),
        ];
    }

    private static function emptyResult(): array
    {
        return [
            'matched_resident' => null,
            'confidence_score' => 0,
            'is_exact' => false,
            'confidence_level' => 'None',
        ];
    }

    private static function normalizeString(?string $str): string
    {
        if (!$str) return '';
        $s = strtolower(trim($str));
        $s = preg_replace('/[.,]/', '', $s);
        $s = preg_replace('/\s+/', ' ', $s);
        return $s;
    }

    private static function computeStringSimilarity(string $s1, string $s2): float
    {
        if ($s1 === '' && $s2 === '') return 100.0;
        if ($s1 === '' || $s2 === '') return 0.0;
        if ($s1 === $s2) return 100.0;

        similar_text($s1, $s2, $pct);
        $lev = self::levenshteinSimilarity($s1, $s2);
        return ($pct * 0.5) + ($lev * 0.5);
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
