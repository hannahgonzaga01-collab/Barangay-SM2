<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use App\Models\IssueReport;
use App\Models\DigitalId;
use App\Models\User;
use App\Models\Resident;
use App\Models\Pet;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\SiteSetting;
use App\Notifications\DocumentRequestReceived;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComplaintReportReceivedMail;

class ResidentPortalController extends Controller
{
    public function index()
    {
        $requests   = collect();
        $digitalId  = null;
        self::sendDueAppointmentReminders();

        $resident   = null;

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

            // ── 5. Auto-create resident profile if user still has none (only for active users) ──
            if (!$resident && $user->role === 'resident' && !in_array($user->status, ['pending_verification', 'declined'])) {
                $prefix = strtoupper(substr($user->last_name ?? 'R', 0, 1) . substr($user->first_name ?? 'U', 0, 1));
                $random = strtoupper(substr(uniqid(), -6));
                $resident = Resident::create([
                    'user_id'             => $user->id,
                    'resident_code'       => $user->resident_code ?? "R-{$prefix}-{$random}",
                    'first_name'          => $user->first_name ?? ($user->name ? explode(' ', $user->name)[0] : 'Resident'),
                    'middle_name'         => $user->middle_name,
                    'last_name'           => $user->last_name ?? ($user->name ? (explode(' ', $user->name)[1] ?? '') : 'User'),
                    'birthday'            => $user->birthday ?? now()->subYears(20)->toDateString(),
                    'birthplace'          => $user->birthplace ?? 'Barangay San Miguel II, Dasmariñas, Cavite',
                    'gender'              => $user->gender ?? 'Other',
                    'civil_status'        => $user->civil_status ?? 'Single',
                    'address'             => $user->address ?? 'Barangay San Miguel II',
                    'is_voter'            => (bool)($user->is_voter ?? false),
                    'is_non_voter'        => (bool)($user->is_non_voter ?? false),
                    'is_senior'           => (bool)($user->is_senior ?? false),
                    'is_household_head'   => true,
                    'verification_status' => 'approved',
                ]);
                $user->update(['resident_code' => $resident->resident_code]);
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
                    'is_non_voter'     => $resident->is_non_voter,
                    'is_bedridden'     => $resident->is_bedridden,
                ]);
                $user->refresh();
            }

            // Fetch document requests
            $requests = DocumentRequest::where('user_id', $user->id)->latest()->get();

            // Fetch digital ID
            $digitalId = DigitalId::where('user_id', $user->id)->latest()->first();

            // Fetch issue reports (Justice/VAWC/Peace)
            $issueReports = IssueReport::where('user_id', $user->id)->latest()->get();

            // Fetch emergency SOS dispatches
            $sosHistory = \App\Models\EmergencySosAlert::where('user_id', $user->id)->latest()->get();
        } else {
            $issueReports = collect();
            $sosHistory   = collect();
        }

        // Auto-archive expired dates so residents see fresh active lists
        Event::where('is_active', true)
            ->whereNotNull('frequency')
            ->whereRaw("frequency REGEXP '^[0-9]{4}-[0-9]{2}-[0-9]{2}$'")
            ->whereDate('frequency', '<', now()->toDateString())
            ->update(['is_active' => false, 'archived_at' => now()]);

        Announcement::where('is_active', true)
            ->whereNotNull('date')
            ->whereDate('date', '<', now()->toDateString())
            ->update(['is_active' => false, 'archived_at' => now()]);

        $announcements = Announcement::where('is_active', true)->latest()->take(5)->get();
        $events        = Event::where('is_active', true)->latest()->get();

        // Feed for "Past Updates" (ONLY includes archived items)
        $recentAnnouncements = Announcement::where('is_active', false)
            ->latest()
            ->take(20)
            ->get()->map(function($a) {
                $a->type = 'Announcement';
                $a->sort_date = $a->archived_at ?? $a->created_at;
                return $a;
            });
            
        $recentEvents = Event::where('is_active', false)
            ->latest()
            ->take(20)
            ->get()->map(function($e) {
                $e->type = 'Event';
                $e->sort_date = $e->archived_at ?? $e->created_at;
                return $e;
            });

        $recentUpdates = $recentAnnouncements->concat($recentEvents)->sortByDesc('sort_date')->values();

        $unreadNotifications = collect();
        $allNotifications    = collect();
        if (auth()->check()) {
            $unreadNotifications = auth()->user()->unreadNotifications()->take(10)->get();
            $allNotifications    = auth()->user()->notifications()->take(20)->get();
        }
        
        $carouselData   = SiteSetting::where('key', 'carousel_data')->first()?->value;
        $carouselSlides = $carouselData ? collect(json_decode($carouselData))->where('is_active', true)->sortBy('sort_order') : collect();
        $orgChartPath   = SiteSetting::where('key', 'organizational_chart')->first()?->value;

        // Fetch Patrol Schedules for Tanod Duty Display
        $patrolSchedules = \App\Models\PatrolSchedule::latest()->get();

        // Retrieve latest personnel per team (Team A / Team B)
        $teamARecord = $patrolSchedules->firstWhere('team_name', 'Team A');
        $teamBRecord = $patrolSchedules->firstWhere('team_name', 'Team B');

        $legacyA = ['kei, inday, kikay', 'kei,inday,kikay', ''];
        $legacyB = ['lily, lolo, lala', 'lily,lolo,lala', ''];

        $teamAPersonnel = ($teamARecord && !in_array(strtolower(trim($teamARecord->personnel_names)), $legacyA))
            ? $teamARecord->personnel_names
            : 'Danilo Cruz, Ramon Santos, Ernesto Reyes';

        $teamBPersonnel = ($teamBRecord && !in_array(strtolower(trim($teamBRecord->personnel_names)), $legacyB))
            ? $teamBRecord->personnel_names
            : 'Eduardo Garcia, Rodrigo Ramos, Nestor Mendoza';

        $todayDate = now()->toDateString();
        $todayDay  = now()->format('l');

        // Team A: Monday, Wednesday, Friday | Team B: Tuesday, Thursday, Saturday, Sunday
        $isTeamAToday = in_array($todayDay, ['Monday', 'Wednesday', 'Friday']);
        $activeTanodTeamName = $isTeamAToday ? 'Team A' : 'Team B';
        $activeTanodMembers  = $isTeamAToday ? $teamAPersonnel : $teamBPersonnel;
        $activeTanodDays     = $isTeamAToday ? 'Monday, Wednesday, Friday' : 'Tuesday, Thursday, Saturday, Sunday';

        $tanodTeams = [
            [
                'team_name'       => 'Team A',
                'days_label'      => 'Monday, Wednesday, Friday',
                'days'            => ['Monday', 'Wednesday', 'Friday'],
                'personnel_names' => $teamAPersonnel,
                'is_active_today' => $isTeamAToday,
            ],
            [
                'team_name'       => 'Team B',
                'days_label'      => 'Tuesday, Thursday, Saturday, Sunday',
                'days'            => ['Tuesday', 'Thursday', 'Saturday', 'Sunday'],
                'personnel_names' => $teamBPersonnel,
                'is_active_today' => !$isTeamAToday,
            ],
        ];

        $tanodWeeklySchedule = [
            ['day' => 'Monday',    'team' => 'Team A', 'days_group' => 'Monday, Wednesday, Friday',          'personnel' => $teamAPersonnel, 'is_active' => ($todayDay === 'Monday')],
            ['day' => 'Tuesday',   'team' => 'Team B', 'days_group' => 'Tuesday, Thursday, Saturday, Sunday', 'personnel' => $teamBPersonnel, 'is_active' => ($todayDay === 'Tuesday')],
            ['day' => 'Wednesday', 'team' => 'Team A', 'days_group' => 'Monday, Wednesday, Friday',          'personnel' => $teamAPersonnel, 'is_active' => ($todayDay === 'Wednesday')],
            ['day' => 'Thursday',  'team' => 'Team B', 'days_group' => 'Tuesday, Thursday, Saturday, Sunday', 'personnel' => $teamBPersonnel, 'is_active' => ($todayDay === 'Thursday')],
            ['day' => 'Friday',    'team' => 'Team A', 'days_group' => 'Monday, Wednesday, Friday',          'personnel' => $teamAPersonnel, 'is_active' => ($todayDay === 'Friday')],
            ['day' => 'Saturday',  'team' => 'Team B', 'days_group' => 'Tuesday, Thursday, Saturday, Sunday', 'personnel' => $teamBPersonnel, 'is_active' => ($todayDay === 'Saturday')],
            ['day' => 'Sunday',    'team' => 'Team B', 'days_group' => 'Tuesday, Thursday, Saturday, Sunday', 'personnel' => $teamBPersonnel, 'is_active' => ($todayDay === 'Sunday')],
        ];

        $tanodSchedulesArray = $patrolSchedules->map(function($p) use ($legacyA, $legacyB) {
            $pNames = $p->personnel_names;
            if (in_array(strtolower(trim($pNames)), $legacyA)) {
                $pNames = 'Danilo Cruz, Ramon Santos, Ernesto Reyes';
            } elseif (in_array(strtolower(trim($pNames)), $legacyB)) {
                $pNames = 'Eduardo Garcia, Rodrigo Ramos, Nestor Mendoza';
            }
            return [
                'id' => $p->id,
                'team_name' => $p->team_name,
                'personnel_names' => $pNames,
                'schedule_date' => $p->schedule_date ? \Carbon\Carbon::parse($p->schedule_date)->format('M d, Y') : 'Regular Duty',
                'day_name' => $p->schedule_date ? \Carbon\Carbon::parse($p->schedule_date)->format('l') : 'Daily',
                'patrol_time' => $p->patrol_time ?: '10:00 PM - 1:00 AM',
                'status' => $p->status ?: 'Active'
            ];
        })->values()->toArray();

        // Determine Active Tanod for today (fallback compatible)
        $activeTanodToday = $patrolSchedules->first(function($p) use ($todayDate, $todayDay) {
            if (!empty($p->schedule_date)) {
                $schedDate = \Carbon\Carbon::parse($p->schedule_date);
                return $schedDate->toDateString() === $todayDate || $schedDate->format('l') === $todayDay;
            }
            return false;
        }) ?? $patrolSchedules->where('status', '!=', 'Completed')->first() ?? $patrolSchedules->first();

        // Fetch Active Projects
        $projects = \App\Models\Project::where('is_active', true)->latest()->get();

        return view('resident.index', compact(
            'requests', 'digitalId', 'resident', 'issueReports', 'sosHistory',
            'announcements', 'events', 'recentUpdates',
            'unreadNotifications', 'allNotifications',
            'carouselSlides', 'orgChartPath',
            'patrolSchedules', 'tanodSchedulesArray', 'activeTanodToday', 'projects',
            'tanodTeams', 'tanodWeeklySchedule', 'activeTanodTeamName', 'activeTanodMembers', 'activeTanodDays'
        ));
    }

    public function storeEmergencySos(Request $request)
    {
        if (auth()->check() && in_array(auth()->user()->status, ['pending_verification', 'declined'])) {
            return response()->json([
                'success' => false,
                'message' => '⚠️ Ang Emergency SOS ay para lamang sa mga opisyal at beripikadong residente ng Barangay San Miguel II.',
            ], 403);
        }

        $request->validate([
            'latitude'       => 'nullable|numeric',
            'longitude'      => 'nullable|numeric',
            'accuracy'       => 'nullable|string',
            'home_address'   => 'nullable|string',
            'emergency_type' => 'required|string',
        ]);

        $landmark = trim($request->landmark ?: ($request->incident_landmark ?: ''));

        if (empty($landmark) || mb_strlen($landmark) < 3) {
            return response()->json([
                'success' => false,
                'message' => '⚠️ Bawal i-submit nang walang landmark o lokasyon! Pakilagay po ang eksaktong lokasyon ng emergency.',
                'errors'  => ['landmark' => ['Kinakailangan ang eksaktong landmark o lokasyon.']]
            ], 422);
        }

        $typeLabels = [
            'general'  => 'General Emergency / Tanod Assistance',
            'security' => 'Security Threat / Disturbance / Intruder',
            'medical'  => 'Medical Emergency / First Responder',
            'fire'     => 'Fire / Hazard Alert',
            'dispute'  => 'Neighborhood Incident / Domestic Disturbance',
        ];
        $rawType = $request->emergency_type;
        $emergencyType = $typeLabels[$rawType] ?? ($rawType ?: 'General Emergency / Tanod Assistance');
        $situationNote = trim($request->message ?: ($request->situation_note ?: $emergencyType));

        $user = auth()->user();
        $name = $user ? trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) : ($request->name ?? 'Resident in Emergency');
        if (empty($name) && $user) {
            $name = $user->name;
        }
        $contact = $user ? ($user->contact_number ?? $user->email) : ($request->contact ?? 'N/A');
        $address = $request->home_address ?: ($user ? ($user->address ?? 'Barangay San Miguel II') : 'Barangay San Miguel II');

        $lat = $request->latitude;
        $lng = $request->longitude;
        $mapsUrl = ($lat && $lng) ? "https://www.google.com/maps?q={$lat},{$lng}" : null;

        $alert = \App\Models\EmergencySosAlert::create([
            'user_id'         => $user?->id,
            'resident_name'   => $name,
            'contact_number'  => $contact,
            'home_address'    => $address,
            'landmark'        => $landmark,
            'emergency_type'  => $emergencyType,
            'message'         => $situationNote,
            'latitude'        => $lat,
            'longitude'       => $lng,
            'accuracy'        => $request->accuracy,
            'google_maps_url' => $mapsUrl,
            'status'          => 'triggered',
            'dispatched_at'   => now(),
        ]);

        // Send emergency alert email to Barangay Hall / Peace & Order team
        $adminEmail = config('mail.from.address') ?: 'brgysanmigueldos@gmail.com';
        $mailData = [
            'alert_id'        => $alert->id,
            'resident_name'   => $name,
            'contact_number'  => $contact,
            'home_address'    => $address,
            'landmark'        => $landmark,
            'emergency_type'  => $emergencyType,
            'message'         => $situationNote,
            'latitude'        => $lat,
            'longitude'       => $lng,
            'accuracy'        => $request->accuracy,
            'google_maps_url' => $mapsUrl,
            'dispatched_at'   => now()->format('F d, Y h:i A'),
        ];
        $residentEmail = $user?->email ?: $request->email;

        // 1. Email Alert to Barangay Hall / Peace & Order Tanod On-Duty
        try {
            \Illuminate\Support\Facades\Mail::send([], [], function ($m) use ($adminEmail, $mailData, $residentEmail) {
                $locationLine = ($mailData['latitude'] && $mailData['longitude'])
                    ? "<p><strong>📍 GPS Location:</strong> <a href=\"{$mailData['google_maps_url']}\" target=\"_blank\" style=\"color:#dc2626;font-weight:bold;\">View on Google Maps ({$mailData['latitude']}, {$mailData['longitude']})</a> (Accuracy: " . htmlspecialchars($mailData['accuracy'] ?? 'N/A') . ")</p>"
                    : "<p><strong>📍 GPS Location:</strong> Coordinates not provided.</p>";

                $landmarkLine = !empty($mailData['landmark'])
                    ? "<p style=\"background:#fef2f2;border-left:4px solid #dc2626;padding:9px 12px;margin:10px 0;color:#991b1b;font-size:13px;\"><strong>📍 Incident Landmark / Location:</strong> " . htmlspecialchars($mailData['landmark']) . "</p>"
                    : "<p><strong>📍 Incident Landmark:</strong> Same as registered address.</p>";

                $situationLine = !empty($mailData['message'])
                    ? "<p style=\"background:#fffbeb;border-left:4px solid #f59e0b;padding:9px 12px;margin:10px 0;color:#92400e;font-size:13px;\"><strong>ℹ️ Situation Reason / Details:</strong> " . htmlspecialchars($mailData['message']) . "</p>"
                    : "";

                $residentEmailLine = $residentEmail
                    ? "<p><strong>📧 Resident Email:</strong> " . htmlspecialchars($residentEmail) . " <em>(Confirmation receipt sent)</em></p>"
                    : "<p><strong>📧 Resident Email:</strong> <em>Not provided / unauthenticated</em></p>";

                $body = "
                <div style=\"font-family:Arial,sans-serif;max-width:600px;margin:0 auto;border:2px solid #dc2626;border-radius:10px;overflow:hidden;\">
                    <div style=\"background:#dc2626;color:#fff;padding:16px 20px;text-align:center;\">
                        <h2 style=\"margin:0;font-size:18px;text-transform:uppercase;letter-spacing:1px;\">🚨 [TANOD DISPATCH ALERT] PEACE & ORDER COMMAND</h2>
                        <p style=\"margin:4px 0 0;font-size:12px;opacity:0.9;\">Barangay San Miguel II — Quick Response Tanod Division</p>
                    </div>
                    <div style=\"padding:20px;color:#1f2937;line-height:1.6;\">
                        <div style=\"background:#fef2f2;border:1px solid #fecaca;padding:10px 14px;border-radius:6px;color:#991b1b;font-weight:bold;margin-bottom:12px;\">
                            📢 OFFICIAL NOTICE FOR BARANGAY ON-DUTY OFFICERS: A resident has triggered an emergency SOS. Please coordinate immediate dispatch.
                        </div>
                        <div style=\"background:#eff6ff;border:1px solid #bfdbfe;padding:9px 12px;border-radius:6px;color:#1e40af;font-size:11.5px;margin-bottom:15px;\">
                            ℹ️ <em>This alert was transmitted to the Barangay Command Center (<code>{$adminEmail}</code>) for patrol unit dispatch. A separate confirmation receipt has been sent to the resident's registered email.</em>
                        </div>
                        <p><strong>🚨 Emergency Nature:</strong> <span style=\"color:#dc2626;font-weight:bold;\">" . htmlspecialchars($mailData['emergency_type']) . "</span></p>
                        <p><strong>👤 Resident Name:</strong> " . htmlspecialchars($mailData['resident_name']) . "</p>
                        <p><strong>📞 Contact Number:</strong> " . htmlspecialchars($mailData['contact_number']) . "</p>
                        {$residentEmailLine}
                        <p><strong>🏠 Registered Home Address:</strong> " . htmlspecialchars($mailData['home_address']) . "</p>
                        {$landmarkLine}
                        {$situationLine}
                        {$locationLine}
                        <p><strong>🕒 Time Dispatched:</strong> {$mailData['dispatched_at']}</p>
                        <hr style=\"border:0;border-top:1px solid #e5e7eb;margin:15px 0;\">
                        <div style=\"background:#dc2626;color:#fff;padding:12px;border-radius:8px;text-align:center;font-weight:bold;\">
                            ⚠️ ACTION REQUIRED: Dispatch nearest patrol officers and check Peace & Order Dashboard.
                        </div>
                    </div>
                </div>";

                $m->to($adminEmail);
                if (!empty($residentEmail) && filter_var($residentEmail, FILTER_VALIDATE_EMAIL)) {
                    $m->replyTo($residentEmail, $mailData['resident_name']);
                }
                $m->subject("🚨 [TANOD DISPATCH ALERT] {$mailData['emergency_type']} — {$mailData['resident_name']}")
                  ->html($body);
            });
            \Illuminate\Support\Facades\Log::info("SOS Admin alert sent to {$adminEmail}");
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('SOS Admin Email failed: ' . $e->getMessage());
        }

        // 2. Email Confirmation Receipt directly to the Resident's personal email
        if (!empty($residentEmail) && filter_var($residentEmail, FILTER_VALIDATE_EMAIL)) {
            try {
                \Illuminate\Support\Facades\Mail::send([], [], function ($m) use ($residentEmail, $mailData) {
                    $landmarkLine = !empty($mailData['landmark'])
                        ? "<p style=\"background:#fef2f2;border-left:4px solid #dc2626;padding:10px 14px;margin:10px 0;color:#991b1b;font-size:13px;\"><strong>📍 Reported Landmark / Location:</strong> " . htmlspecialchars($mailData['landmark']) . "</p>"
                        : "<p><strong>📍 Reported Location:</strong> " . htmlspecialchars($mailData['home_address']) . "</p>";

                    $situationLine = !empty($mailData['message'])
                        ? "<p style=\"background:#fffbeb;border-left:4px solid #f59e0b;padding:10px 14px;margin:10px 0;color:#92400e;font-size:13px;\"><strong>ℹ️ Situation Reason / Details:</strong> " . htmlspecialchars($mailData['message']) . "</p>"
                        : "";

                    $body = "
                    <div style=\"font-family:Arial,sans-serif;max-width:600px;margin:0 auto;border:2px solid #dc2626;border-radius:10px;overflow:hidden;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);\">
                        <div style=\"background:#dc2626;color:#ffffff;padding:18px 20px;text-align:center;\">
                            <h2 style=\"margin:0;font-size:19px;font-weight:bold;text-transform:uppercase;letter-spacing:1px;\">🚨 EMERGENCY SOS RECEIVED & ACKNOWLEDGED</h2>
                            <p style=\"margin:4px 0 0;font-size:12px;opacity:0.95;\">Barangay San Miguel II — Peace & Order Quick Response</p>
                        </div>
                        <div style=\"padding:22px;color:#1f2937;line-height:1.6;\">
                            <p style=\"font-size:15px;margin-top:0;\">Dear <strong>" . htmlspecialchars($mailData['resident_name']) . "</strong>,</p>
                            
                            <div style=\"background:#f0fdf4;border-left:4px solid #16a34a;padding:12px 14px;margin:12px 0;color:#166534;border-radius:0 8px 8px 0;font-size:13.5px;\">
                                <strong>✅ Your distress signal has been received by our command center!</strong><br>
                                Our on-duty Barangay Tanods and Peace & Order team have been alerted and dispatched to assist you.
                            </div>

                            <hr style=\"border:0;border-top:1px solid #e5e7eb;margin:16px 0;\">
                            <h4 style=\"margin:0 0 10px;color:#111827;font-size:13px;text-transform:uppercase;letter-spacing:0.5px;\">📋 Transmission Summary:</h4>
                            <p style=\"margin:4px 0;\"><strong>🚨 Emergency Type:</strong> <span style=\"color:#dc2626;font-weight:bold;\">" . htmlspecialchars($mailData['emergency_type']) . "</span></p>
                            <p style=\"margin:4px 0;\"><strong>👤 Reported By:</strong> " . htmlspecialchars($mailData['resident_name']) . "</p>
                            <p style=\"margin:4px 0;\"><strong>📞 Contact on Record:</strong> " . htmlspecialchars($mailData['contact_number']) . "</p>
                            {$landmarkLine}
                            {$situationLine}
                            <p style=\"margin:4px 0;\"><strong>🕒 Dispatched At:</strong> {$mailData['dispatched_at']}</p>

                            <hr style=\"border:0;border-top:1px solid #e5e7eb;margin:16px 0;\">
                            <div style=\"background:#fef2f2;border:1px solid #fecaca;padding:12px 14px;border-radius:8px;margin:12px 0;\">
                                <h4 style=\"margin:0 0 6px;color:#991b1b;font-size:13px;\">⚠️ SAFETY REMINDERS WHILE WAITING:</h4>
                                <ul style=\"margin:0;padding-left:18px;color:#7f1d1d;font-size:12.5px;line-height:1.6;\">
                                    <li>Stay calm and remain in a safe, visible or secured spot.</li>
                                    <li>Keep your phone line open in case our responding officers need to call you.</li>
                                    <li>If you need direct phone assistance, call any of our 24/7 hotlines below immediately.</li>
                                </ul>
                            </div>

                            <div style=\"background:#f8fafc;border:1px solid #e2e8f0;padding:12px 14px;border-radius:8px;margin:12px 0;\">
                                <h4 style=\"margin:0 0 6px;color:#334155;font-size:12px;text-transform:uppercase;\">📞 24/7 Emergency Hotlines:</h4>
                                <p style=\"margin:3px 0;font-size:12.5px;\">🏢 <strong>Barangay San Miguel II Hall:</strong> (046) 416-0245 / 0917-828-SM22</p>
                                <p style=\"margin:3px 0;font-size:12.5px;\">🚓 <strong>PNP Dasmariñas Police:</strong> (046) 416-0252 / 117</p>
                                <p style=\"margin:3px 0;font-size:12.5px;\">🚒 <strong>BFP Dasmariñas Fire Station:</strong> (046) 416-0253</p>
                                <p style=\"margin:3px 0;font-size:12.5px;\">🚑 <strong>City Emergency Hotline:</strong> 911 / (046) 416-0245</p>
                            </div>

                            <p style=\"font-size:11.5px;color:#6b7280;margin-top:16px;text-align:center;\">
                                Automated emergency notification from Barangay San Miguel II, City of Dasmariñas, Cavite.
                            </p>
                        </div>
                    </div>";

                    $m->to($residentEmail)
                      ->subject("🚨 [SOS CONFIRMATION] Emergency Assistance Received — Barangay San Miguel II")
                      ->html($body);
                });
                \Illuminate\Support\Facades\Log::info("SOS Resident confirmation email sent to {$residentEmail}");
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('SOS Resident Email failed for ' . $residentEmail . ': ' . $e->getMessage());
            }
        }

        // In-app notification for the resident themselves
        if ($user) {
            try {
                $user->notifications()->create([
                    'id' => (string) \Illuminate\Support\Str::uuid(),
                    'type' => 'App\Notifications\EmergencySosTriggered',
                    'data' => [
                        'type'           => 'emergency_sos_receipt',
                        'title'          => "🚨 SOS Dispatched: {$emergencyType}",
                        'message'        => "Your emergency distress signal was received. Barangay Tanod responders are alerted.",
                        'emergency_type' => $emergencyType,
                        'landmark'       => $landmark,
                        'alert_id'       => $alert->id,
                    ],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('SOS Resident In-App Notif failed: ' . $e->getMessage());
            }
        }

        // In-app notifications to all Peace & Order and Admin users
        try {
            $officers = \App\Models\User::whereIn('role', ['peace', 'admin'])->get();
            $notifDesc = "Resident {$name} triggered an SOS ({$emergencyType})." . ($landmark ? " Landmark: {$landmark}." : " Address: {$address}.") . ($situationNote ? " Details: {$situationNote}" : '');
            foreach ($officers as $officer) {
                $officer->notifications()->create([
                    'id' => (string) \Illuminate\Support\Str::uuid(),
                    'type' => 'App\Notifications\EmergencySosTriggered',
                    'data' => [
                        'type'           => 'emergency_sos',
                        'title'          => "🚨 Emergency SOS: {$emergencyType}!",
                        'message'        => $notifDesc,
                        'emergency_type' => $emergencyType,
                        'landmark'       => $landmark,
                        'situation_note' => $situationNote,
                        'alert_id'       => $alert->id,
                        'maps_url'       => $mapsUrl,
                    ],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('SOS In-App Notif failed: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Emergency SOS alert dispatched successfully to Barangay Peace & Order team!',
            'alert_id' => $alert->id,
            'resident_email' => $residentEmail,
        ]);
    }

    public function markNotificationsRead()
    {
        if (auth()->check()) {
            auth()->user()->unreadNotifications->markAsRead();
        }
        return response()->json(['success' => true]);
    }

    public function uploadProfilePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:5120', // Max 5MB
        ]);

        $user = auth()->user();

        // Check 6-month cooldown for profile picture updates
        if ($user->photo_updated_at && $user->photo_updated_at->copy()->addMonths(6)->isFuture()) {
            return redirect()->back()->with('error', 'You can only update your profile picture once every 6 months. Please try again after ' . $user->photo_updated_at->copy()->addMonths(6)->format('M d, Y') . '.');
        }

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile_photos', 'public');
            
            $user->update([
                'photo' => $photoPath,
                'photo_updated_at' => now(),
            ]);

            if ($user->resident) {
                $user->resident->update(['photo' => $photoPath]);
            }
        }

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }

    public function storeFamilyMember(Request $request)
    {
        if (auth()->check() && in_array(auth()->user()->status, ['pending_verification', 'declined'])) {
            return redirect()->back()->with('error', '⚠️ Ang pagdaragdag ng miyembro ng pamilya sa Masterlist ay para lamang sa mga beripikadong residente. Pakilagay ang mga kasamang lilipat sa inyong Move-In certificate request.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'relationship' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'required|string',
            'civil_status' => 'required|string',
            'is_voter' => 'nullable|in:0,1',
            'classification' => 'nullable|string',
            'senior_proof' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'pwd_proof' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'bedridden_proof' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);

        try {
            $user = auth()->user();
            $headResident = $user->resident 
                ?? Resident::where('user_id', $user->id)->first()
                ?? ($user->resident_code ? Resident::where('resident_code', $user->resident_code)->first() : null);

            if (!$headResident && $user->first_name && $user->last_name) {
                $headResident = Resident::whereRaw('LOWER(first_name) = ?', [strtolower($user->first_name)])
                    ->whereRaw('LOWER(last_name) = ?', [strtolower($user->last_name)])
                    ->first();
                if ($headResident && !$headResident->user_id) {
                    $headResident->update(['user_id' => $user->id]);
                }
            }

            if (!$headResident) {
                $prefix = strtoupper(substr($user->last_name ?? 'R', 0, 1) . substr($user->first_name ?? 'U', 0, 1));
                $random = strtoupper(substr(uniqid(), -6));
                $headResident = Resident::create([
                    'user_id'             => $user->id,
                    'resident_code'       => $user->resident_code ?? "R-{$prefix}-{$random}",
                    'first_name'          => $user->first_name ?? ($user->name ? explode(' ', $user->name)[0] : 'Resident'),
                    'middle_name'         => $user->middle_name,
                    'last_name'           => $user->last_name ?? ($user->name ? (explode(' ', $user->name)[1] ?? '') : 'User'),
                    'birthday'            => $user->birthday ?? now()->subYears(20)->toDateString(),
                    'birthplace'          => !empty($user->birthplace) ? $user->birthplace : 'Barangay San Miguel II, Dasmariñas, Cavite',
                    'gender'              => $user->gender ?? 'Other',
                    'civil_status'        => $user->civil_status ?? 'Single',
                    'address'             => $user->address ?? 'Barangay San Miguel II',
                    'is_voter'            => (bool)($user->is_voter ?? false),
                    'is_non_voter'        => (bool)($user->is_non_voter ?? false),
                    'is_senior'           => (bool)($user->is_senior ?? false),
                    'is_household_head'   => true,
                    'verification_status' => 'approved',
                ]);
                $user->update(['resident_code' => $headResident->resident_code]);
            } else {
                if (!$headResident->user_id) {
                    $headResident->update(['user_id' => $user->id]);
                }
            }

            $classification = $request->classification;
            $calcAge = !empty($request->birthday) ? \Carbon\Carbon::parse($request->birthday)->age : (int)$request->age;
            $age = $calcAge > 0 ? $calcAge : (int)$request->age;
            $isSenior = ($age >= 60) || ($classification === 'Senior');
            $isVoter = $request->input('is_voter') == '1' || $request->input('classification') === 'Voter';

            // 1. Check if resident already exists in masterlist (First Name + Last Name + Birthday)
            $existing = Resident::where('first_name', 'LIKE', $request->first_name)
                ->where('last_name', 'LIKE', $request->last_name)
                ->where('birthday', $request->birthday)
                ->first();

            if ($existing) {
                $existingAge = !empty($existing->birthday) ? \Carbon\Carbon::parse($existing->birthday)->age : ($existing->age ?? 0);
                $isSenior = ($existingAge >= 60) || ($existing->age >= 60) || ($isSenior) || $existing->is_senior;

                $updateData = [
                    'household_head_id'   => $headResident->id,
                    'is_household_head'   => false,
                    'relationship'        => $request->relationship,
                    'verification_status' => 'approved', // Skip pending for masterlist members
                    'is_voter'            => $isVoter,
                    'is_non_voter'        => !$isVoter,
                    'is_senior'           => $isSenior,
                ];

                if ($classification === 'Bed-ridden') $updateData['is_bedridden'] = true;
                if ($classification === 'PWD') $updateData['is_pwd'] = true;
                if ($classification === 'Solo Parent') $updateData['is_single_parent'] = true;
                if ($classification === 'Student') $updateData['is_student'] = true;

                $existing->update($updateData);

                return redirect()->route('resident.index')->with('success', 'Family member matched with Masterlist! They have been added to your family automatically.');
            }

            // 2. Otherwise, create a new pending resident record
            $resident = new Resident();
            $resident->first_name = $request->first_name;
            $resident->middle_name = $request->middle_name;
            $resident->last_name = $request->last_name;
            $resident->suffix = $request->suffix;
            $resident->relationship = $request->relationship;
            $resident->birthday = $request->birthday;
            $resident->age = $age;
            $resident->birthplace = !empty($headResident->birthplace) ? $headResident->birthplace : (!empty($user->birthplace) ? $user->birthplace : 'Barangay San Miguel II, Dasmariñas, Cavite');
            $resident->gender = $request->gender;
            $resident->civil_status = $request->civil_status;
            $resident->address = $headResident->address ?? $user->address ?? 'Barangay San Miguel II';
            
            $resident->is_voter = $isVoter;
            $resident->is_non_voter = !$isVoter;
            $resident->voter_status = $isVoter ? 'pending' : 'non-voter';
            
            $resident->is_senior = $isSenior;
            $resident->is_pwd = ($classification === 'PWD');
            $resident->is_single_parent = ($classification === 'Solo Parent');
            $resident->is_student = ($classification === 'Student');
            $resident->is_bedridden = ($classification === 'Bed-ridden');

            // Handle Proof Uploads
            if ($request->hasFile('senior_proof')) {
                $resident->senior_proof = $request->file('senior_proof')->store('proofs/senior', 'public');
            }
            if ($request->hasFile('pwd_proof')) {
                $resident->pwd_proof = $request->file('pwd_proof')->store('proofs/pwd', 'public');
            }
            if ($request->hasFile('bedridden_proof')) {
                $resident->bedridden_proof = $request->file('bedridden_proof')->store('proofs/bedridden', 'public');
            }

            $resident->household_head_id = $headResident->id;
            $resident->is_household_head = false;
            $resident->verification_status = 'pending';

            // Auto-generate code
            $prefix = strtoupper(substr($resident->last_name, 0, 1) . substr($resident->first_name, 0, 1));
            $random = strtoupper(substr(uniqid(), -6));
            $resident->resident_code = "R-{$prefix}-{$random}";

            $resident->save();

            return redirect()->route('resident.index')->with('success', 'Family member added and is pending approval (Resident not found in Masterlist).');
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Error adding family member: ' . $e->getMessage());
            return redirect()->route('resident.index')->with('error', 'Error adding family member: ' . $e->getMessage());
        }
    }

    public function requestDigitalId(Request $request)
    {
        $request->validate([
            'contact_person'        => 'required|string|max:255',
            'contact_person_number' => 'required|digits:11',
        ]);

        $user = auth()->user();
        if ($user && in_array($user->status, ['pending_verification', 'declined'])) {
            return redirect()->route('resident.index')
                ->with('error', '⚠️ Your account is currently not verified by the Barangay Office. Digital ID requests will be unlocked once approved.');
        }

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

    public function reuploadVoterId(Request $request)
    {
        $request->validate([
            'voter_id_photo' => 'required|image|max:5120',
        ]);

        $user = auth()->user();
        if ($request->hasFile('voter_id_photo')) {
            $photoPath = $request->file('voter_id_photo')->store('voter_ids', 'public');
            
            $user->update([
                'voter_id_photo' => $photoPath,
                'voter_status' => 'pending',
                'status' => 'pending_verification',
                'decline_reason' => null,
            ]);

            if ($user->resident) {
                $user->resident->update([
                    'voter_status' => 'pending',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Voter verification proof re-uploaded successfully. Awaiting office approval.');
    }

    public function storeDocumentRequest(Request $request)
    {
        if (auth()->check() && in_array(auth()->user()->status, ['pending_verification', 'declined'])) {
            if ($request->document_type !== 'movein') {
                return redirect()->back()
                    ->withInput()
                    ->with('error', '⚠️ Ang inyong account ay kasalukuyang hindi pa beripikado ng Barangay Office. Tanging Move-In certificate request lamang ang maaaring hilingin ng mga bagong residente.');
            }
        }

        if (!auth()->check()) {
            $request->validate([
                'guest_first_name' => 'required|string|max:255',
                'guest_last_name'  => 'required|string|max:255',
                'guest_email'      => 'required|email|regex:/@gmail\.com$/i',
                'id_proof'         => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
                'document_type'    => 'required|string',
                'appointment_date' => 'nullable|date|after_or_equal:today',
                'appointment_time' => 'nullable',
            ], [
                'guest_email.regex' => 'Only Gmail addresses are allowed.',
            ]);
        } else {
            $request->validate([
                'document_type' => 'required|string',
                'appointment_date' => 'nullable|date|after_or_equal:today',
                'appointment_time' => 'nullable',
                'claimant_type' => 'required|in:self,authorized',
                'authorization_letter' => 'exclude_unless:claimant_type,authorized|required|file|mimes:jpeg,png,jpg,pdf|max:5120',
                'authorized_id' => 'exclude_unless:claimant_type,authorized|required|file|mimes:jpeg,png,jpg,pdf|max:5120',
                'applicants' => 'exclude_unless:claimant_type,authorized|required|array|min:1|max:2',
                'applicants.*.first_name' => 'exclude_unless:claimant_type,authorized|required|string|max:255',
                'applicants.*.last_name'  => 'exclude_unless:claimant_type,authorized|required|string|max:255',
                'applicants.*.relation'   => 'exclude_unless:claimant_type,authorized|required|string|max:255',
            ]);

            // JOBSEEKER LIFETIME LIMIT (for self)
            if ($request->document_type === 'jobseeker' && $request->claimant_type === 'self') {
                $exists = DocumentRequest::where('user_id', auth()->id())
                    ->where('document_type', 'jobseeker')
                    ->where('claimant_type', 'self')
                    ->exists();
                
                if ($exists) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', '⚠️ You have already requested a 1st Time Job Seeker certificate before. This document can only be requested once per person.');
                }
            }

            // LIMIT FOR AUTHORIZED PERSONS (Max 2 active requests total)
            if ($request->claimant_type === 'authorized') {
                $existingActive = DocumentRequest::where('user_id', auth()->id())
                    ->where('claimant_type', 'authorized')
                    ->whereIn('status', ['pending', 'processing'])
                    ->count();
                
                $newCount = count($request->applicants ?? []);
                
                if (($existingActive + $newCount) > 2) {
                    $remaining = 2 - $existingActive;
                    $msg = $existingActive > 0 
                        ? "You already have $existingActive active request(s). You can only add $remaining more."
                        : "Only 2 application requests by an Authorized Representative shall be accepted at a time.";
                    
                    return redirect()->back()
                        ->withInput()
                        ->with('error', $msg);
                }
            }
        }

        $userId = auth()->id();

        // Handle Claimant Files
        $authLetterPath = null;
        $authIdPath = null;
        if ($request->file('authorization_letter')) {
            $authLetterPath = $request->file('authorization_letter')->store('authorization_letters', 'public');
        }
        if ($request->file('authorized_id')) {
            $authIdPath = $request->file('authorized_id')->store('authorized_ids', 'public');
        }

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
        }

        $commonData = [
            'document_type'             => $request->document_type,
            'claimant_type'             => $request->claimant_type ?? 'self',
            'authorization_letter_path' => $authLetterPath,
            'authorized_id_path'        => $authIdPath,
            'appointment_date'           => $request->appointment_date,
            'appointment_time'           => $request->appointment_time,
            'status'                    => 'pending',
            'user_id'                   => $userId,
        ];

        // Capacity Check: Max 10 per slot (only if appointment date/time are specified)
        if ($request->filled('appointment_date') && $request->filled('appointment_time')) {
            $count = DocumentRequest::where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->whereNotIn('status', ['disapproved'])
                ->count();
            
            if ($count >= 10) {
                return redirect()->back()->withInput()->with('error', 'The selected time slot has reached its maximum capacity (10 requests). Please choose another time.');
            }
        }

        if ($request->claimant_type === 'authorized' && $request->has('applicants')) {
            foreach ($request->applicants as $app) {
                $data = array_merge($commonData, [
                    'purpose'                   => $app['purpose'] ?? $request->purpose,
                    'address'                   => $app['address'] ?? $request->address,
                    'contact'                   => $app['contact'] ?? $request->contact,
                    'claimant_first_name'       => $app['first_name'],
                    'claimant_middle_name'      => $app['middle_name'] ?? null,
                    'claimant_last_name'        => $app['last_name'],
                    'claimant_relation'         => $app['relation'],
                    'claimant_name'             => $app['first_name'] . ' ' . $app['last_name'],
                    'blk'                       => $request->blk,
                    'lot'                       => $request->lot,
                    'move_date'                 => $request->move_date,
                    'landlord'                  => $request->landlord,
                    'family_members'            => $request->family_members,
                    'age'                       => $app['age'] ?? null,
                    'birthday'                  => $app['birthday'] ?? null,
                ]);
                $docRequest = DocumentRequest::create($data);
                $this->notifyUser($docRequest);
            }
        } else {
            // Self or Guest
            $age = $request->age;
            $birthday = $request->birthday;

            // If registered resident, auto-fill age/birthday from profile if empty
            if (auth()->check()) {
                if (auth()->user()->resident) {
                    $res = auth()->user()->resident;
                    if (!$age) {
                        $age = $res->birthday ? \Carbon\Carbon::parse($res->birthday)->age : null;
                    }
                    if (!$birthday) {
                        $birthday = $res->birthday;
                    }
                } elseif (auth()->user()->birthday) {
                    if (!$birthday) {
                        $birthday = auth()->user()->birthday;
                    }
                    if (!$age) {
                        $age = \Carbon\Carbon::parse(auth()->user()->birthday)->age;
                    }
                }
            }

            $data = array_merge($commonData, [
                'guest_first_name' => $request->guest_first_name,
                'guest_last_name'  => $request->guest_last_name,
                'guest_email'      => $request->guest_email,
                'id_proof'         => $request->hasFile('id_proof') ? $request->file('id_proof')->store('guest_ids', 'public') : null,
                'purpose'          => $request->purpose,
                'address'          => $request->address,
                'contact'          => $request->contact,
                'blk'              => $request->blk,
                'lot'              => $request->lot,
                'move_date'        => $request->move_date,
                'landlord'         => $request->landlord,
                'family_members'   => $request->family_members,
                'age'              => $age,
                'birthday'         => $birthday,
                'ward_name'        => $request->ward_name,
                'ward_age'         => $request->ward_age,
                'ward_relation'    => $request->ward_relation,
                'partner_name'     => $request->partner_name,
                'living_since'     => $request->living_since,
                'birth_month'      => $request->birth_month,
                'birth_year'       => $request->birth_year,
                'child_name'       => $request->child_name,
                'father_name'      => $request->father_name,
                'mother_name'      => $request->mother_name,
                'birth_attendant'  => $request->birth_attendant,
                'born_from'        => $request->born_from,
                'residing_since'   => $request->residing_since,
                'claimant_name'    => auth()->check() ? (auth()->user()->first_name . ' ' . auth()->user()->last_name) : ($request->guest_first_name . ' ' . $request->guest_last_name),
            ]);
            $docRequest = DocumentRequest::create($data);
            $this->notifyUser($docRequest);
        }

        $destEmail = auth()->check() ? auth()->user()->email : $request->guest_email;
        $msg = auth()->check() 
            ? ('✅ Document request(s) submitted! A confirmation receipt has been sent to ' . ($destEmail ?: 'your registered email') . '.')
            : ('✅ Guest request sent! ' . ($destEmail ? 'A confirmation receipt has been sent to ' . $destEmail . '.' : 'Please personally go to the Barangay Hall and bring a Valid ID.'));

        return redirect()->route('resident.index')->with('success', $msg);
    }

    private function notifyUser($docRequest)
    {
        try {
            if (auth()->check()) {
                auth()->user()->notify(new \App\Notifications\DocumentRequestReceived($docRequest));
                \Illuminate\Support\Facades\Log::info('DocumentRequestReceived sent to user ' . auth()->user()->email);
            } elseif (!empty($docRequest->guest_email)) {
                \Illuminate\Support\Facades\Notification::route('mail', $docRequest->guest_email)
                    ->notify(new \App\Notifications\DocumentRequestReceived($docRequest));
                \Illuminate\Support\Facades\Log::info('DocumentRequestReceived sent to guest ' . $docRequest->guest_email);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Failed to notify user for document request: ' . $e->getMessage());
        }
    }

    public function storeIssueReport(Request $request)
    {
        if (auth()->check()) {
            if (in_array(auth()->user()->status, ['pending_verification', 'declined'])) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', '⚠️ Your account is currently not verified by the Barangay Office. Reporting issues/blotters will be unlocked once approved.');
            }

            $activeReport = IssueReport::where('user_id', auth()->id())
                ->whereNotIn('status', ['resolved', 'closed', 'dismissed', 'disapproved', 'settled', 'rejected'])
                ->first();

            if ($activeReport) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'This report cannot be submitted. Please wait for your current report to be settled before filing another. Thank you.');
            }
        }

        $request->validate([
            'issue_type'       => 'required|string',
            'complainant_name' => 'required|string',
            'contact'          => 'required|digits:11',
            'respondent_name'  => 'required|string',
            'description'      => 'required|string',
            'incident_date'    => 'required|date|after_or_equal:' . now()->subMonths(6)->toDateString(),
        ]);

        $rawIssueType = $request->issue_type;
        $issueType = $rawIssueType === 'Others'
            ? ($request->issue_type_other ?? 'Others')
            : $rawIssueType;

        $isOnBehalf = $request->boolean('is_on_behalf') || $request->input('is_on_behalf') === '1' || $request->input('is_on_behalf') === 'true';
        $victimName = $isOnBehalf ? $request->victim_name : null;
        $victimAge = $isOnBehalf && $request->filled('victim_age') ? (int)$request->victim_age : null;
        $victimGender = $isOnBehalf ? $request->victim_gender : null;
        $victimRelationship = $isOnBehalf ? $request->victim_relationship : null;

        $effectiveGender = $isOnBehalf ? $victimGender : $request->complainant_gender;
        $effectiveAge = $isOnBehalf ? $victimAge : ($request->filled('complainant_age') ? (int)$request->complainant_age : null);

        // Perform Multilingual Keyword Auto-Routing Triage (Tagalog, English, Taglish)
        $triage = $this->autoRouteTriage($rawIssueType, $issueType, $request->description, $effectiveGender, $effectiveAge);
        $department = $triage['department'];
        $status = $triage['status'];
        $isRestricted = $triage['is_restricted'];
        $adminNotes = $triage['admin_notes'];

        $evidencePaths = [];
        if ($request->hasFile('evidence')) {
            foreach ($request->file('evidence') as $file) {
                $evidencePaths[] = $file->store('issue_evidence', 'public');
            }
        }

        $report = IssueReport::create([
            'user_id'            => auth()->id(),
            'issue_type'         => $issueType,
            'complainant_name'   => $request->complainant_name,
            'complainant_age'    => $request->complainant_age,
            'complainant_gender' => $request->complainant_gender,
            'complainant_address'=> $request->complainant_address,
            'is_on_behalf'       => $isOnBehalf,
            'victim_name'        => $victimName,
            'victim_age'         => $victimAge,
            'victim_gender'      => $victimGender,
            'victim_relationship'=> $victimRelationship,
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
            'status'             => $status,
            'admin_notes'        => $adminNotes,
            'is_restricted'      => $isRestricted,
            'guest_email'        => $request->guest_email,
        ]);

        // Log creation into VAWC audit trail if routed to VAWC
        if ($department === 'VAWC') {
            $caseCode = 'VAWC-' . $report->created_at->format('Y') . '-' . str_pad($report->id, 3, '0', STR_PAD_LEFT);
            if ($triage['auto_flagged']) {
                $matchedList = !empty($triage['matched']) ? implode(', ', array_unique($triage['matched'])) : 'Keyword match';
                \App\Models\VawcAuditLog::log(
                    action: 'auto_triage_flag',
                    caseId: $report->id,
                    caseCode: $caseCode,
                    details: "Auto-routed and flagged to VAWC Desk via Multilingual Keyword Triage (Matched term(s): {$matchedList}) from resident narration."
                );
            } else {
                \App\Models\VawcAuditLog::log(
                    action: 'incident_created',
                    caseId: $report->id,
                    caseCode: $caseCode,
                    details: "New incident filed (" . ($isOnBehalf ? "On behalf of victim: {$victimName}" : "Direct by complainant") . ") — Type: {$issueType}"
                );
            }
        }

        // If it's a guest or if we have an email, send the notification
        $targetEmail = $request->guest_email ?? auth()->user()?->email;
        if ($targetEmail) {
            Mail::to($targetEmail)->send(new ComplaintReportReceivedMail($report));
        }

        return redirect()->route('resident.index')
            ->with('success', 'Issue report submitted! Please check your email for the next steps.');
    }

    /**
     * Multilingual Auto-Routing Triage Logic (Tagalog, English, Taglish)
     */
    private function autoRouteTriage(string $rawIssueType, string $issueType, string $description, ?string $effectiveGender = null, ?int $effectiveAge = null): array
    {
        $normalizedText = mb_strtolower($description . ' ' . $issueType, 'UTF-8');

        // Multilingual Keyword Dictionary
        $dictionary = [
            'Physical Abuse' => [
                'binugbog', 'pinalo', 'sinaktan', 'sinuntok', 'sinipa', 'tinutukan', 'hinampas', 'slapped', 'beaten', 'hit', 'assault'
            ],
            'Sexual Abuse / Harassment' => [
                'ginagahasa', 'hinipuan', 'pambabastos', 'nambabastos', 'raped', 'groped', 'harassed', 'molested'
            ],
            'Domestic / Sexual Identity Context' => [
                'asawa', 'kinakasama', 'mister', 'misis', 'live-in', 'ex-partner', 'husband', 'wife', 'minor', 'child', 'anak'
            ],
            'Intimidation / Threats' => [
                'tinatakot', 'pinagbantaan', 'dinadahas', 'threatened', 'abused', 'stalked'
            ]
        ];

        $matchedKeywords = [];
        foreach ($dictionary as $category => $keywords) {
            foreach ($keywords as $kw) {
                if (mb_stripos($normalizedText, $kw) !== false) {
                    $matchedKeywords[] = $kw;
                }
            }
        }

        // 1. Explicit VAWC Categories
        $vawcCategories = [
            'VAWC', 'Domestic Violence', 'Sexual Harassment', 'Child Abuse', 
            'Economic Abuse', 'Psychological Abuse', 'Physical Abuse', 'Stalking'
        ];
        foreach ($vawcCategories as $vkw) {
            if (mb_stripos($issueType, $vkw) !== false) {
                return [
                    'department'    => 'VAWC',
                    'status'        => 'submitted',
                    'is_restricted' => true,
                    'auto_flagged'  => false,
                    'matched'       => [],
                    'admin_notes'   => null,
                ];
            }
        }

        // 2. Minor victim child protection (< 18)
        if ($effectiveAge !== null && $effectiveAge < 18) {
            if (mb_stripos($issueType, 'Assault') !== false || mb_stripos($issueType, 'Abuse') !== false || mb_stripos($issueType, 'Harassment') !== false || !empty($matchedKeywords)) {
                return [
                    'department'    => 'VAWC',
                    'status'        => 'under_review',
                    'is_restricted' => true,
                    'auto_flagged'  => true,
                    'matched'       => $matchedKeywords,
                    'admin_notes'   => 'UNDER REVIEW (AUTO-FLAGGED) — Minor dependent involved. Routed to VAWC Desk.',
                ];
            }
        }

        // 3. Sensitive female victim
        $isSensitiveType = ($issueType === 'Physical Assault' || mb_stripos($issueType, 'Harassment') !== false || mb_stripos($issueType, 'Assault') !== false);
        if ($isSensitiveType && strtolower((string)$effectiveGender) === 'female') {
            return [
                'department'    => 'VAWC',
                'status'        => 'under_review',
                'is_restricted' => true,
                'auto_flagged'  => true,
                'matched'       => $matchedKeywords,
                'admin_notes'   => 'UNDER REVIEW (AUTO-FLAGGED) — Female assault / harassment case.',
            ];
        }

        // 4. Multilingual Keyword Match (When filed under "Others" or any unclassified type/description)
        if (!empty($matchedKeywords)) {
            $matchedList = implode(', ', array_unique($matchedKeywords));
            return [
                'department'    => 'VAWC',
                'status'        => 'under_review',
                'is_restricted' => true,
                'auto_flagged'  => true,
                'matched'       => $matchedKeywords,
                'admin_notes'   => "UNDER REVIEW (AUTO-FLAGGED) — Multilingual keyword triage matched: [{$matchedList}]. Automatically routed to VAWC Desk.",
            ];
        }

        // 5. Unclassified / "Others" with No Match -> Peace & Order under "PENDING CLASSIFICATION"
        if ($rawIssueType === 'Others' || stripos($issueType, 'Others') !== false) {
            return [
                'department'    => 'Peace & Order',
                'status'        => 'submitted',
                'is_restricted' => false,
                'auto_flagged'  => false,
                'matched'       => [],
                'admin_notes'   => 'PENDING CLASSIFICATION — Unclassified incident filed under Others. Assigned to Peace & Order Desk.',
            ];
        }

        // 6. Default standard Peace & Order
        return [
            'department'    => 'Peace & Order',
            'status'        => 'submitted',
            'is_restricted' => $this->checkRestrictions($description),
            'auto_flagged'  => false,
            'matched'       => [],
            'admin_notes'   => null,
        ];
    }

    private function routeDepartment(string $issueType, ?string $effectiveGender = null, ?int $effectiveAge = null): string
    {
        $vawcKeywords  = [
            'VAWC', 'Domestic Violence', 'Sexual Harassment', 'Child Abuse', 
            'Economic Abuse', 'Psychological Abuse', 'Physical Abuse', 'Stalking'
        ];

        foreach ($vawcKeywords as $kw) { 
            if (stripos($issueType, $kw) !== false) {
                return 'VAWC'; 
            }
        }

        if ($effectiveAge !== null && $effectiveAge < 18) {
            if (stripos($issueType, 'Assault') !== false || stripos($issueType, 'Abuse') !== false || stripos($issueType, 'Harassment') !== false) {
                return 'VAWC';
            }
        }

        $isSensitiveType = ($issueType === 'Physical Assault' || stripos($issueType, 'Harassment') !== false || stripos($issueType, 'Assault') !== false);
        if ($isSensitiveType && strtolower((string)$effectiveGender) === 'female') {
            return 'VAWC';
        }

        return 'Peace & Order';
    }

    private function checkRestrictions(string $text): bool
    {
        $keywords = [
            'violence', 'physical abuse', 'hit', 'punched', 'kicked', 'strangled', 'beaten', 
            'pananakit', 'sinaktan', 'sinuntok', 'sinipa', 'sinakal', 'binugbog', 'kinaladkad', 'armas', 'saksak', 'baril',
            'harassment', 'rape', 'molested', 'threatening', 'stalking', 
            'binastos', 'hinarass', 'pinilit', 'tinatakot', 'sinusundan', 'pambabastos', 'bastos',
            'husband', 'partner', 'ex-boyfriend', 'live-in partner', 'asawa', 'kinakasama', 'dating bf', 'tatay', 'ama'
        ];

        foreach ($keywords as $kw) {
            if (stripos($text, $kw) !== false) {
                return true;
            }
        }

        return false;
    }

    public function updatePet(Request $request, $id)
    {
        $pet = Pet::where('id', $id)->where('resident_id', auth()->user()->resident->id)->firstOrFail();

        $data = [];
        if ($request->has('status')) {
            $data['status'] = $request->status;
        }

        if ($request->has('vaccination_status') && $request->vaccination_status === 'pending') {
            if ($request->hasFile('vaccine_proof')) {
                $data['vaccine_proof'] = $request->file('vaccine_proof')->store('pet_vaccine_proofs', 'public');
                $data['vaccination_status'] = 'pending';
                // Reset rejection reason if they are re-uploading
                $data['rejection_reason'] = null;
            }
        }

        if ($request->hasFile('pet_photo')) {
            // 6-month cooldown check
            $photoUpdatedAt = $pet->photo_updated_at;
            if ($photoUpdatedAt && $photoUpdatedAt->copy()->addMonths(6)->isFuture()) {
                return redirect()->back()->with('error', 'You can only update your pet\'s photo once every 6 months. Please try again after ' . $photoUpdatedAt->copy()->addMonths(6)->format('M d, Y') . '.');
            }

            $data['pet_photo'] = $request->file('pet_photo')->store('pet_photos', 'public');
            $data['photo_updated_at'] = now();
        }

        $pet->update($data);

        return redirect()->back()->with('success', 'Pet details updated successfully!');
    }

    public function rescheduleDocument(Request $request, $id)
    {
        $docReq = DocumentRequest::where('id', $id)
            ->where(function($q) {
                if (auth()->check()) {
                    $q->where('user_id', auth()->id());
                }
                // For guests, we could allow identification by ID if coming from email
                // but for now let's focus on residents or just the ID for guest.
            })
            ->firstOrFail();

        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        if ($docReq->reschedule_count >= 1) {
            return redirect()->back()->with('error', 'You have already reached the maximum limit of one reschedule for this document request.');
        }

        // Capacity Check: Max 10 per slot
        $count = DocumentRequest::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->whereNotIn('status', ['disapproved'])
            ->count();
        
        if ($count >= 10) {
            return redirect()->back()->with('error', 'The selected time slot has reached its maximum capacity (10 requests). Please choose another time.');
        }

        $docReq->update([
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'pickup_date'      => $request->appointment_date,
            'pickup_time'      => $request->appointment_time,
            'reschedule_count' => $docReq->reschedule_count + 1,
        ]);

        return redirect()->back()->with('success', 'Appointment rescheduled successfully!');
    }

    public function checkAvailability(Request $request)
    {
        $request->validate(['date' => 'required|date']);
        $date = $request->date;

        $slots = [
            '08:00:00', '09:00:00', '10:00:00', '11:00:00',
            '13:00:00', '14:00:00', '15:00:00', '16:00:00'
        ];

        $counts = DocumentRequest::where('appointment_date', $date)
            ->whereIn('appointment_time', $slots)
            ->whereNotIn('status', ['disapproved'])
            ->select('appointment_time', \DB::raw('count(*) as count'))
            ->groupBy('appointment_time')
            ->pluck('count', 'appointment_time')
            ->toArray();

        $maxSlots = 10; // Accommodates 10 slots per time slot

        $availability = [];
        foreach ($slots as $slot) {
            $currentCount = (int)($counts[$slot] ?? 0);
            $remaining = max(0, $maxSlots - $currentCount);
            $availability[] = [
                'time'      => $slot,
                'display'   => \Carbon\Carbon::parse($slot)->format('h:i A'),
                'total'     => $maxSlots,
                'count'     => $currentCount,
                'remaining' => $remaining,
                'full'      => $remaining <= 0,
            ];
        }

        return response()->json($availability);
    }

    public static function sendDueAppointmentReminders()
    {
        try {
            $now = \Carbon\Carbon::now();
            $activeRequests = DocumentRequest::with('user')
                ->whereIn('status', ['pending', 'processing', 'ready'])
                ->whereNotNull('appointment_date')
                ->whereNotNull('appointment_time')
                ->get();

            foreach ($activeRequests as $doc) {
                try {
                    $appDateTime = \Carbon\Carbon::parse($doc->appointment_date . ' ' . $doc->appointment_time);
                } catch (\Exception $e) {
                    continue;
                }

                $diffMinutes = $now->diffInMinutes($appDateTime, false);
                $diffHours = $now->diffInHours($appDateTime, false);

                // 1. 1-DAY BEFORE REMINDER (Scheduled for tomorrow or within 12-26h)
                if ($appDateTime->isTomorrow() || ($diffHours >= 12 && $diffHours <= 26)) {
                    $alreadySent1Day = \DB::table('notifications')
                        ->where('data', 'like', '%"doc_id":' . $doc->id . '%')
                        ->where('data', 'like', '%"reminder_type":"1_day"%')
                        ->exists();

                    if (!$alreadySent1Day) {
                        if ($doc->user) {
                            $doc->user->notify(new \App\Notifications\DocumentAppointmentReminder($doc, '1_day'));
                        } elseif ($doc->guest_email) {
                            \Illuminate\Support\Facades\Notification::route('mail', $doc->guest_email)
                                ->notify(new \App\Notifications\DocumentAppointmentReminder($doc, '1_day'));
                        }
                    }
                }

                // 2. 30-MINUTE BEFORE REMINDER (Within 0 to 35 mins before appointment)
                if ($diffMinutes >= 0 && $diffMinutes <= 35) {
                    $alreadySent30Min = \DB::table('notifications')
                        ->where('data', 'like', '%"doc_id":' . $doc->id . '%')
                        ->where('data', 'like', '%"reminder_type":"30_min"%')
                        ->exists();

                    if (!$alreadySent30Min) {
                        if ($doc->user) {
                            $doc->user->notify(new \App\Notifications\DocumentAppointmentReminder($doc, '30_min'));
                        } elseif ($doc->guest_email) {
                            \Illuminate\Support\Facades\Notification::route('mail', $doc->guest_email)
                                ->notify(new \App\Notifications\DocumentAppointmentReminder($doc, '30_min'));
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Silently catch exceptions so portal never breaks
        }
    }

    public function updateResidentEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->email = strtolower(trim($request->email));
        $user->save();

        return redirect()->route('resident.index')
            ->with('success', '✅ Email address updated to ' . $user->email . '! All document notifications and emergency SOS receipts will now be sent here.');
    }
}
