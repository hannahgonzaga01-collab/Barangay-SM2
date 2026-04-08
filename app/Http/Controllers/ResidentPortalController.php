<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use App\Models\IssueReport;
use App\Models\DigitalId;
use App\Models\User;
use App\Models\Resident;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\ResidentMessage;
use App\Notifications\DocumentRequestReceived;

class ResidentPortalController extends Controller
{
    public function index()
    {
        $requests   = collect();
        $digitalId  = null;
        $resident   = null;
        $myMessages = collect();

        if (auth()->check()) {
            /** @var User $user */
            $user = auth()->user();

            // ── 1. Already linked by user_id ──
            $resident = Resident::where('user_id', $user->id)->first();

            // ── 2. Match by resident_code stored on user ──
            if (!$resident && $user->resident_code) {
                $resident = Resident::where('resident_code', $user->resident_code)->first();
                if ($resident) {
                    $resident->update(['user_id' => $user->id]);
                }
            }

            // ── 3. Match by first + last name (case-insensitive) ──
            if (!$resident && $user->first_name && $user->last_name) {
                $resident = Resident::whereRaw('LOWER(first_name) = ?', [strtolower($user->first_name)])
                    ->whereRaw('LOWER(last_name) = ?', [strtolower($user->last_name)])
                    ->whereNull('user_id')
                    ->first();
                if ($resident) {
                    $resident->update(['user_id' => $user->id]);
                }
            }

            // ── 4. Match by full name column ──
            if (!$resident && $user->name) {
                $parts = explode(' ', trim($user->name));
                if (count($parts) >= 2) {
                    $first = $parts[0];
                    $last  = end($parts);
                    $resident = Resident::whereRaw('LOWER(first_name) = ?', [strtolower($first)])
                        ->whereRaw('LOWER(last_name) = ?', [strtolower($last)])
                        ->whereNull('user_id')
                        ->first();
                    if ($resident) {
                        $resident->update(['user_id' => $user->id]);
                        $user->update([
                            'first_name' => $resident->first_name,
                            'last_name'  => $resident->last_name,
                        ]);
                    }
                }
            }

            // ── Sync ALL resident details to user record ──
            if ($resident) {
                $user->update([
                    'resident_code'    => $resident->resident_code,
                    'first_name'       => $resident->first_name,
                    'last_name'        => $resident->last_name,
                    'middle_name'      => $resident->middle_name,
                    'birthday'         => $resident->birthday,
                    'birthplace'       => $resident->birthplace,
                    'gender'           => $resident->gender,
                    'civil_status'     => $resident->civil_status,
                    'spouse_name'      => $resident->spouse_name,
                    'contact_number'   => $resident->contact_number,
                    'address'          => $resident->address,
                    'occupation'       => $resident->occupation,
                    'photo'            => $resident->photo,
                    'is_voter'         => $resident->is_voter,
                    'is_senior'        => $resident->is_senior,
                    'is_pwd'           => $resident->is_pwd,
                    'is_single_parent' => $resident->is_single_parent,
                    'is_student'       => $resident->is_student,
                ]);
                $user->refresh();
            }

            // Fetch document requests
            $requests = DocumentRequest::where('user_id', $user->id)->latest()->get();

            // Fetch digital ID
            $digitalId = DigitalId::where('user_id', $user->id)->latest()->first();

            // Fetch messages sent by this resident (with admin replies)
            $myMessages = ResidentMessage::where('user_id', $user->id)->latest()->get();
        }

        $announcements = Announcement::where('is_active', true)->latest()->take(5)->get();
        $events        = Event::where('is_active', true)->latest()->get();

        // Feed for "Done in a week"
        $recentUpdates = collect();
        $recentAnnouncements = Announcement::where('is_active', true)
            ->where('created_at', '>=', now()->subDays(7))
            ->get()->map(function($a) {
                $a->type = 'Announcement';
                $a->sort_date = $a->created_at;
                return $a;
            });
            
        $recentEvents = Event::where('is_active', true)
            ->where('created_at', '>=', now()->subDays(7))
            ->get()->map(function($e) {
                $e->type = 'Event';
                $e->sort_date = $e->created_at;
                return $e;
            });

        $recentUpdates = $recentAnnouncements->concat($recentEvents)->sortByDesc('sort_date')->values();

        $unreadNotifications = collect();
        $allNotifications    = collect();
        if (auth()->check()) {
            $unreadNotifications = auth()->user()->unreadNotifications()->take(10)->get();
            $allNotifications    = auth()->user()->notifications()->take(20)->get();
        }

        return view('resident.index', compact(
            'requests', 'digitalId', 'resident', 'myMessages',
            'announcements', 'events', 'recentUpdates',
            'unreadNotifications', 'allNotifications'
        ));
    }

    public function markNotificationsRead()
    {
        if (auth()->check()) {
            auth()->user()->unreadNotifications->markAsRead();
        }
        return response()->json(['success' => true]);
    }

    public function requestDigitalId(Request $request)
    {
        $request->validate([
            'contact_person'        => 'required|string|max:255',
            'contact_person_number' => 'required|string|max:20',
        ]);

        $user = auth()->user();

        $existing = DigitalId::where('user_id', $user->id)->first();
        if ($existing) {
            return redirect()->route('resident.index')
                ->with('success', 'You already have a Digital ID request on file. Status: ' . ucfirst($existing->status));
        }

        DigitalId::create([
            'user_id'               => $user->id,
            'contact_person'        => $request->contact_person,
            'contact_person_number' => $request->contact_person_number,
            'status'                => 'pending',
        ]);

        return redirect()->route('resident.index')
            ->with('success', '✅ Digital ID requested! The office will process and generate your ID.');
    }

    public function storeDocumentRequest(Request $request)
    {
        $userId = auth()->id();

        // Ensure user name is synced before saving
        if (auth()->check()) {
            $user = auth()->user();
            if ((!$user->first_name || !$user->last_name) && $user->resident_code) {
                $res = Resident::where('resident_code', $user->resident_code)->first();
                if ($res) {
                    $user->update([
                        'first_name' => $res->first_name,
                        'last_name'  => $res->last_name,
                    ]);
                }
            }
            if (!$user->first_name && $user->name) {
                $parts = explode(' ', trim($user->name));
                $user->update([
                    'first_name' => $parts[0] ?? '',
                    'last_name'  => end($parts) ?: '',
                ]);
            }
        }

        $data = [
            'document_type'     => $request->document_type,
            'purpose'           => $request->purpose,
            'address'           => $request->address,
            'contact'           => $request->contact,
            'blk'               => $request->blk,
            'lot'               => $request->lot,
            'move_date'         => $request->move_date,
            'landlord'          => $request->landlord,
            'family_members'    => $request->family_members,
            'ward_name'         => $request->ward_name,
            'ward_age'          => $request->ward_age,
            'ward_relation'     => $request->ward_relation,
            'partner_name'      => $request->partner_name,
            'living_since'      => $request->living_since,
            'claimant_name'     => $request->claimant_name,
            'claimant_relation' => $request->claimant_relation,
            'birth_month'       => $request->birth_month,
            'birth_year'        => $request->birth_year,
            'child_name'        => $request->child_name,
            'father_name'       => $request->father_name,
            'mother_name'       => $request->mother_name,
            'birth_attendant'   => $request->birth_attendant,
            'born_from'         => $request->born_from,
            'residing_since'    => $request->residing_since,
            'status'            => 'pending',
            'user_id'           => $userId,
        ];

        if (!auth()->check()) {
            $data['guest_first_name'] = $request->guest_first_name;
            $data['guest_last_name']  = $request->guest_last_name;
        }

        $docRequest = DocumentRequest::create($data);

        if (auth()->check()) {
            try {
                auth()->user()->notify(new DocumentRequestReceived($docRequest));
            } catch (\Exception $e) {
                // Notification failed silently
            }
        }

        return redirect()->route('resident.index')
            ->with('success', '✅ Document request submitted! The office will notify you when it\'s ready.');
    }

    public function storeIssueReport(Request $request)
    {
        $request->validate([
            'issue_type'       => 'required|string',
            'complainant_name' => 'required|string',
            'contact'          => 'required|string',
            'respondent_name'  => 'required|string',
            'description'      => 'required|string',
        ]);

        $issueType = $request->issue_type === 'Others'
            ? ($request->issue_type_other ?? 'Others')
            : $request->issue_type;

        $department    = $this->routeDepartment($issueType);
        $evidencePaths = [];

        if ($request->hasFile('evidence')) {
            foreach ($request->file('evidence') as $file) {
                $evidencePaths[] = $file->store('issue_evidence', 'public');
            }
        }

        IssueReport::create([
            'user_id'            => auth()->id(),
            'issue_type'         => $issueType,
            'complainant_name'   => $request->complainant_name,
            'complainant_age'    => $request->complainant_age,
            'complainant_gender' => $request->complainant_gender,
            'respondent_name'    => $request->respondent_name,
            'respondent_address' => $request->respondent_address,
            'respondent_contact' => $request->respondent_contact,
            'description'        => $request->description,
            'location'           => $request->incident_location,
            'incident_date'      => $request->incident_date,
            'contact'            => $request->contact,
            'witness_name'       => $request->witness_name,
            'witness_contact'    => $request->witness_contact,
            'evidence'           => !empty($evidencePaths) ? json_encode($evidencePaths) : null,
            'department'         => $department,
            'status'             => 'submitted',
        ]);

        return redirect()->route('resident.index')
            ->with('success', 'Issue report submitted! The office will notify you when it\'s ready.');
    }

    // ── Send message to barangay (saves to DB + admin can reply) ──
    public function sendMessage(Request $request)
    {
        $user = auth()->user();

        // Resolve sender info
        if ($user) {
            $name  = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
            if (!$name) $name = $user->name ?? 'Anonymous';
            $email = $user->email ?? '';
            $code  = $user->resident_code ?? '';
        } else {
            $name  = $request->input('name', $request->input('sender_name', 'Anonymous'));
            $email = $request->input('email', $request->input('sender_email', ''));
            $code  = '';
        }

        $subject = $request->input('subject', 'General Inquiry');
        $message = $request->input('message', '');

        if (!$message || !$subject) {
            return response()->json(['success' => false, 'error' => 'Message and subject are required.'], 422);
        }

        // ── Save to DB so admin sees it in Messages tab ──
        ResidentMessage::create([
            'user_id'       => $user?->id,
            'name'          => $name,
            'email'         => $email,
            'resident_code' => $code,
            'subject'       => $subject,
            'message'       => $message,
        ]);

        return response()->json(['success' => true]);
    }

    private function routeDepartment(string $issueType): string
    {
        $vawcKeywords  = ['VAWC', 'Domestic Violence', 'Sexual Harassment', 'Child Abuse', 'Economic Abuse'];

        foreach ($vawcKeywords  as $kw) { if (str_contains($issueType, $kw)) return 'VAWC'; }

        return 'Peace & Order';
    }
}
