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

            // 1. Calculate similarities (0 - 100)
            $fnScore   = self::computeStringSimilarity($inputFirst, $rFirst);
            $lnScore   = self::computeStringSimilarity($inputLast, $rLast);
            $fullScore = self::computeStringSimilarity($inputFull, $rFull);

            // SANITY CHECK: If neither first name nor last name has at least 50% similarity,
            // and full name is < 50%, they are completely different people!
            if ($fnScore < 50 && $lnScore < 50 && $fullScore < 50) {
                continue;
            }

            // Also reject if surname is completely different (< 40%) AND first name is not an exact match (< 90%)
            if ($lnScore < 40 && $fnScore < 90) {
                continue;
            }
            // And reject if first name is completely different (< 40%) AND surname is not an exact match (< 90%)
            if ($fnScore < 40 && $lnScore < 90) {
                continue;
            }

            // Name Score Calculation:
            // - If both First Name and Surname have minor typo (>= 75% similarity each):
            //   Base is ~90% (88% - 96%)
            // - If exact Surname (>= 95%) but different First Name: ~50%
            // - If exact First Name (>= 95%) but different Surname: ~50%
            // - If one is exact (>= 95%) and the other has minor typo (>= 80%): ~90% - 96%
            if ($fnScore >= 75 && $lnScore >= 75) {
                // Both names closely match with minor typo (e.g. Danilo vs Danillo, Ramos vs Ramoz)
                $nameScore = 85 + (($fnScore - 75) / 25 * 7) + (($lnScore - 75) / 25 * 7);
            } elseif ($fnScore >= 95 || $lnScore >= 95) {
                // One name is an exact match (e.g. same surname or same first name)
                $otherScore = ($fnScore >= 95) ? $lnScore : $fnScore;
                $nameScore = 50 + ($otherScore * 0.40);
            } else {
                // Moderate match on both
                $nameScore = ($fnScore * 0.45) + ($lnScore * 0.45) + ($fullScore * 0.10);
            }

            // Phonetic bonus for soundalike spelling
            if ($fnScore >= 60 && !empty($inputFirst) && metaphone($inputFirst) === metaphone($rFirst)) {
                $nameScore += 2;
            }
            if ($lnScore >= 60 && !empty($inputLast) && metaphone($inputLast) === metaphone($rLast)) {
                $nameScore += 2;
            }
            $nameScore = min(100, max(0, $nameScore));

            // 2. Birthday similarity (automatically factored into confidence score)
            $bdayScore = 0;
            $hasBothBdays = false;

            if (!empty($birthday) && !empty($resident->birthday)) {
                try {
                    $inDate = Carbon::parse($birthday);
                    $rDate  = Carbon::parse($resident->birthday);
                    $hasBothBdays = true;

                    if ($inDate->isSameDay($rDate)) {
                        $bdayScore = 100; // Exact birthday match
                    } elseif ($inDate->year === $rDate->year && $inDate->month === $rDate->month) {
                        $bdayScore = 80; // Same month and year, likely day typo
                    } elseif ($inDate->month === $rDate->month && $inDate->day === $rDate->day) {
                        $bdayScore = 75; // Typo in birth year (e.g. 2004 vs 2005)
                    } elseif ($inDate->year === $rDate->year) {
                        $bdayScore = 50; // Same year only
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
                    // Penalty for conflicting birthdates (different individuals)
                    $totalConfidence = $nameScore * 0.75;
                } elseif ($bdayScore === 100) {
                    // Confirmed birthdate match strongly validates the candidate
                    $totalConfidence = min(100, ($nameScore * 0.80) + 20);
                } else {
                    $totalConfidence = ($nameScore * 0.80) + ($bdayScore * 0.20);
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

        // STRICT RULE: Only literal 100% exact names (no typo at all) can be is_exact.
        // Any typo (e.g. 90% match like Millie vs Millae) will be is_exact = false and MUST go through Office Verification.
        $isLiteralExact = $bestMatch && 
            self::normalizeString($bestMatch->first_name) === $inputFirst && 
            self::normalizeString($bestMatch->last_name) === $inputLast;

        return [
            'matched_resident' => $bestMatch,
            'confidence_score' => $highestScore,
            'is_exact' => ($highestScore >= 98.0 && $isLiteralExact),
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
