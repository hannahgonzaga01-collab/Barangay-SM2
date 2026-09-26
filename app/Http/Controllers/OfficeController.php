<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Resident;
use App\Models\DigitalId;
use App\Models\DocumentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Notifications\DocumentRequestStatusUpdated;

use Illuminate\Support\Facades\Mail;
use App\Mail\VoterVerificationMail;
use App\Imports\ResidentsImport;
use Maatwebsite\Excel\Facades\Excel;

class OfficeController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::query();

        if ($request->filled('view')) {
            if ($request->view === 'heads') {
                $query->where('is_household_head', 1);
            } elseif ($request->view === 'no_household') {
                $query->where('is_household_head', 0)->whereNull('household_head_id');
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('resident_code', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$search}%"]);
            });
        }

        $users = $query->whereNull('archived_at')->latest()->get();
        $archivedResidents = Resident::whereNotNull('archived_at')->latest()->get();
        $archivedResidentsCount = $archivedResidents->count();
        $pets = Pet::with('resident')->where('is_archived', false)->get();
        $petCount = $pets->count();
        $archivedPets = Pet::with('resident')->where('is_archived', true)->latest()->get();
        $archivedPetsCount = $archivedPets->count();

        $currentMonth = now()->month;
        $birthdayThisMonth = Resident::whereMonth('birthday', $currentMonth)->get();
        $seniors = Resident::where(function($q) {
            $q->where('is_senior', true)
              ->orWhereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= 60')
              ->orWhere('age', '>=', 60);
        })->get();
        $pwds = Resident::where('is_pwd', true)->get();
        $soloParents = Resident::where('is_single_parent', true)->get();
        $nonVoters = Resident::where('is_non_voter', true)->get();
        $bedridden = Resident::where('is_bedridden', true)->get();
        $households = Resident::where('is_household_head', true)->with('householdMembers')->get();
        $kdbmCount = $users->filter(fn($u) => is_array($u->memberships) && in_array('KDBM', $u->memberships))->count();
        $fourPsCount = $users->filter(fn($u) => is_array($u->memberships) && in_array('4Ps', $u->memberships))->count();
        $anyMembershipCount = $users->filter(fn($u) => is_array($u->memberships) && count($u->memberships) > 0)->count();

        $digitalIdRequests = DigitalId::with('user')
            ->where('status', 'pending')
            ->latest()
            ->get()
            ->map(function ($idReq) {
                // If user relation loaded but has no name, try to find resident by resident_code
                if ($idReq->user && !trim(($idReq->user->first_name ?? '') . ($idReq->user->last_name ?? ''))) {
                    if ($idReq->user->resident_code) {
                        $resident = \App\Models\Resident::where('resident_code', $idReq->user->resident_code)->first();
                        if ($resident) {
                            $idReq->user->first_name = $resident->first_name;
                            $idReq->user->last_name = $resident->last_name;
                        }
                    }
                    // Fallback: use the 'name' column if set
                    if (!trim(($idReq->user->first_name ?? '') . ($idReq->user->last_name ?? ''))) {
                        $parts = explode(' ', trim($idReq->user->name ?? ''));
                        $idReq->user->first_name = $parts[0] ?? '';
                        $idReq->user->last_name = end($parts) ?: '';
                    }
                }
                return $idReq;
            });



        $documentRequests = DocumentRequest::with(['user'])
            ->latest()
            ->get();

        $pendingDocCount = $documentRequests->where('status', 'pending')->count();
        $archivedDocCount = $documentRequests->filter(function ($r) {
            return $r->status === 'released' && $r->updated_at && $r->updated_at < now()->subDays(30);
        })->count();
        $pendingIdCount = $digitalIdRequests->count();
        $pendingVoters = User::where('role', 'resident')
            ->where('voter_status', 'pending')
            ->has('resident')
            ->latest()
            ->get();
        $pendingVotersCount = $pendingVoters->count();
        
        $pendingResidents = \App\Models\Resident::where('verification_status', 'pending')->latest()->get();
        $pendingResidentsCount = $pendingResidents->count();
        
        // Smart Masterlist Verification Requests (Pending account registrations)
        $pendingVerifications = User::where('role', 'resident')
            ->where(function ($q) {
                $q->where('status', 'pending_verification')
                  ->orWhere('status', 'pending')
                  ->orWhere(function ($sub) {
                      $sub->where('voter_status', 'pending')->whereDoesntHave('resident');
                  });
            })
            ->where('status', '!=', 'declined')
            ->latest()
            ->get()
            ->map(function ($u) {
                $match = \App\Services\ResidentMatcher::match(
                    $u->first_name ?: $u->name,
                    $u->last_name ?: '',
                    $u->birthday ? $u->birthday->format('Y-m-d') : null
                );
                $u->matched_resident = $match['matched_resident'];
                $u->confidence_score = $match['confidence_score'];
                $u->confidence_level = $match['confidence_level'];
                $u->move_in_request = \App\Models\DocumentRequest::where('user_id', $u->id)
                    ->whereIn('document_type', ['move_in', 'move-in', 'Move In', 'Move-In'])
                    ->latest()
                    ->first();
                return $u;
            });
        $pendingVerificationsCount = $pendingVerifications->count();

        $totalPending = $pendingDocCount + $pendingIdCount + $pendingVotersCount + $pendingResidentsCount + $pendingVerificationsCount;
        $officeReports = \App\Models\DepartmentReport::where('department', 'Office')->latest()->get();
        $customTemplate = \App\Http\Controllers\DepartmentReportController::getTemplateForDepartment('Office');
        $documentTemplates = \App\Models\DocumentTemplate::getAllKeyed();

        return view('office.index', compact(
            'users',
            'archivedResidents',
            'archivedResidentsCount',
            'pets',
            'petCount',
            'archivedPets',
            'archivedPetsCount',
            'birthdayThisMonth',
            'seniors',
            'pwds',
            'soloParents',
            'nonVoters',
            'bedridden',
            'households',
            'kdbmCount',
            'fourPsCount',
            'anyMembershipCount',
            'digitalIdRequests',

            'documentRequests',
            'documentTemplates',
            'pendingDocCount',
            'archivedDocCount',
            'pendingIdCount',
            'pendingVoters',
            'pendingVotersCount',
            'pendingResidents',
            'pendingResidentsCount',
            'pendingVerifications',
            'pendingVerificationsCount',
            'totalPending',
            'officeReports',
            'customTemplate'
        ));
    }

    public function export(Request $request)
    {
        $filter = $request->query('filter');
        $search = $request->query('search');

        $query = Resident::with('user');

        if ($filter === 'archived') {
            $query->whereNotNull('archived_at');
        } else {
            $query->whereNull('archived_at');
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('resident_code', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$search}%"]);
            });
        }

        if ($filter === 'birthday') {
            $query->whereMonth('birthday', now()->month);
        } elseif ($filter === 'senior') {
            $query->where(function($q) {
                $q->where('is_senior', 1)
                  ->orWhereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= 60')
                  ->orWhere('age', '>=', 60);
            });
        } elseif ($filter === 'pwd') {
            $query->where('is_pwd', 1);
        } elseif ($filter === 'solo') {
            $query->where('is_single_parent', 1);
        } elseif ($filter === 'nonvoter') {
            $query->where('is_non_voter', 1);
        } elseif ($filter === 'bedridden') {
            $query->where('is_bedridden', 1);
        } elseif ($filter === 'heads') {
            $query->where('is_household_head', 1);
        }

        $residents = $query->orderBy('last_name')->orderBy('first_name')->get();

        if ($filter === '4ps') {
            $residents = $residents->filter(fn($r) => is_array($r->memberships) && in_array('4Ps', $r->memberships));
        } elseif ($filter === 'kdbm') {
            $residents = $residents->filter(fn($r) => is_array($r->memberships) && in_array('KDBM', $r->memberships));
        } elseif ($filter === 'any_membership') {
            $residents = $residents->filter(fn($r) => is_array($r->memberships) && count($r->memberships) > 0);
        }

        $filename = 'residents_masterlist_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($residents) {
            $file = fopen('php://output', 'w');
            // Add BOM for UTF-8 compatibility with MS Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // CSV Header
            fputcsv($file, [
                'Resident Code',
                'First Name',
                'Middle Name',
                'Last Name',
                'Suffix',
                'Full Name',
                'Gender',
                'Civil Status',
                'Spouse Name',
                'Birthday',
                'Age',
                'Birthplace',
                'Contact Number',
                'Email Address',
                'Address',
                'Occupation',
                'Voter Status',
                'Senior Citizen',
                'PWD',
                'Solo Parent',
                'Student',
                'Bed-ridden',
                'Household Head',
                'Household ID',
                'Relationship to Head',
                'Memberships',
                'Registered Date'
            ]);

            foreach ($residents as $r) {
                $fullName = trim("{$r->first_name} {$r->middle_name} {$r->last_name} {$r->suffix}");
                $memberships = is_array($r->memberships) ? implode(', ', $r->memberships) : ($r->memberships ?? 'None');

                fputcsv($file, [
                    $r->resident_code ?? 'N/A',
                    $r->first_name ?? '',
                    $r->middle_name ?? '',
                    $r->last_name ?? '',
                    $r->suffix ?? '',
                    $fullName,
                    $r->gender ?? 'N/A',
                    $r->civil_status ?? 'N/A',
                    $r->spouse_name ?? 'N/A',
                    $r->birthday ? \Carbon\Carbon::parse($r->birthday)->format('Y-m-d') : 'N/A',
                    $r->age ?? ($r->birthday ? \Carbon\Carbon::parse($r->birthday)->age : 'N/A'),
                    $r->birthplace ?? 'N/A',
                    $r->contact_number ?? 'N/A',
                    $r->user?->email ?? 'N/A',
                    $r->address ?? 'N/A',
                    $r->occupation ?? 'N/A',
                    $r->is_voter ? 'Voter' : ($r->is_non_voter ? 'Non-Voter' : 'N/A'),
                    $r->is_senior ? 'Yes' : 'No',
                    $r->is_pwd ? 'Yes' : 'No',
                    $r->is_single_parent ? 'Yes' : 'No',
                    $r->is_student ? 'Yes' : 'No',
                    $r->is_bedridden ? 'Yes' : 'No',
                    $r->is_household_head ? 'Yes' : 'No',
                    $r->household_id ?? 'N/A',
                    $r->relationship ?? 'N/A',
                    $memberships ?: 'None',
                    $r->created_at ? $r->created_at->format('Y-m-d H:i:s') : 'N/A',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function generateDigitalId(Request $request, $id)
    {
        $digitalId = DigitalId::findOrFail($id);

        // Format: BSM2-YY-MM-XXX (e.g., BSM2-26-11-008)
        $sequence = str_pad($digitalId->id, 3, '0', STR_PAD_LEFT);
        $idNumber = 'BSM2-' . date('y-m') . '-' . $sequence;

        $digitalId->update([
            'status' => 'generated',
            'id_number' => $idNumber,
        ]);

        return redirect()->back()->with('success', 'Digital ID generated: ' . $idNumber);
    }

    public function approveVoter(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $updateData = ['voter_status' => 'approved'];
        if ($user->is_voter) {
            $updateData['is_non_voter'] = 0;
        } else {
            $updateData['is_voter'] = 0;
            $updateData['is_non_voter'] = 1;
        }

        $user->update($updateData);

        if ($user->resident) {
            $user->resident->update($updateData);
        }

        try {
            Mail::to($user->email)->send(new VoterVerificationMail($user, 'approved'));
        } catch (\Exception $e) {
            \Log::error('Failed to send approve mail: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Voter verification approved.');
    }

    public function declineVoter(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:1000'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'voter_status' => 'declined',
            'decline_reason' => $request->reason,
            'is_voter' => 0,
            'is_non_voter' => 1,
        ]);

        if ($user->resident) {
            $user->resident->update([
                'voter_status' => 'declined',
                'is_voter' => 0,
                'is_non_voter' => 1,
            ]);
        }

        try {
            Mail::to($user->email)->send(new VoterVerificationMail($user, 'declined', $request->reason));
        } catch (\Exception $e) {
            // Log it but do not fail the request
            \Log::error('Failed to send decline mail: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Voter verification declined and email sent.');
    }

    public function generateManualDigitalId(Request $request, $resident_id)
    {
        $resident = Resident::findOrFail($resident_id);

        if (!$resident->user_id) {
            return redirect()->back()->with('error', 'Cannot generate Digital ID. Resident has no online account.');
        }

        $digitalId = DigitalId::where('user_id', $resident->user_id)->first();

        if (!$digitalId) {
            $digitalId = DigitalId::create([
                'user_id' => $resident->user_id,
                'contact_person' => $request->ecName ?? 'N/A',
                'contact_person_number' => $request->ecNum ?? 'N/A',
                'status' => 'generated',
            ]);
        } else {
            $digitalId->update([
                'status' => 'generated',
                'contact_person' => $request->ecName ?? $digitalId->contact_person,
                'contact_person_number' => $request->ecNum ?? $digitalId->contact_person_number,
            ]);
        }

        if (!$digitalId->id_number) {
            $sequence = str_pad($digitalId->id, 3, '0', STR_PAD_LEFT);
            $idNumber = 'BSM2-' . date('y-m') . '-' . $sequence;
            $digitalId->update(['id_number' => $idNumber]);
        } else {
            $idNumber = $digitalId->id_number;
        }

        return redirect()->back()->with('success', 'Digital ID generated: ' . $idNumber);
    }

    public function updateDocumentStatus(Request $request, $id)
    {
        $docRequest = DocumentRequest::with('user')->findOrFail($id);
        
        // Define status ranks for one-way progression
        $ranks = [
            'pending' => 1,
            'processing' => 2,
            'ready' => 3,
            'released' => 4,
        ];

        $currentStatus = $docRequest->status;
        $newStatus = $request->status;
        $disapprovalReason = $request->disapproval_reason;

        // Terminal lock: Once a document request is released or disapproved, it cannot be modified
        if (in_array($currentStatus, ['released', 'disapproved'])) {
            return redirect()->back()->with('error', 'This document request is already ' . ucfirst($currentStatus) . ' and cannot be changed.');
        }

        $currentRank = $ranks[$currentStatus] ?? 0;
        $newRank = $ranks[$newStatus] ?? 0;

        // Strict one-way forward progression
        if ($newStatus !== 'disapproved' && $newRank < $currentRank) {
            return redirect()->back()->with('error', 'Status progression is one-way. Cannot revert to ' . ucfirst($newStatus) . '.');
        }

        $updateData = ['status' => $newStatus];
        if ($newStatus === 'disapproved') {
            $updateData['disapproval_reason'] = $disapprovalReason;
        }

        if ($newStatus === 'ready') {
            $request->validate([
                'pickup_date' => 'required|date',
                'pickup_time' => 'required',
                'personnel_in_charge' => 'required|string|max:255',
                'alternate_personnel' => 'nullable|string|max:255',
            ]);
            $updateData['pickup_date'] = $request->pickup_date;
            $updateData['pickup_time'] = $request->pickup_time;
            $updateData['personnel_in_charge'] = $request->personnel_in_charge;
            $updateData['alternate_personnel'] = !empty(trim($request->alternate_personnel ?? '')) 
                ? trim($request->alternate_personnel) 
                : 'Any available staff (Barangay San Miguel II Hall, Dasmariñas City, Cavite)';
        }

        $docRequest->update($updateData);

        if ($newStatus === 'released' && $docRequest->user) {
            $docRequest->user->notifications()->where('data->document_request_id', $docRequest->id)->delete();
        }

        if ($newStatus === 'released') {
            $docTypeKey = strtolower(str_replace(['-', '_', ' '], '', (string)$docRequest->document_type));

            if ($docTypeKey === 'movein') {
                $this->handleMoveInRelease($docRequest);
            } elseif ($docTypeKey === 'moveout') {
                $this->handleMoveOutRelease($docRequest);
            }
        }

        if ($docRequest->user) {
            try {
                $docRequest->user->notify(new DocumentRequestStatusUpdated($docRequest));
            } catch (\Exception $e) { }
        } elseif (!empty($docRequest->guest_email)) {
            try {
                \Illuminate\Support\Facades\Notification::route('mail', $docRequest->guest_email)
                    ->notify(new DocumentRequestStatusUpdated($docRequest));
            } catch (\Exception $e) { }
        }

        $docTypeKey = strtolower(str_replace(['-', '_', ' '], '', (string)$docRequest->document_type));
        $msg = $newStatus === 'disapproved' 
            ? 'Request disapproved. Reason sent to resident.' 
            : (($newStatus === 'released' && in_array($docTypeKey, ['movein', 'moveout']))
                ? ($docTypeKey === 'movein'
                    ? 'Status updated to Released. Resident has been automatically added to the Masterlist!'
                    : 'Status updated to Released. Resident has been transferred to Archived Residents!')
                : 'Status updated to ' . ucfirst($newStatus) . '. Resident notified.');

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Automatically add or activate resident in Masterlist when Move-In is released.
     */
    protected function handleMoveInRelease(DocumentRequest $docRequest): void
    {
        try {
            $addrParts = [];
            if (!empty($docRequest->blk)) {
                $addrParts[] = 'Blk ' . trim($docRequest->blk);
            }
            if (!empty($docRequest->lot)) {
                $addrParts[] = 'Lot ' . trim($docRequest->lot);
            }
            if (!empty($docRequest->address)) {
                $addrParts[] = trim($docRequest->address);
            }
            $fullAddress = !empty($addrParts)
                ? implode(', ', $addrParts)
                : 'Barangay San Miguel II, Dasmariñas City, Cavite';

            $user = $docRequest->user;
            $resident = null;

            // 1. Try to find existing resident record
            if ($user) {
                if ($user->resident) {
                    $resident = $user->resident;
                } elseif ($user->resident_code) {
                    $resident = Resident::where('resident_code', $user->resident_code)->first();
                } else {
                    $resident = Resident::where('user_id', $user->id)->first();
                }

                if (!$resident && $user->first_name && $user->last_name) {
                    $resident = Resident::where('first_name', $user->first_name)
                        ->where('last_name', $user->last_name)
                        ->first();
                }
            }

            if (!$resident) {
                $fName = $docRequest->guest_first_name ?: $docRequest->claimant_first_name;
                $lName = $docRequest->guest_last_name ?: $docRequest->claimant_last_name;
                if ($fName && $lName) {
                    $resident = Resident::where('first_name', $fName)
                        ->where('last_name', $lName)
                        ->first();
                }
            }

            // 2. If resident exists, unarchive & update address
            if ($resident) {
                $resident->update([
                    'archived_at' => null,
                    'archive_reason' => null,
                    'address' => $fullAddress ?: $resident->address,
                    'user_id' => $user ? $user->id : $resident->user_id,
                    'voter_status' => $resident->voter_status === 'Transferred / Moved Out' ? 'approved' : $resident->voter_status,
                ]);

                if ($user) {
                    $user->update([
                        'status' => 'active',
                        'is_active' => 1,
                        'resident_code' => $resident->resident_code ?: $user->resident_code,
                        'voter_status' => 'approved',
                    ]);
                }
            } else {
                // 3. Create new resident entry in Masterlist
                $code = 'RES-' . strtoupper(Str::random(8));
                $firstName = $user ? ($user->first_name ?: $user->name) : ($docRequest->guest_first_name ?: $docRequest->claimant_first_name ?: 'Resident');
                $lastName = $user ? ($user->last_name ?: '') : ($docRequest->guest_last_name ?: $docRequest->claimant_last_name ?: '');
                $middleName = $user ? $user->middle_name : $docRequest->claimant_middle_name;
                $bday = $docRequest->birthday ?: ($user?->birthday ?? '2000-01-01');
                $age = $docRequest->age ?: ($bday ? \Carbon\Carbon::parse($bday)->age : null);
                $contact = $docRequest->contact ?: $user?->contact_number;

                $resident = Resident::create([
                    'resident_code' => $code,
                    'user_id' => $user?->id,
                    'first_name' => $firstName,
                    'middle_name' => $middleName,
                    'last_name' => $lastName ?: 'Resident',
                    'birthday' => $bday,
                    'age' => $age,
                    'birthplace' => 'N/A',
                    'gender' => $user?->gender ?? 'Prefer not to say',
                    'civil_status' => 'Single',
                    'contact_number' => $contact,
                    'address' => $fullAddress,
                    'is_voter' => $user?->is_voter ? 1 : 0,
                    'is_non_voter' => $user?->is_non_voter ? 1 : 0,
                    'voter_status' => $user?->voter_status ?: 'approved',
                    'archived_at' => null,
                    'is_household_head' => !empty($docRequest->family_members),
                ]);

                if ($user) {
                    $user->update([
                        'resident_code' => $code,
                        'status' => 'active',
                        'is_active' => 1,
                        'voter_status' => 'approved',
                    ]);
                }
            }

            // 4. Handle family members if supplied
            if (!empty($docRequest->family_members) && $resident) {
                $members = array_filter(array_map('trim', explode(',', $docRequest->family_members)));
                foreach ($members as $mName) {
                    if (empty($mName) || in_array(strtolower($mName), ['n/a', 'none', 'wala'])) continue;
                    $parts = preg_split('/\s+/', $mName);
                    $mLast = count($parts) > 1 ? array_pop($parts) : ($resident->last_name ?: '');
                    $mFirst = implode(' ', $parts);
                    if (!$mFirst) { $mFirst = $mLast; }

                    $exists = Resident::where('first_name', $mFirst)
                        ->where('last_name', $mLast)
                        ->where('household_head_id', $resident->id)
                        ->exists();

                    if (!$exists) {
                        Resident::create([
                            'resident_code' => 'RES-' . strtoupper(Str::random(8)),
                            'first_name' => $mFirst,
                            'last_name' => $mLast,
                            'birthday' => '2000-01-01',
                            'gender' => 'Prefer not to say',
                            'civil_status' => 'Single',
                            'birthplace' => 'N/A',
                            'address' => $fullAddress,
                            'household_head_id' => $resident->id,
                            'is_household_head' => false,
                            'archived_at' => null,
                        ]);
                    }
                }
                $resident->update(['is_household_head' => true]);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Error handling Move-In release: ' . $e->getMessage());
        }
    }

    /**
     * Automatically archive resident when Move-Out is released.
     */
    protected function handleMoveOutRelease(DocumentRequest $docRequest): void
    {
        try {
            $user = $docRequest->user;
            $resident = null;

            // 1. Find resident record
            if ($user) {
                if ($user->resident) {
                    $resident = $user->resident;
                } elseif ($user->resident_code) {
                    $resident = Resident::where('resident_code', $user->resident_code)->first();
                } else {
                    $resident = Resident::where('user_id', $user->id)->first();
                }

                if (!$resident && $user->first_name && $user->last_name) {
                    $resident = Resident::where('first_name', $user->first_name)
                        ->where('last_name', $user->last_name)
                        ->first();
                }
            }

            if (!$resident) {
                $fName = $docRequest->guest_first_name ?: $docRequest->claimant_first_name;
                $lName = $docRequest->guest_last_name ?: $docRequest->claimant_last_name;
                if ($fName && $lName) {
                    $resident = Resident::where('first_name', $fName)
                        ->where('last_name', $lName)
                        ->first();
                }
            }

            // 2. Archive the resident
            if ($resident) {
                $resident->update([
                    'archived_at' => now(),
                    'archive_reason' => 'Move-Out Certificate Released (Transfer of Residence)',
                    'voter_status' => 'Transferred / Moved Out',
                ]);

                // Archive household members if household head
                if ($resident->is_household_head) {
                    Resident::where('household_head_id', $resident->id)->update([
                        'archived_at' => now(),
                        'archive_reason' => 'Move-Out Certificate Released (Household Transfer)',
                        'voter_status' => 'Transferred / Moved Out',
                    ]);
                }

                // Archive any pets associated with resident
                if (method_exists($resident, 'pets')) {
                    $resident->pets()->update(['is_archived' => true]);
                }
            }

            // Also check if specific family members are listed in request
            if (!empty($docRequest->family_members)) {
                $members = array_filter(array_map('trim', explode(',', $docRequest->family_members)));
                foreach ($members as $mName) {
                    if (empty($mName) || in_array(strtolower($mName), ['n/a', 'none', 'wala'])) continue;
                    $parts = preg_split('/\s+/', $mName);
                    $mLast = count($parts) > 1 ? array_pop($parts) : '';
                    $mFirst = implode(' ', $parts);
                    if ($mFirst) {
                        $q = Resident::where('first_name', $mFirst);
                        if ($mLast) { $q->where('last_name', $mLast); }
                        $q->whereNull('archived_at')->update([
                            'archived_at' => now(),
                            'archive_reason' => 'Move-Out Certificate Released (Transfer of Residence)',
                            'voter_status' => 'Transferred / Moved Out',
                        ]);
                    }
                }
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Error handling Move-Out release: ' . $e->getMessage());
        }
    }

    public function purgeArchivedRequests(Request $request)
    {
        $cutoff = now()->subDays(30);
        $count = DocumentRequest::where('status', 'released')
            ->where('updated_at', '<', $cutoff)
            ->delete();

        return redirect()->back()->with('success', "Na-clean up at nabura na ang {$count} released document request(s) na nasa archive.");
    }

    public function destroyDocumentRequest($id)
    {
        $doc = DocumentRequest::findOrFail($id);
        $doc->delete();

        return redirect()->back()->with('success', 'Document request record successfully deleted.');
    }

    public function store(Request $request)
    {
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('residents/photos', 'public');
        }

        $head = Resident::create([
            'resident_code' => 'RES-' . strtoupper(Str::random(8)),
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'birthday' => $request->birthday,
            'age' => $request->age,
            'birthplace' => $request->birthplace ?? 'N/A',
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            // Only save spouse_name if Married
            'spouse_name' => $request->civil_status === 'Married' ? $request->spouse_name : null,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'occupation' => $request->occupation,
            'photo' => $photoPath,
            'is_voter' => $request->has('is_voter') ? 1 : 0,
            'is_non_voter' => $request->has('is_non_voter') ? 1 : 0,
            'is_senior' => $request->has('is_senior') ? 1 : 0,
            'is_pwd' => $request->has('is_pwd') ? 1 : 0,
            'is_single_parent' => $request->has('is_single_parent') ? 1 : 0,
            'is_student' => $request->has('is_student') ? 1 : 0,
            'is_bedridden' => $request->has('is_bedridden') ? 1 : 0,
            'is_household_head' => $request->has('is_household_head') ? 1 : 0,
            'household_id' => $request->household_id,
            'memberships' => collect($request->memberships)->filter()->count()
                ? json_encode($request->memberships)
                : null,
        ]);

        // If household head, save family members
        if ($request->has('is_household_head') && $request->has('family_members')) {
            foreach ($request->family_members as $member) {
                if (empty($member['first_name']) || empty($member['last_name']))
                    continue;

                $isMemVoter = isset($member['is_voter']) ? ($member['is_voter'] == '1') : (($member['classification'] ?? '') === 'Voter');

                Resident::create([
                    'resident_code' => 'RES-' . strtoupper(Str::random(8)),
                    'first_name' => $member['first_name'],
                    'last_name' => $member['last_name'],
                    'middle_name' => $member['middle_name'] ?? null,
                    'suffix' => $member['suffix'] ?? null,
                    'birthday' => $member['birthday'],
                    'age' => $member['age'] ?? null,
                    'relationship' => $member['relationship'] ?? null,
                    'birthplace' => $member['birthplace'] ?? $request->birthplace ?? 'N/A',
                    'gender' => $member['gender'] ?? 'Refer not to say',
                    'civil_status' => $member['civil_status'] ?? 'Single',
                    'is_senior' => ($member['classification'] ?? '') === 'Senior' || ($member['age'] ?? 0) >= 60 ? 1 : 0,
                    'is_pwd' => ($member['classification'] ?? '') === 'PWD' ? 1 : 0,
                    'is_bedridden' => ($member['classification'] ?? '') === 'Bed-ridden' ? 1 : 0,
                    'is_voter' => $isMemVoter ? 1 : 0,
                    'is_non_voter' => $isMemVoter ? 0 : 1,
                    'voter_status' => $isMemVoter ? 'approved' : 'non-voter',
                    'is_single_parent' => ($member['classification'] ?? '') === 'Solo Parent' ? 1 : 0,
                    'is_student' => ($member['classification'] ?? '') === 'Student' ? 1 : 0,
                    'address' => $request->address,
                    'household_head_id' => $head->id,
                    'is_household_head' => false,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Resident added successfully!');
    }

    public function edit($id)
    {
        $resident = Resident::with('householdMembers')->findOrFail($id);

        // Include photo URL for preview in edit modal
        $data = $resident->toArray();
        $data['photo'] = $resident->photo ? asset('storage/' . $resident->photo) : null;
        $data['family_members'] = $resident->householdMembers;

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);
        $photoPath = $resident->photo;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('residents/photos', 'public');
        }

        $resident->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'birthday' => $request->birthday,
            'age' => $request->age,
            'birthplace' => $request->birthplace ?? 'N/A',
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            'spouse_name' => $request->civil_status === 'Married' ? $request->spouse_name : null,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'occupation' => $request->occupation,
            'photo' => $photoPath,
            'is_voter' => $request->has('is_voter') ? 1 : 0,
            'is_non_voter' => $request->has('is_non_voter') ? 1 : 0,
            'is_senior' => $request->has('is_senior') ? 1 : 0,
            'is_pwd' => $request->has('is_pwd') ? 1 : 0,
            'is_single_parent' => $request->has('is_single_parent') ? 1 : 0,
            'is_student' => $request->has('is_student') ? 1 : 0,
            'is_bedridden' => $request->has('is_bedridden') ? 1 : 0,
            'is_household_head' => $request->has('is_household_head') ? 1 : 0,
            'household_id' => $request->household_id,
            'memberships' => $request->has('memberships') && collect($request->memberships)->filter()->count()
                ? json_encode($request->memberships)
                : null,
        ]);

        // ── Sync updated resident data back to linked user ──
        if ($resident->user_id) {
            User::where('id', $resident->user_id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'birthday' => $request->birthday,
                'birthplace' => $request->birthplace ?? 'N/A',
                'gender' => $request->gender,
                'civil_status' => $request->civil_status,
                'spouse_name' => $request->civil_status === 'Married' ? $request->spouse_name : null,
                'contact_number' => $request->contact_number,
                'address' => $request->address,
                'occupation' => $request->occupation,
                'photo' => $photoPath,
                'is_voter' => $request->has('is_voter') ? 1 : 0,
                'is_non_voter' => $request->has('is_non_voter') ? 1 : 0,
                'is_senior' => $request->has('is_senior') ? 1 : 0,
                'is_pwd' => $request->has('is_pwd') ? 1 : 0,
                'is_single_parent' => $request->has('is_single_parent') ? 1 : 0,
                'is_student' => $request->has('is_student') ? 1 : 0,
                'is_bedridden' => $request->has('is_bedridden') ? 1 : 0,
            ]);
        }

        // If household head, save family members
        if ($request->has('is_household_head') && $request->has('family_members')) {
            foreach ($request->family_members as $member) {
                if (empty($member['first_name']) || empty($member['last_name']))
                    continue;

                $isMemVoter = isset($member['is_voter']) ? ($member['is_voter'] == '1') : (($member['classification'] ?? '') === 'Voter');

                Resident::create([
                    'resident_code' => 'RES-' . strtoupper(Str::random(8)),
                    'first_name' => $member['first_name'],
                    'last_name' => $member['last_name'],
                    'middle_name' => $member['middle_name'] ?? null,
                    'suffix' => $member['suffix'] ?? null,
                    'birthday' => $member['birthday'],
                    'age' => $member['age'] ?? null,
                    'relationship' => $member['relationship'] ?? null,
                    'birthplace' => $member['birthplace'] ?? $request->birthplace ?? 'N/A',
                    'gender' => $member['gender'] ?? 'Refer not to say',
                    'civil_status' => $member['civil_status'] ?? 'Single',
                    'is_senior' => ($member['classification'] ?? '') === 'Senior' || ($member['age'] ?? 0) >= 60 ? 1 : 0,
                    'is_pwd' => ($member['classification'] ?? '') === 'PWD' ? 1 : 0,
                    'is_bedridden' => ($member['classification'] ?? '') === 'Bed-ridden' ? 1 : 0,
                    'is_voter' => $isMemVoter ? 1 : 0,
                    'is_non_voter' => $isMemVoter ? 0 : 1,
                    'voter_status' => $isMemVoter ? 'approved' : 'non-voter',
                    'is_single_parent' => ($member['classification'] ?? '') === 'Solo Parent' ? 1 : 0,
                    'is_student' => ($member['classification'] ?? '') === 'Student' ? 1 : 0,
                    'address' => $request->address,
                    'household_head_id' => $resident->id,
                    'is_household_head' => false,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Resident updated successfully!');
    }

    public function destroy($id)
    {
        Resident::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Resident deleted successfully!');
    }

    public function storePet(Request $request)
    {
        if (auth()->check() && in_array(auth()->user()->status, ['pending_verification', 'declined'])) {
            return redirect()->back()->with('error', '⚠️ Ang pagpaparehistro ng alagang hayop ay para lamang sa mga opisyal at beripikadong residente.');
        }

        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'pet_name' => 'required|string|max:255',
            'pet_type' => 'required|string',
        ]);

        $type = ($request->pet_type === 'Others') ? $request->pet_type_other : $request->pet_type;
        
        $petPhotoPath = null;
        if ($request->hasFile('pet_photo')) {
            $petPhotoPath = $request->file('pet_photo')->store('pet_photos', 'public');
        }

        $proofPath = null;
        $vStatus = $request->vaccination_status ?? 'unvaccinated';
        
        if ($request->hasFile('vaccine_proof')) {
            $proofPath = $request->file('vaccine_proof')->store('pet_vaccine_proofs', 'public');
            // If it was already set to 'vaccinated' (verified) by office staff, keep it. 
            // Otherwise, set to pending for verification.
            if ($vStatus !== 'vaccinated' && $vStatus !== 'verified') {
                $vStatus = 'pending';
            }
        }

        Pet::create([
            'resident_id' => $request->resident_id,
            'pet_name' => $request->pet_name,
            'pet_photo' => $petPhotoPath,
            'pet_type' => $type,
            'breed' => $request->breed,
            'age' => $request->age,
            'months' => $request->months,
            'quantity' => $request->quantity ?? 1,
            'vaccine_proof' => $proofPath,
            'vaccination_status' => $vStatus,
            'last_vaccine_date' => $request->last_vaccine_date,
            'status' => 'alive',
        ]);

        $msg = 'Pet registered successfully!';
        if ($vStatus === 'pending') {
            $msg .= ' Vaccination proof is pending verification.';
        }
        return redirect()->back()->with('success', $msg);
    }

    public function approvePetVaccine($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->update(['vaccination_status' => 'verified']);
        return redirect()->back()->with('success', 'Pet vaccination status verified.');
    }

    public function destroyPet($id)
    {
        Pet::findOrFail($id)->update(['is_archived' => true]);
        return redirect()->back()->with('success', 'Pet archived successfully!');
    }

    public function restorePet($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->update(['is_archived' => false]);
        return redirect()->back()->with('success', ($pet->pet_name ?? 'Pet') . ' has been restored to the active pet tracker.');
    }

    public function updatePetStatus(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        
        $data = [];
        if ($request->has('status')) {
            $data['status'] = $request->status;
        }
        if ($request->has('vaccination_status')) {
            $data['vaccination_status'] = $request->vaccination_status;
        }
        if ($request->has('rejection_reason')) {
            $data['rejection_reason'] = $request->rejection_reason;
        }

        $pet->update($data);
        
        return redirect()->back()->with('success', 'Pet details updated.');
    }

    public function archive($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->update([
            'archived_at' => now(),
            'archive_reason' => request('reason') ?? 'Archived by office staff',
        ]);

        return redirect()->route('office.index')
            ->with('success', $resident->first_name . ' ' . $resident->last_name . ' has been archived.');
    }

    public function restore($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->update([
            'archived_at' => null,
            'archive_reason' => null,
        ]);

        return redirect()->route('office.index')
            ->with('success', $resident->first_name . ' ' . $resident->last_name . ' has been restored.');
    }

    public function getDocumentRequest($id)
    {
        $req = DocumentRequest::with('user')->findOrFail($id);
        return response()->json($req);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls|max:10240', // 10MB limit
        ]);

        try {
            Excel::import(new ResidentsImport, $request->file('file'));
            return redirect()->back()->with('success', 'Masterlist imported successfully.');
        } catch (\Exception $e) {
            \Log::error('Import failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error importing file: Please ensure the format is correct.');
        }
    }

    public function approveResident($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->verification_status = 'approved';
        
        // If there's a linked user, ensure they can login too
        if ($resident->user) {
            $resident->user->update(['voter_status' => 'approved', 'status' => 'active', 'is_active' => 1]);
            $resident->voter_status = 'approved';
        }
        
        $resident->save();

        return redirect()->back()->with('success', 'Resident verified and approved successfully.');
    }

    public function rejectResident(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);
        $resident->verification_status = 'rejected';
        $resident->save();

        return redirect()->back()->with('success', 'Resident verification rejected.');
    }

    public function approveVerification(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $residentId = $request->input('resident_id');
        $resident = $residentId ? Resident::find($residentId) : null;

        if (!$resident) {
            $match = \App\Services\ResidentMatcher::match(
                $user->first_name ?: $user->name,
                $user->last_name ?: '',
                $user->birthday ? $user->birthday->format('Y-m-d') : null
            );
            $resident = $match['matched_resident'];
        }

        // Check if registrant has an active Move-In application
        $moveIn = \App\Models\DocumentRequest::where('user_id', $user->id)
            ->whereIn('document_type', ['move_in', 'move-in', 'Move In', 'Move-In'])
            ->latest()
            ->first();

        $moveInAddress = null;
        if ($moveIn) {
            $parts = [];
            if (!empty($moveIn->blk)) $parts[] = 'Blk ' . $moveIn->blk;
            if (!empty($moveIn->lot)) $parts[] = 'Lot ' . $moveIn->lot;
            $parts[] = 'Barangay San Miguel II';
            $moveInAddress = implode(' ', $parts);
            // Mark Move-In application released upon verification approval
            $moveIn->update(['status' => 'released']);
        }

        if ($resident) {
            // Update matched masterlist record with verified details and link user
            $resident->update([
                'user_id' => $user->id,
                'first_name' => $user->first_name ?: $resident->first_name,
                'last_name' => $user->last_name ?: $resident->last_name,
                'middle_name' => $user->middle_name ?: $resident->middle_name,
                'birthday' => $user->birthday ?: $resident->birthday,
                'address' => $moveInAddress ?: ($user->address ?: $resident->address),
                'is_voter' => $user->is_voter ?? $resident->is_voter,
                'precinct_no' => $user->precinct_no ?? $resident->precinct_no,
                'voter_status' => 'approved',
                'verification_status' => 'approved',
            ]);
        } else {
            // Create masterlist entry if none existed
            $lastCode = Resident::max('resident_code');
            $nextNum = $lastCode ? ((int)preg_replace('/[^0-9]/', '', $lastCode) + 1) : 1;
            $code = 'RSM-' . str_pad($nextNum, 5, '0', STR_PAD_LEFT);

            $resident = Resident::create([
                'user_id' => $user->id,
                'resident_code' => $code,
                'first_name' => $user->first_name ?: $user->name,
                'last_name' => $user->last_name ?: '',
                'middle_name' => $user->middle_name,
                'birthday' => $user->birthday,
                'address' => $moveInAddress ?: ($user->address ?: 'Barangay San Miguel II'),
                'is_voter' => $user->is_voter,
                'precinct_no' => $user->precinct_no,
                'voter_status' => 'approved',
                'verification_status' => 'approved',
            ]);
        }

        // Activate user account
        $user->update([
            'status' => 'active',
            'is_active' => 1,
            'voter_status' => 'approved',
            'address' => $moveInAddress ?: $user->address,
            'resident_code' => $resident->resident_code ?? $user->resident_code,
        ]);

        if (!empty($user->email)) {
            try {
                Mail::to($user->email)->send(new VoterVerificationMail($user, 'approved'));
            } catch (\Exception $e) {
                \Log::error('Failed to send approve verification email: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', "Registrant {$user->name} approved, masterlist updated, account activated, and confirmation email sent!");
    }

    public function rejectVerification(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'status' => 'declined',
            'is_active' => 1,
            'voter_status' => 'declined',
            'decline_reason' => $request->rejection_reason,
        ]);

        if (!empty($user->email)) {
            try {
                Mail::to($user->email)->send(new VoterVerificationMail($user, 'declined', $request->rejection_reason));
            } catch (\Exception $e) {
                \Log::error('Failed to send decline verification email: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', "Verification for {$user->name} was disapproved and notification email sent.");
    }

    public function getFamily($id)
    {
        $head = Resident::with('householdMembers')->findOrFail($id);
        return response()->json($head->householdMembers);
    }
}
