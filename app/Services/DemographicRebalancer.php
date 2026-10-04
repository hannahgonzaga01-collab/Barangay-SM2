<?php

namespace App\Services;

use App\Models\Resident;
use App\Models\User;

class DemographicRebalancer
{
    public static function rebalanceIfNeeded(): void
    {
        $totalResidents = Resident::count();
        if ($totalResidents < 50) {
            return;
        }

        // Check if rebalance is needed (if households <= 1 or voters <= 15 or students <= 5)
        $householdCount = Resident::where('is_household_head', true)->count();
        $studentCount = Resident::where('is_student', true)->count();

        if ($householdCount > 10 && $studentCount > 50) {
            return; // Already rebalanced!
        }

        self::forceRebalance();
    }

    public static function forceRebalance(): void
    {
        $residents = Resident::orderBy('id')->get();
        if ($residents->isEmpty()) {
            return;
        }

        // 1. REBALANCE STUDENTS
        foreach ($residents as $r) {
            $age = (int)$r->age;
            if ($age === 0 && !empty($r->birthday)) {
                $age = \Carbon\Carbon::parse($r->birthday)->age;
            }

            $isStudent = false;
            if ($age >= 5 && $age <= 17) {
                $isStudent = ($r->id % 10 < 8); // 80% of minors
            } elseif ($age >= 18 && $age <= 22) {
                $isStudent = ($r->id % 10 < 4); // 40% of young adults
            }

            if ($isStudent) {
                $r->is_student = true;
                $r->occupation = 'Student';
                $r->save();
            }
        }

        // 2. REBALANCE REGISTERED VOTERS (~72% of adult residents)
        $adults = Resident::where(function($q) {
            $q->where('age', '>=', 18)
              ->orWhereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= 18');
        })->get();

        foreach ($adults as $idx => $r) {
            $isVoter = ($idx % 10 < 7); // ~70%
            $r->is_voter = $isVoter;
            $r->is_non_voter = !$isVoter;
            $r->voter_status = $isVoter ? 'verified' : 'unregistered';
            if ($isVoter) {
                $r->precinct_no = sprintf("0%03dA", ($idx % 25) + 1);
            }
            $r->save();

            if ($r->user_id) {
                User::where('id', $r->user_id)->update([
                    'is_voter'     => $r->is_voter,
                    'is_non_voter' => $r->is_non_voter,
                    'voter_status' => $r->voter_status,
                    'precinct_no'  => $r->precinct_no,
                ]);
            }
        }

        // 3. REBALANCE PWD (~38 residents)
        Resident::query()->update(['is_pwd' => false]);
        $pwdCandidates = Resident::inRandomOrder()->take(38)->get();
        foreach ($pwdCandidates as $r) {
            $r->update(['is_pwd' => true]);
        }

        // 4. REBALANCE SOLO PARENTS (~42 adults)
        Resident::query()->update(['is_single_parent' => false]);
        $soloCandidates = Resident::where(function($q) {
            $q->where('age', '>=', 21)->where('age', '<=', 58);
        })->inRandomOrder()->take(42)->get();
        foreach ($soloCandidates as $r) {
            $r->update(['is_single_parent' => true]);
        }

        // 5. REBALANCE BED-RIDDEN (~14 seniors & selected PWD)
        Resident::query()->update(['is_bedridden' => false]);
        $bedriddenCandidates = Resident::where(function($q) {
            $q->where('age', '>=', 65)->orWhere('is_pwd', true);
        })->inRandomOrder()->take(14)->get();
        foreach ($bedriddenCandidates as $r) {
            $r->update(['is_bedridden' => true]);
        }

        // 6. AUTO-CLUSTER HOUSEHOLDS (~280 households)
        Resident::query()->update([
            'is_household_head' => false,
            'household_id'      => null,
            'household_head_id' => null,
            'relationship'      => null,
        ]);

        $hhCounter = 1;
        $allAdults = Resident::where('age', '>=', 25)->where('age', '<=', 65)->get();
        $headCountTarget = min(285, (int)($residents->count() / 3.8));
        $heads = $allAdults->shuffle()->take($headCountTarget);

        $otherResidents = Resident::whereNotIn('id', $heads->pluck('id'))->get()->shuffle();
        $otherIndex = 0;
        $totalOthers = $otherResidents->count();

        foreach ($heads as $head) {
            $hhId = sprintf("HH-SM2-%04d", $hhCounter++);
            $head->update([
                'is_household_head' => true,
                'household_id'      => $hhId,
                'household_head_id' => null,
                'relationship'      => 'Household Head',
            ]);

            $familySize = rand(2, 4);
            $relationships = ['Spouse', 'Son', 'Daughter', 'Mother', 'Father', 'Sibling'];
            
            for ($k = 0; $k < $familySize && $otherIndex < $totalOthers; $k++) {
                $member = $otherResidents[$otherIndex++];
                $rel = $relationships[array_rand($relationships)];
                $member->update([
                    'is_household_head' => false,
                    'household_id'      => $hhId,
                    'household_head_id' => $head->id,
                    'relationship'      => $rel,
                ]);
            }
        }
    }
}
