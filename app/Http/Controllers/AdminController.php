<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Official;
use App\Models\Resident;
use App\Models\User;
use App\Models\DocumentRequest;
use App\Models\IssueReport;
use App\Models\Pet;
use App\Models\DigitalId;
use App\Models\ResidentMessage;
use App\Notifications\AdminReplyNotification;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalResidents    = Resident::count();
        $totalUsers        = User::where('role', 'resident')->count();
        $totalDocs         = DocumentRequest::count();
        $pendingDocs       = DocumentRequest::where('status', 'pending')->count();
        $processingDocs    = DocumentRequest::where('status', 'processing')->count();
        $readyDocs         = DocumentRequest::where('status', 'ready')->count();
        $totalIssues       = IssueReport::count();
        $pendingIssues     = IssueReport::where('status', 'submitted')->count();
        $vawcIssues        = IssueReport::where('department', 'VAWC')->count();
        $peaceIssues       = IssueReport::where('department', 'Peace & Order')->count();
        $justiceIssues     = IssueReport::where('department', 'Justice')->count();
        $totalPets         = Pet::count();
        $vaccinated        = Pet::where('vaccine_status', 'Vaccinated')->count();
        $unvaccinated      = Pet::where('vaccine_status', 'Unvaccinated')->count();
        $male              = Resident::where('gender', 'Male')->count();
        $female            = Resident::where('gender', 'Female')->count();
        $seniors           = Resident::where('is_senior', true)->count();
        $pwds              = Resident::where('is_pwd', true)->count();
        $soloParents       = Resident::where('is_single_parent', true)->count();
        $students          = Resident::where('is_student', true)->count();
        $voters            = Resident::where('is_voter', true)->count();
        $minors            = Resident::whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) < 18')->count();
        $adults            = Resident::whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN 18 AND 59')->count();
        $birthdayThisMonth = Resident::whereMonth('birthday', Carbon::now()->month)->count();

        $officials         = Official::where('is_active', true)->get();
        $archivedOfficials = Official::where('is_active', false)->get();
        $announcements     = Announcement::where('is_active', true)->latest()->get();
        $archivedAnnouncements = Announcement::where('is_active', false)->latest()->get();
        $events            = Event::where('is_active', true)->latest()->get();
        $archivedEvents    = Event::where('is_active', false)->latest()->get();

        // ── Resident Messages ──
        $residentMessages = ResidentMessage::latest()->get()->map(function ($m) {
            return [
                'id'                   => $m->id,
                'name'                 => $m->name ?? '',
                'email'                => $m->email ?? '',
                'subject'              => $m->subject ?? '',
                'message'              => $m->message ?? '',
                'resident_code'        => $m->resident_code ?? '',
                'read_at'              => $m->read_at,
                'replied_at'           => $m->replied_at,
                'admin_reply'          => $m->admin_reply ?? '',
                'time_ago'             => $m->created_at->diffForHumans(),
                'created_at_formatted' => $m->created_at->format('M d, Y h:i A'),
            ];
        })->values()->toArray();

        // ── Residents Basic Data For Global Filter ──
        $resList = Resident::select('id', 'first_name', 'last_name', 'middle_name', 'birthday')->get()->map(function ($r) {
            return [
                'id' => $r->id,
                'name' => trim($r->first_name . ' ' . $r->last_name),
                'bmonth' => $r->birthday ? Carbon::parse($r->birthday)->month : null,
                'bdate_raw' => $r->birthday
            ];
        })->toArray();

        return view('admin.dashboard', compact(
            'totalResidents', 'totalUsers', 'totalDocs', 'pendingDocs',
            'processingDocs', 'readyDocs', 'totalIssues', 'pendingIssues',
            'vawcIssues', 'peaceIssues', 'justiceIssues',
            'totalPets', 'vaccinated', 'unvaccinated',
            'male', 'female', 'seniors', 'pwds', 'soloParents', 'students',
            'voters', 'minors', 'adults', 'birthdayThisMonth',
            'officials', 'archivedOfficials',
            'announcements', 'archivedAnnouncements',
            'events', 'archivedEvents',
            'residentMessages',
            'resList'
        ));
    }

    // ── Mark message as read ──
    public function markMessageRead($id)
    {
        $msg = ResidentMessage::findOrFail($id);
        if (!$msg->read_at) {
            $msg->update(['read_at' => now()]);
        }
        return response()->json(['success' => true]);
    }

    // ── Admin reply to resident message ──
    public function replyMessage(Request $request, $id)
    {
        $request->validate(['reply' => 'required|string|max:2000']);

        $msg = ResidentMessage::findOrFail($id);
        $msg->update([
            'admin_reply' => $request->reply,
            'replied_at'  => now(),
            'read_at'     => $msg->read_at ?? now(),
        ]);

        // Notify the resident if they have an account
        if ($msg->user_id) {
            $user = \App\Models\User::find($msg->user_id);
            if ($user) {
                try {
                    $user->notify(new AdminReplyNotification($msg));
                } catch (\Exception $e) {
                    // Notification failed silently
                }
            }
        } elseif ($msg->email) {
            // Guest — send email directly
            try {
                \Illuminate\Support\Facades\Mail::raw(
                    "Dear " . ($msg->name ?: 'Resident') . ",\n\n" .
                    "The Barangay San Miguel II office has replied to your message.\n\n" .
                    "Your Subject: " . $msg->subject . "\n" .
                    "Your Message: " . $msg->message . "\n\n" .
                    "---\nBarangay Office Reply:\n" . $request->reply . "\n\n" .
                    "— Barangay San Miguel II, Dasmariñas City, Cavite\n\n" .
                    "This is an automated message. Please do not reply to this email.",
                    function ($mail) use ($msg) {
                        $mail->to($msg->email)
                             ->subject('📬 Reply from Barangay San Miguel II — ' . $msg->subject);
                    }
                );
            } catch (\Exception $e) {
                // Mail failed silently
            }
        }

        return response()->json(['success' => true, 'replied_at' => now()->format('M d, Y h:i A')]);
    }

    // ── Announcements ──
    public function storeAnnouncement(Request $request)
    {
        $request->validate(['title' => 'required', 'content' => 'required', 'image' => 'nullable|image|max:5120']);
        $data = [
            'title'      => $request->title,
            'content'    => $request->content,
            'tag'        => $request->tag ?? 'Announcement',
            'is_active'  => true,
            'created_by' => auth()->id(),
        ];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('announcements', 'public');
            $data['image_path'] = $path;
            $data['image']      = $path;
        }
        Announcement::create($data);
        return redirect()->back()->with('success', 'Announcement posted!');
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $request->validate(['image' => 'nullable|image|max:5120']);
        $ann = Announcement::findOrFail($id);
        $data = [
            'title'   => $request->title,
            'content' => $request->content,
            'tag'     => $request->tag ?? $ann->tag,
        ];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('announcements', 'public');
            $data['image_path'] = $path;
            $data['image']      = $path;
        }
        $ann->update($data);
        return redirect()->back()->with('success', 'Announcement updated!');
    }

    public function archiveAnnouncement($id)
    {
        Announcement::findOrFail($id)->update(['is_active' => false]);
        return redirect()->back()->with('success', 'Announcement archived.');
    }

    public function restoreAnnouncement($id)
    {
        Announcement::findOrFail($id)->update(['is_active' => true]);
        return redirect()->back()->with('success', 'Announcement restored.');
    }

    // ── Events ──
    public function storeEvent(Request $request)
    {
        $request->validate(['title' => 'required', 'day_label' => 'required', 'frequency' => 'required', 'image' => 'nullable|image|max:5120']);
        $data = [
            'title'      => $request->title,
            'day_label'  => $request->day_label,
            'frequency'  => $request->frequency,
            'time_range' => $request->time_range,
            'location'   => $request->location,
            'tag'        => $request->tag ?? 'Community',
            'description'=> $request->description,
            'is_active'  => true,
            'created_by' => auth()->id(),
        ];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $data['image_path'] = $path;
            $data['image']      = $path;
        }
        Event::create($data);
        return redirect()->back()->with('success', 'Event created!');
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate(['image' => 'nullable|image|max:5120']);
        $evt = Event::findOrFail($id);
        $data = [
            'title'      => $request->title,
            'day_label'  => $request->day_label,
            'frequency'  => $request->frequency,
            'time_range' => $request->time_range,
            'location'   => $request->location,
            'tag'        => $request->tag ?? $evt->tag,
            'description'=> $request->description,
        ];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $data['image_path'] = $path;
            $data['image']      = $path;
        }
        $evt->update($data);
        return redirect()->back()->with('success', 'Event updated!');
    }

    public function archiveEvent($id)
    {
        Event::findOrFail($id)->update(['is_active' => false]);
        return redirect()->back()->with('success', 'Event archived.');
    }

    public function restoreEvent($id)
    {
        Event::findOrFail($id)->update(['is_active' => true]);
        return redirect()->back()->with('success', 'Event restored.');
    }

    // ── Officials ──
    public function storeOfficial(Request $request)
    {
        $request->validate(['name' => 'required', 'position' => 'nullable|string', 'department' => 'nullable|string']);
        $data = [
            'name'       => $request->name,
            'department' => $request->department,
            'position'   => $request->position,
            'term_start' => $request->term_start,
            'term_end'   => $request->term_end,
            'is_active'  => true,
            'created_by' => auth()->id(),
        ];
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('officials', 'public');
        }
        Official::create($data);
        return redirect()->back()->with('success', 'Official added!');
    }

    public function updateOfficial(Request $request, $id)
    {
        $request->validate(['name' => 'required', 'position' => 'nullable|string', 'department' => 'nullable|string', 'photo' => 'nullable|image|max:5120']);
        $off = Official::findOrFail($id);
        $data = [
            'name'       => $request->name,
            'department' => $request->department,
            'position'   => $request->position,
            'term_start' => $request->term_start,
            'term_end'   => $request->term_end,
        ];
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('officials', 'public');
        }
        $off->update($data);
        return redirect()->back()->with('success', 'Official updated!');
    }

    public function archiveOfficial($id)
    {
        Official::findOrFail($id)->update(['is_active' => false]);
        return redirect()->back()->with('success', 'Official archived.');
    }

    public function restoreOfficial($id)
    {
        Official::findOrFail($id)->update(['is_active' => true]);
        return redirect()->back()->with('success', 'Official restored.');
    }

    // ── LGU Synchronization ──
    public function syncLguJson()
    {
        $residents = Resident::all()->map(function ($r) {
            $sectors = [];
            if ($r->is_senior) $sectors[] = 'Senior Citizen';
            if ($r->is_pwd) $sectors[] = 'PWD';
            if ($r->is_single_parent) $sectors[] = 'Solo Parent';
            if ($r->is_student) $sectors[] = 'Student';
            if ($r->is_voter) $sectors[] = 'Registered Voter';

            // Calculate age dynamically if not present
            $age = $r->age ?? (\Carbon\Carbon::parse($r->birthday)->age ?? null);

            if ($age !== null) {
                if ($age < 18) {
                    $sectors[] = 'Minor';
                } elseif ($age >= 18 && $age <= 59) {
                    $sectors[] = 'Adult';
                }
            }

            return [
                'Name'   => trim($r->first_name . ' ' . $r->middle_name . ' ' . $r->last_name . ' ' . $r->suffix),
                'Age'    => $age,
                'Sector' => $sectors,
                'Status' => $r->archived_at ? 'Archived' : 'Active',
            ];
        });

        $filename = 'LGU_Sync_BRGYSANMIGUEL2_' . now()->format('Y-m-d') . '.json';
        
        return response()->json($residents, 200, [
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ], JSON_PRETTY_PRINT);
    }
}
