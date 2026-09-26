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
use App\Models\SiteSetting;
use App\Models\Project;

use App\Notifications\AdminReplyNotification;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        Event::where('is_active', true)
            ->where('frequency', 'REGEXP', '^[0-9]{4}-[0-9]{2}-[0-9]{2}$')
            ->whereDate('frequency', '<', Carbon::now()->toDateString())
            ->update(['is_active' => false, 'archived_at' => Carbon::now()]);

        Announcement::where('is_active', true)
            ->whereNotNull('date')
            ->whereDate('date', '<', Carbon::now()->toDateString())
            ->update(['is_active' => false, 'archived_at' => Carbon::now()]);

        $totalResidents    = Resident::count();
        $totalUsers        = User::where('role', 'resident')->has('resident')->count();
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
        $seniors           = Resident::where(function($q) {
            $q->where('is_senior', true)
              ->orWhereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) >= 60')
              ->orWhere('age', '>=', 60);
        })->count();
        $pwds              = Resident::where('is_pwd', true)->count();
        $bedridden         = Resident::where('is_bedridden', true)->count();
        $soloParents       = Resident::where('is_single_parent', true)->count();
        $students          = Resident::where('is_student', true)->count();
        $voters            = Resident::where('is_voter', true)->count();
        $minors            = Resident::whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) < 18')->count();
        $adults            = Resident::whereRaw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) BETWEEN 18 AND 59')->count();
        $birthdayThisMonth = Resident::whereMonth('birthday', Carbon::now()->month)->count();
        $totalHouseholds   = Resident::where('is_household_head', true)->count();
        $nonVoters         = Resident::where('is_voter', false)->count();

        $officials         = Official::where('is_active', true)->get();
        $archivedOfficials = Official::where('is_active', false)->get();
        $announcements     = Announcement::where('is_active', true)->latest()->get();
        $archivedAnnouncements = Announcement::where('is_active', false)->latest()->get();
        $events            = Event::where('is_active', true)->latest()->get();
        $archivedEvents    = Event::where('is_active', false)->latest()->get();


        $releasedDocsList = DocumentRequest::with('user')->where('status', 'released')->orderBy('updated_at', 'desc')->get();
        $settledIssuesList = IssueReport::with('user')->where('status', 'settled')->orderBy('updated_at', 'desc')->get();

        // Detailed lists for interactive dashboard modals
        $activeResidents  = Resident::latest()->take(500)->get()->values(); // Limit to 500 for performance
        $activeDocs       = DocumentRequest::where('status', '!=', 'released')->latest()->get()->values();
        $activeIssues     = IssueReport::with('user')->where('status', '!=', 'settled')->latest()->get()->values();
        $activeHouseholds = Resident::with('householdMembers')->where('is_household_head', true)->latest()->get()->values();
        $allPets = Pet::with('resident')->where('is_archived', false)->latest()->get()->values();

        // ── Residents Basic Data For Global Filter ──
        $resList = Resident::select('id', 'first_name', 'last_name', 'middle_name', 'birthday')->get()->map(function ($r) {
            return [
                'id'        => $r->id,
                'name'      => trim($r->first_name . ' ' . $r->last_name),
                'bmonth'    => $r->birthday ? Carbon::parse($r->birthday)->month : null,
                'bdate_raw' => $r->birthday
            ];
        })->toArray();

        // ── Report Data For Dynamic Filtering ──
        $reportDocs = $releasedDocsList->map(function($d){
            return [
                'id'            => $d->id,
                'type'          => $d->document_type,
                'requested_by'  => $d->user ? ($d->user->first_name.' '.$d->user->last_name) : ($d->guest_first_name.' '.$d->guest_last_name),
                'is_registered' => $d->user ? true : false,
                'date'          => $d->updated_at->format('Y-m-d'),
                'month'         => $d->updated_at->month,
                'year'          => $d->updated_at->year,
                'date_fmt'      => $d->updated_at->format('M d, Y')
            ];
        });

        $reportIssues = $settledIssuesList->map(function($i){
            return [
                'id'            => $i->id,
                'case_no'       => 'CAS-'.sprintf('%04d', $i->id),
                'dept'          => $i->department,
                'complainant'   => $i->user ? ($i->user->first_name.' '.$i->user->last_name) : $i->complainant_name,
                'respondent'    => $i->respondent_name ?? '—',
                'resolution'    => $i->resolution_summary ?? '—',
                'date'          => $i->updated_at->format('Y-m-d'),
                'month'         => $i->updated_at->month,
                'year'          => $i->updated_at->year,
                'date_fmt'      => $i->updated_at->format('M d, Y'),
                'is_guest'      => $i->user_id ? false : true
            ];
        });

        $carouselData = SiteSetting::where('key', 'carousel_data')->first()?->value;
        $carouselSlides = $carouselData ? collect(json_decode($carouselData))->sortBy('sort_order') : collect();
        $orgChartPath   = SiteSetting::where('key', 'organizational_chart')->first()?->value;
        $departmentReports = \App\Models\DepartmentReport::latest()->get();

        $projects         = Project::where('is_archived', false)->latest()->get();
        $archivedProjects = Project::where('is_archived', true)->latest()->get();

        $staffAccounts    = User::whereIn('role', ['admin', 'office', 'vawc', 'justice', 'peace'])
            ->orderByRaw("FIELD(role, 'admin', 'office', 'vawc', 'justice', 'peace')")
            ->get();

        return view('admin.dashboard', compact(
            'totalResidents', 'totalUsers', 'totalDocs', 'pendingDocs',
            'processingDocs', 'readyDocs', 'totalIssues', 'pendingIssues',
            'vawcIssues', 'peaceIssues', 'justiceIssues',
            'totalPets', 'vaccinated', 'unvaccinated',
            'male', 'female', 'seniors', 'pwds', 'bedridden', 'soloParents', 'students',
            'voters', 'minors', 'adults', 'birthdayThisMonth', 'totalHouseholds', 'nonVoters',
            'officials', 'archivedOfficials',
            'announcements', 'archivedAnnouncements',
            'events', 'archivedEvents',
            'projects', 'archivedProjects',
            'resList', 'reportDocs', 'reportIssues',
            'releasedDocsList', 'settledIssuesList',
            'activeResidents', 'activeDocs', 'activeIssues', 'activeHouseholds', 'allPets',
            'carouselSlides', 'orgChartPath', 'departmentReports', 'staffAccounts'
        ));
    }

    // ── Announcements ──
    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'title'     => 'required',
            'content'   => 'required',
            'date'      => 'nullable|date',
            'image'     => 'nullable|image|max:5120',
            'images'    => 'nullable|array|max:6',
            'images.*'  => 'nullable|image|max:5120',
        ]);

        if (!\Illuminate\Support\Facades\Schema::hasColumn('announcements', 'images')) {
            \Illuminate\Support\Facades\Schema::table('announcements', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->json('images')->nullable();
            });
        }

        $data = [
            'title'      => $request->title,
            'content'    => $request->content,
            'date'       => $request->date,
            'tag'        => $request->tag ?? 'Announcement',
            'is_active'  => true,
            'created_by' => auth()->id(),
        ];

        $paths = [];
        if ($request->hasFile('images')) {
            foreach (array_slice($request->file('images'), 0, 6) as $imgFile) {
                if ($imgFile) {
                    $paths[] = $imgFile->store('announcements', 'public');
                }
            }
        } elseif ($request->hasFile('image')) {
            $paths[] = $request->file('image')->store('announcements', 'public');
        }

        if (!empty($paths)) {
            $data['image_path'] = $paths[0];
            $data['images'] = $paths;
        }

        Announcement::create($data);
        return redirect()->back()->with('success', 'Announcement posted!');
    }

    public function updateAnnouncement(Request $request, $id)
    {
        $request->validate([
            'date'      => 'nullable|date',
            'image'     => 'nullable|image|max:5120',
            'images'    => 'nullable|array|max:6',
            'images.*'  => 'nullable|image|max:5120',
        ]);

        if (!\Illuminate\Support\Facades\Schema::hasColumn('announcements', 'images')) {
            \Illuminate\Support\Facades\Schema::table('announcements', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->json('images')->nullable();
            });
        }

        $ann = Announcement::findOrFail($id);
        $data = [
            'title'   => $request->title,
            'content' => $request->content,
            'date'    => $request->date,
            'tag'     => $request->tag ?? $ann->tag,
        ];

        $paths = [];
        if ($request->hasFile('images')) {
            foreach (array_slice($request->file('images'), 0, 6) as $imgFile) {
                if ($imgFile) {
                    $paths[] = $imgFile->store('announcements', 'public');
                }
            }
        } elseif ($request->hasFile('image')) {
            $paths[] = $request->file('image')->store('announcements', 'public');
        }

        if (!empty($paths)) {
            $data['image_path'] = $paths[0];
            $data['images'] = $paths;
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

    public function destroyAnnouncement($id)
    {
        Announcement::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Announcement permanently deleted.');
    }

    // ── Events ──
    public function storeEvent(Request $request)
    {
        $request->validate([
            'title'     => 'required',
            'day_label' => 'required',
            'frequency' => 'required',
            'image'     => 'nullable|image|max:5120',
            'images'    => 'nullable|array|max:6',
            'images.*'  => 'nullable|image|max:5120',
        ]);

        if (!\Illuminate\Support\Facades\Schema::hasColumn('events', 'images')) {
            \Illuminate\Support\Facades\Schema::table('events', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->json('images')->nullable();
            });
        }

        $data = [
            'title'      => $request->title,
            'day_label'  => $request->day_label,
            'frequency'  => $request->frequency,
            'time_range' => $request->time_range,
            'location'   => $request->location,
            'tag'        => $request->tag ?? 'Community',
            'description'=> $request->description,
            'is_active'  => true,
        ];

        $paths = [];
        if ($request->hasFile('images')) {
            foreach (array_slice($request->file('images'), 0, 6) as $imgFile) {
                if ($imgFile) {
                    $paths[] = $imgFile->store('events', 'public');
                }
            }
        } elseif ($request->hasFile('image')) {
            $paths[] = $request->file('image')->store('events', 'public');
        }

        if (!empty($paths)) {
            $data['image_path'] = $paths[0];
            $data['images'] = $paths;
        }

        Event::create($data);
        return redirect()->back()->with('success', 'Event created!');
    }

    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'image'     => 'nullable|image|max:5120',
            'images'    => 'nullable|array|max:6',
            'images.*'  => 'nullable|image|max:5120',
        ]);

        if (!\Illuminate\Support\Facades\Schema::hasColumn('events', 'images')) {
            \Illuminate\Support\Facades\Schema::table('events', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->json('images')->nullable();
            });
        }

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

        $paths = [];
        if ($request->hasFile('images')) {
            foreach (array_slice($request->file('images'), 0, 6) as $imgFile) {
                if ($imgFile) {
                    $paths[] = $imgFile->store('events', 'public');
                }
            }
        } elseif ($request->hasFile('image')) {
            $paths[] = $request->file('image')->store('events', 'public');
        }

        if (!empty($paths)) {
            $data['image_path'] = $paths[0];
            $data['images'] = $paths;
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

    public function destroyEvent($id)
    {
        Event::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Event permanently deleted.');
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

    public function destroyOfficial($id)
    {
        Official::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Official permanently deleted.');
    }

    // ── Carousel ──
    private function getCarouselData()
    {
        $setting = SiteSetting::where('key', 'carousel_data')->first();
        return $setting ? json_decode($setting->value, true) : [];
    }

    private function saveCarouselData($slides)
    {
        SiteSetting::updateOrCreate(
            ['key' => 'carousel_data'],
            ['value' => json_encode(array_values($slides))]
        );
    }

    public function storeCarouselSlide(Request $request)
    {
        $slides = $this->getCarouselData();
        if (count($slides) >= 6) {
            return redirect()->back()->with('error', 'Maximum of 6 slides allowed.');
        }
        $request->validate(['image' => 'required|image|max:5120', 'title' => 'nullable|string']);
        $path = $request->file('image')->store('carousel', 'public');
        
        $slides[] = [
            'id'         => time(), // Use timestamp as unique ID
            'image_path' => $path,
            'title'      => $request->title,
            'is_active'  => true,
            'sort_order' => count($slides),
        ];

        $this->saveCarouselData($slides);
        return redirect()->back()->with('success', 'Carousel slide added!');
    }

    public function updateCarouselSlide(Request $request, $id)
    {
        $slides = $this->getCarouselData();
        $foundIndex = null;
        foreach ($slides as $index => $slide) {
            if ($slide['id'] == $id) {
                $foundIndex = $index;
                break;
            }
        }

        if ($foundIndex === null) {
            return redirect()->back()->with('error', 'Slide not found.');
        }

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'image|max:5120']);
            $slides[$foundIndex]['image_path'] = $request->file('image')->store('carousel', 'public');
        }
        $slides[$foundIndex]['title'] = $request->title;
        $slides[$foundIndex]['is_active'] = $request->has('is_active');
        
        $this->saveCarouselData($slides);
        return redirect()->back()->with('success', 'Carousel slide updated!');
    }

    public function destroyCarouselSlide($id)
    {
        $slides = $this->getCarouselData();
        $newSlides = array_filter($slides, function ($slide) use ($id) {
            return $slide['id'] != $id;
        });

        $this->saveCarouselData($newSlides);
        return redirect()->back()->with('success', 'Carousel slide deleted.');
    }

    public function linkToCarousel($type, $id)
    {
        $slides = $this->getCarouselData();
        if (count($slides) >= 6) {
            return redirect()->back()->with('error', 'Maximum of 6 slides reached.');
        }

        $source = ($type === 'event') ? Event::findOrFail($id) : Announcement::findOrFail($id);
        
        if (!$source->image_path) {
            return redirect()->back()->with('error', 'This record has no image to link.');
        }

        $slides[] = [
            'id'         => time(),
            'image_path' => $source->image_path,
            'title'      => $source->title,
            'is_active'  => true,
            'sort_order' => count($slides),
        ];

        $this->saveCarouselData($slides);
        return redirect()->back()->with('success', 'Linked to carousel!');
    }

    // ── Projects ──
    public function storeProject(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'category'         => 'nullable|string|max:100',
            'status'           => 'required|in:planning,in_progress,completed',
            'description'      => 'nullable|string',
            'start_date'       => 'nullable|date',
            'completion_date'  => 'nullable|date',
            'budget'           => 'nullable|numeric',
            'contractor_lead'  => 'nullable|string|max:255',
            'image'            => 'nullable|image|max:5120',
            'images'           => 'nullable|array|max:6',
            'images.*'         => 'nullable|image|max:5120',
        ]);

        $data = [
            'title'           => $request->title,
            'category'        => $request->category ?? 'General',
            'status'          => $request->status,
            'description'     => $request->description,
            'start_date'      => $request->start_date,
            'completion_date' => $request->completion_date,
            'budget'          => $request->budget,
            'contractor_lead' => $request->contractor_lead,
            'is_archived'     => false,
        ];

        $paths = [];
        if ($request->hasFile('images')) {
            foreach (array_slice($request->file('images'), 0, 6) as $imgFile) {
                if ($imgFile) {
                    $paths[] = $imgFile->store('projects', 'public');
                }
            }
        } elseif ($request->hasFile('image')) {
            $paths[] = $request->file('image')->store('projects', 'public');
        }

        if (!empty($paths)) {
            $data['image_path'] = $paths[0];
            $data['images'] = $paths;
        }

        Project::create($data);
        return redirect()->back()->with('success', 'Barangay project created successfully!');
    }

    public function updateProject(Request $request, $id)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'category'         => 'nullable|string|max:100',
            'status'           => 'required|in:planning,in_progress,completed',
            'description'      => 'nullable|string',
            'start_date'       => 'nullable|date',
            'completion_date'  => 'nullable|date',
            'budget'           => 'nullable|numeric',
            'contractor_lead'  => 'nullable|string|max:255',
            'image'            => 'nullable|image|max:5120',
            'images'           => 'nullable|array|max:6',
            'images.*'         => 'nullable|image|max:5120',
        ]);

        $project = Project::findOrFail($id);
        $data = [
            'title'           => $request->title,
            'category'        => $request->category ?? $project->category,
            'status'          => $request->status,
            'description'     => $request->description,
            'start_date'      => $request->start_date,
            'completion_date' => $request->completion_date,
            'budget'          => $request->budget,
            'contractor_lead' => $request->contractor_lead,
        ];

        $paths = is_array($project->images) ? $project->images : [];
        if ($request->hasFile('images')) {
            $paths = [];
            foreach (array_slice($request->file('images'), 0, 6) as $imgFile) {
                if ($imgFile) {
                    $paths[] = $imgFile->store('projects', 'public');
                }
            }
        } elseif ($request->hasFile('image')) {
            $paths = [$request->file('image')->store('projects', 'public')];
        }

        if (!empty($paths)) {
            $data['image_path'] = $paths[0];
            $data['images'] = $paths;
        }

        $project->update($data);
        return redirect()->back()->with('success', 'Barangay project updated successfully!');
    }

    public function archiveProject($id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_archived' => true]);
        return redirect()->back()->with('success', 'Barangay project archived.');
    }

    public function restoreProject($id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_archived' => false]);
        return redirect()->back()->with('success', 'Barangay project restored.');
    }

    public function destroyProject($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->back()->with('success', 'Barangay project permanently deleted.');
    }

    // ── Site Settings ──
    public function updateSiteSetting(Request $request)
    {
        if ($request->hasFile('organizational_chart')) {
            $request->validate(['organizational_chart' => 'image|max:10240']);
            $path = $request->file('organizational_chart')->store('settings', 'public');
            SiteSetting::updateOrCreate(
                ['key' => 'organizational_chart'],
                ['value' => $path]
            );
            return redirect()->back()->with('success', 'Organizational Chart updated!');
        }
        return redirect()->back();
    }

    // ── Staff Portal Security & Password Recovery Q&A ──
    public function updateStaffSecurity(Request $request)
    {
        $request->validate([
            'user_id'           => 'required|exists:users,id',
            'security_question' => 'required|string|max:255',
            'security_answer'   => 'required|string|max:255',
        ]);

        $user = User::findOrFail($request->user_id);

        if ($user->role === 'resident') {
            return redirect()->back()->with('error', 'Cannot modify security credentials for resident accounts.');
        }

        $user->update([
            'security_question' => trim($request->security_question),
            'security_answer'   => trim($request->security_answer),
        ]);

        return redirect()->back()->with('success', "Security Question & Answer updated successfully for {$user->name} (" . ucfirst($user->role) . " portal).");
    }
}
