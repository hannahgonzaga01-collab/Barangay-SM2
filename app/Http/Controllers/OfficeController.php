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

class OfficeController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::query();

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

        $users = $query->latest()->get();
        $pets = Pet::with('resident')->get();
        $petCount = $pets->count();

        $currentMonth = now()->month;
        $birthdayThisMonth = Resident::whereMonth('birthday', $currentMonth)->get();
        $seniors = Resident::where('is_senior', true)->get();
        $pwds = Resident::where('is_pwd', true)->get();
        $soloParents = Resident::where('is_single_parent', true)->get();
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

        // Fetch non-resident accounts: users with 'resident' role but no associated Resident profile
        $nonResidents = User::where('role', 'resident')->doesntHave('resident')->latest()->get();

        $documentRequests = DocumentRequest::with(['user'])
            ->latest()
            ->get();

        $pendingDocCount = $documentRequests->where('status', 'pending')->count();
        $pendingIdCount = $digitalIdRequests->count();
        $totalPending = $pendingDocCount + $pendingIdCount;

        return view('office.index', compact(
            'users',
            'pets',
            'petCount',
            'birthdayThisMonth',
            'seniors',
            'pwds',
            'soloParents',
            'kdbmCount',
            'fourPsCount',
            'anyMembershipCount',
            'digitalIdRequests',
            'documentRequests',
            'pendingDocCount',
            'pendingIdCount',
            'totalPending',
            'nonResidents'
        ));
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

    public function updateDocumentStatus(Request $request, $id)
    {
        $docRequest = DocumentRequest::with('user')->findOrFail($id);
        $docRequest->update(['status' => $request->status]);

        if ($docRequest->user) {
            $docRequest->user->notify(new DocumentRequestStatusUpdated($docRequest));
        }

        return redirect()->back()->with('success', 'Status updated to ' . ucfirst($request->status) . '. Resident notified.');
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
            'is_senior' => $request->has('is_senior') ? 1 : 0,
            'is_pwd' => $request->has('is_pwd') ? 1 : 0,
            'is_single_parent' => $request->has('is_single_parent') ? 1 : 0,
            'is_student' => $request->has('is_student') ? 1 : 0,
            'is_household_head' => $request->has('is_household_head') ? 1 : 0,
            'memberships' => collect($request->memberships)->filter()->count()
                ? json_encode($request->memberships)
                : null,
        ]);

        // If household head, save family members
        if ($request->has('is_household_head') && $request->has('family_members')) {
            foreach ($request->family_members as $member) {
                if (empty($member['first_name']) || empty($member['last_name']))
                    continue;

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
        $resident = Resident::findOrFail($id);

        // Include photo URL for preview in edit modal
        $data = $resident->toArray();
        $data['photo'] = $resident->photo ? asset('storage/' . $resident->photo) : null;

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
            'is_senior' => $request->has('is_senior') ? 1 : 0,
            'is_pwd' => $request->has('is_pwd') ? 1 : 0,
            'is_single_parent' => $request->has('is_single_parent') ? 1 : 0,
            'is_student' => $request->has('is_student') ? 1 : 0,
            'is_household_head' => $request->has('is_household_head') ? 1 : 0,
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
                'is_senior' => $request->has('is_senior') ? 1 : 0,
                'is_pwd' => $request->has('is_pwd') ? 1 : 0,
                'is_single_parent' => $request->has('is_single_parent') ? 1 : 0,
                'is_student' => $request->has('is_student') ? 1 : 0,
            ]);
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
        $type = ($request->pet_type === 'Others') ? $request->pet_type_other : $request->pet_type;

        Pet::create([
            'resident_id' => $request->resident_id,
            'pet_name' => $request->pet_name,
            'pet_type' => $type,
            'breed' => $request->breed,
            'age' => $request->age,
            'months' => $request->months,
            'quantity' => $request->quantity ?? 1,
            'vaccine_status' => $request->vaccine_status,
            'last_vaccine_date' => $request->last_vaccine_date,
            'status' => 'alive',
        ]);

        return redirect()->back()->with('success', 'Pet registered successfully!');
    }

    public function destroyPet($id)
    {
        Pet::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pet deleted!');
    }

    public function updatePetStatus(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        $pet->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Pet status updated.');
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
}
