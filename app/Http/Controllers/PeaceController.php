<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueReport;
use App\Models\PatrolSchedule;
use App\Models\EmergencySosAlert;
use App\Notifications\IssueStatusUpdated;
use Illuminate\Support\Facades\DB;

class PeaceController extends Controller
{
    public function dashboard(Request $request)
    {
        $issues = IssueReport::where('department', 'Peace & Order')->latest()->get();
        $patrols = PatrolSchedule::latest()->get();
        $peaceReports = \App\Models\DepartmentReport::where('department', 'Peace & Order')->latest()->get();

        $sosAlerts = EmergencySosAlert::with(['user.resident', 'resident'])
            ->whereIn('status', ['triggered', 'acknowledged', 'responding'])
            ->latest()
            ->get();

        $recentResolvedSos = EmergencySosAlert::with(['user.resident', 'resident'])
            ->where('status', 'resolved')
            ->latest()
            ->take(10)
            ->get();

        return view('peace and order.index', compact('issues', 'patrols', 'peaceReports', 'sosAlerts', 'recentResolvedSos'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'rejection_reason' => 'nullable|string'
        ]);

        $issue = IssueReport::findOrFail($id);

        // Define status ranks for one-way progression
        $ranks = [
            'submitted'       => 1,
            'under_review'    => 2,
            'pending'         => 3,
            'on_going'        => 4,
            'referred_to_pnp' => 4,
            'urgent'          => 4,
            'approved'        => 5,
            'settled'         => 5,
            'resolved'        => 5,
            'rejected'        => 6,
        ];

        $currentStatus = $issue->status;
        $newStatus = $request->status;

        // Terminal lock: Once a case is settled, resolved, or rejected, it cannot be modified
        if (in_array($currentStatus, ['settled', 'resolved', 'rejected'])) {
            return redirect()->back()->with('error', 'This case is already ' . ucfirst($currentStatus) . ' and cannot be changed.');
        }

        $currentRank = $ranks[$currentStatus] ?? 0;
        $newRank = $ranks[$newStatus] ?? 0;

        // Strict one-way forward progression
        if ($newStatus !== $currentStatus && $newRank < $currentRank) {
            return redirect()->back()->with('error', 'Status progression is one-way. Cannot revert to a previous stage (' . ucfirst(str_replace('_',' ',$newStatus)) . ').');
        }
        
        $data = ['status' => $newStatus];
        if ($newStatus === 'rejected' && $request->filled('rejection_reason')) {
            $data['rejection_reason'] = $request->rejection_reason;
        }

        $issue->update($data);

        if ($issue->user) {
            $issue->user->notify(new IssueStatusUpdated($issue));
        }

        return redirect()->back()->with('success', 'Incident status updated and resident notified.');
    }

    public function updateSummary(Request $request, $id)
    {
        $request->validate(['admin_summary' => 'required|string']);
        $issue = IssueReport::findOrFail($id);
        $issue->update(['admin_summary' => $request->admin_summary]);
        return redirect()->back()->with('success', 'Official incident summary securely saved.');
    }

    public function storeBlotter(Request $request)
    {
        $validated = $request->validate([
            'issue_type' => 'required|string',
            'complainant_name' => 'required|string',
            'contact' => 'required|string',
            'complainant_age' => 'nullable|integer',
            'complainant_gender' => 'nullable|string',
            'complainant_address' => 'nullable|string',
            'respondent_name' => 'required|string',
            'respondent_address' => 'required|string',
            'incident_date' => 'required|date',
            'incident_location' => 'required|string',
            'description' => 'required|string',
            'witness_name' => 'nullable|string',
            'status' => 'required|string',
            'department' => 'required|string',
        ]);

        $evidencePaths = [];
        if ($request->hasFile('evidence')) {
            foreach ($request->file('evidence') as $file) {
                $evidencePaths[] = $file->store('issue_evidence', 'public');
            }
        }

        IssueReport::create([
            'user_id' => auth()->id() ?? null,
            'issue_type' => $validated['issue_type'],
            'department' => $validated['department'],
            'complainant_name' => $validated['complainant_name'],
            'contact' => $validated['contact'],
            'complainant_age' => $validated['complainant_age'] ?? null,
            'complainant_gender' => $validated['complainant_gender'] ?? null,
            'complainant_address' => $validated['complainant_address'] ?? null,
            'respondent_name' => $validated['respondent_name'],
            'respondent_address' => $validated['respondent_address'] ?? null,
            'incident_date' => $validated['incident_date'],
            'location' => $validated['incident_location'],
            'witness_name' => $validated['witness_name'] ?? null,
            'evidence' => !empty($evidencePaths) ? json_encode($evidencePaths) : null,
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'Official Blotter Entry permanently recorded.');
    }

    public function storePatrol(Request $request)
    {
        $validated = $request->validate([
            'team_name'          => 'required|string',
            'personnel_names'    => 'required|array|max:10',
            'personnel_names.*'  => 'required|string|max:30',
            'schedule_date'      => 'required|date|after_or_equal:today',
            'patrol_time_start'  => 'nullable|string',
            'patrol_time_end'    => 'nullable|string',
        ]);

        $timeRange = null;
        if ($request->filled('patrol_time_start') && $request->filled('patrol_time_end')) {
            $start = \Carbon\Carbon::parse($request->patrol_time_start)->format('g:iA');
            $end = \Carbon\Carbon::parse($request->patrol_time_end)->format('g:iA');
            $timeRange = $start . ' - ' . $end;
        }

        PatrolSchedule::create([
            'title'           => 'MONTHLY PATROLS SCHED',
            'team_name'       => $validated['team_name'],
            'personnel_names' => implode(', ', $validated['personnel_names']),
            'schedule_date'   => $validated['schedule_date'],
            'patrol_time'     => $timeRange,
        ]);

        return redirect()->back()->with('success', 'Patrol Schedule for ' . $validated['team_name'] . ' officially recorded.');
    }

    public function updatePatrolProof(Request $request, $id)
    {
        $request->validate([
            'roving_photo' => 'required|array|min:1|max:6',
            'roving_photo.*' => 'image|max:5120',
        ]);

        $patrol = PatrolSchedule::findOrFail($id);
        
        if ($request->hasFile('roving_photo')) {
            $paths = [];
            foreach ($request->file('roving_photo') as $file) {
                $paths[] = $file->store('patrol_proofs', 'public');
            }
            $patrol->update([
                'image_path' => json_encode($paths),
                'status' => 'Completed'
            ]);
        }

        return redirect()->back()->with('success', 'Roving proof(s) uploaded and patrol marked as Completed.');
    }

    public function updatePatrolStatus(Request $request, $id)
    {
        $patrol = PatrolSchedule::findOrFail($id);
        $request->validate(['status' => 'required|string']);
        
        $patrol->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Patrol status updated to ' . $request->status);
    }

    public function destroyPatrol($id)
    {
        $patrol = PatrolSchedule::findOrFail($id);
        $patrol->delete();
        return redirect()->back()->with('success', 'Patrol Schedule removed.');
    }



    public function escalateToJustice(Request $request, $id)
    {
        $issue = IssueReport::findOrFail($id);
        
        $request->validate([
            'admin_summary' => 'nullable|string|max:1000'
        ]);

        $summaryText = !empty(trim($request->admin_summary ?? '')) 
            ? trim($request->admin_summary) 
            : 'Referred by Peace & Order to Lupon Tagapamayapa for formal Katarungang Pambarangay (KP) conciliation.';

        $endorsement = "[ESCALATED TO KP / JUSTICE]\nEndorsed from Peace & Order: " . $summaryText;
        $fullSummary = $issue->admin_summary 
            ? ($issue->admin_summary . "\n\n" . $endorsement)
            : $endorsement;

        $issue->update([
            'department'     => 'Justice',
            'status'         => 'submitted', // Enters the Justice / KP evaluation pipeline
            'admin_summary'  => $fullSummary,
            'transfer_count' => DB::raw('transfer_count + 1'),
        ]);

        if ($issue->user) {
            $issue->user->notify(new IssueStatusUpdated($issue));
        }

        return redirect()->back()->with('success', 'Case successfully escalated to Katarungang Pambarangay (KP) and referred to the Justice Department.');
    }
    public function transferToVawc(Request $request, $id)
    {
        $issue = IssueReport::findOrFail($id);
        
        if ($issue->transfer_count >= 1) {
            return redirect()->back()->with('error', 'This case has already been transferred once and cannot be moved again.');
        }

        $issue->update([
            'department' => 'VAWC',
            'is_restricted' => true,
            'status' => 'under_review',
            'transfer_count' => DB::raw('transfer_count + 1'),
        ]);

        return redirect()->back()->with('success', 'Case has been escalated and transferred to VAWC for confidential handling.');
    }

    public function export()
    {
        $reports = IssueReport::where('department', 'Peace & Order')->where('issue_type', '!=', 'Patrol Schedule')->latest()->get();
        $filename = "Peace_and_Order_Reports_" . date('Y-m-d') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Case Code', 'Type', 'Complainant', 'Contact', 'Respondent', 'Incident Date', 'Location', 'Status', 'Date Filed'];

        $callback = function() use($reports, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($reports as $r) {
                $caseCode = 'PO-' . $r->created_at->format('Y') . '-' . str_pad($r->id, 3, '0', STR_PAD_LEFT);
                fputcsv($file, [
                    $caseCode,
                    $r->issue_type,
                    $r->complainant_name,
                    $r->contact,
                    $r->respondent_name ?? 'N/A',
                    $r->incident_date ? \Carbon\Carbon::parse($r->incident_date)->format('Y-m-d') : 'N/A',
                    $r->location ?? 'Barangay San Miguel II',
                    $r->status,
                    $r->created_at->format('Y-m-d')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function sampleTemplate()
    {
        $filename = "Peace_Order_Import_Template.csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'Issue Type',
            'Complainant Name',
            'Contact Number',
            'Complainant Age',
            'Complainant Gender',
            'Respondent Name',
            'Address',
            'Incident Date (YYYY-MM-DD)',
            'Location',
            'Description',
            'Witness Name',
            'Status'
        ];

        $sampleRow = [
            'Noise Disturbance',
            'Juan Dela Cruz',
            '09123456789',
            '35',
            'Male',
            'Pedro Santos',
            'Block 5 Lot 12, Phase 1',
            date('Y-m-d'),
            'Phase 1 Covered Court',
            'Loud videoke and disturbance past midnight.',
            'Maria Reyes',
            'submitted'
        ];

        $callback = function() use($columns, $sampleRow) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fputcsv($file, $sampleRow);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function importBlotter(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|max:10240'
        ]);

        $file = $request->file('import_file');
        $ext = strtolower($file->getClientOriginalExtension());
        $rows = [];

        if (in_array($ext, ['xlsx', 'xls']) && class_exists(\PhpOffice\PhpSpreadsheet\IOFactory::class)) {
            try {
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getRealPath());
                $sheet = $spreadsheet->getActiveSheet();
                $rows = $sheet->toArray(null, true, true, false);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error reading Excel file: ' . $e->getMessage());
            }
        } else {
            // Read CSV / TXT
            if (($handle = fopen($file->getRealPath(), 'r')) !== FALSE) {
                while (($data = fgetcsv($handle, 10000, ',')) !== FALSE) {
                    if (count($data) === 1 && str_contains($data[0], ';')) {
                        $data = str_getcsv($data[0], ';');
                    } elseif (count($data) === 1 && str_contains($data[0], "\t")) {
                        $data = str_getcsv($data[0], "\t");
                    }
                    $rows[] = $data;
                }
                fclose($handle);
            }
        }

        if (empty($rows)) {
            return redirect()->back()->with('error', 'The uploaded file is empty or could not be read.');
        }

        // Header lookup map
        $firstRow = array_map(fn($v) => strtolower(trim((string)$v)), $rows[0] ?? []);
        $hasHeader = false;
        
        $colMap = [
            'type'        => null,
            'complainant' => null,
            'contact'     => null,
            'age'         => null,
            'gender'      => null,
            'respondent'  => null,
            'address'     => null,
            'date'        => null,
            'location'    => null,
            'description' => null,
            'witness'     => null,
            'status'      => null,
        ];

        foreach ($firstRow as $idx => $hdr) {
            $h = preg_replace('/[^a-z0-9]/', '', $hdr);
            if (str_contains($h, 'type') || str_contains($h, 'issue') || str_contains($h, 'case')) {
                $colMap['type'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'complainant') || str_contains($h, 'complainer') || str_contains($h, 'victim')) {
                $colMap['complainant'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'contact') || str_contains($h, 'phone') || str_contains($h, 'mobile')) {
                $colMap['contact'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'age')) {
                $colMap['age'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'gender') || str_contains($h, 'sex')) {
                $colMap['gender'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'respondent') || str_contains($h, 'accused') || str_contains($h, 'suspect')) {
                $colMap['respondent'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'address')) {
                $colMap['address'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'date') || str_contains($h, 'incidentdate')) {
                $colMap['date'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'location') || str_contains($h, 'place') || str_contains($h, 'venue')) {
                $colMap['location'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'description') || str_contains($h, 'narration') || str_contains($h, 'details')) {
                $colMap['description'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'witness')) {
                $colMap['witness'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'status')) {
                $colMap['status'] = $idx; $hasHeader = true;
            }
        }

        $startIdx = $hasHeader ? 1 : 0;
        $importedCount = 0;

        for ($i = $startIdx; $i < count($rows); $i++) {
            $row = $rows[$i];
            if (empty(array_filter($row, fn($v) => !is_null($v) && trim((string)$v) !== ''))) {
                continue;
            }

            $type = $colMap['type'] !== null ? ($row[$colMap['type']] ?? null) : ($row[0] ?? null);
            $complainant = $colMap['complainant'] !== null ? ($row[$colMap['complainant']] ?? null) : ($row[1] ?? null);
            $contact = $colMap['contact'] !== null ? ($row[$colMap['contact']] ?? null) : ($row[2] ?? '09000000000');
            $age = $colMap['age'] !== null && is_numeric($row[$colMap['age']] ?? '') ? (int)$row[$colMap['age']] : null;
            $gender = $colMap['gender'] !== null ? ($row[$colMap['gender']] ?? null) : null;
            $respondent = $colMap['respondent'] !== null ? ($row[$colMap['respondent']] ?? null) : ($row[3] ?? 'N/A');
            $address = $colMap['address'] !== null ? ($row[$colMap['address']] ?? null) : null;
            $dateVal = $colMap['date'] !== null ? ($row[$colMap['date']] ?? null) : ($row[4] ?? date('Y-m-d'));
            $location = $colMap['location'] !== null ? ($row[$colMap['location']] ?? null) : ($row[5] ?? 'Barangay San Miguel II');
            $description = $colMap['description'] !== null ? ($row[$colMap['description']] ?? null) : ($row[6] ?? 'Imported blotter record.');
            $witness = $colMap['witness'] !== null ? ($row[$colMap['witness']] ?? null) : ($row[7] ?? null);
            $statusVal = $colMap['status'] !== null ? ($row[$colMap['status']] ?? null) : ($row[8] ?? 'submitted');

            if (empty($complainant) && empty($type)) {
                continue;
            }

            $parsedDate = date('Y-m-d');
            if (!empty($dateVal)) {
                try {
                    $parsedDate = \Carbon\Carbon::parse($dateVal)->format('Y-m-d');
                } catch (\Exception $e) {
                    $parsedDate = date('Y-m-d');
                }
            }

            $cleanStatus = strtolower(trim(str_replace([' ', '-'], '_', (string)$statusVal)));
            if (!in_array($cleanStatus, ['submitted', 'under_review', 'pending', 'approved', 'settled', 'resolved', 'rejected'])) {
                $cleanStatus = 'submitted';
            }

            IssueReport::create([
                'user_id'             => auth()->id() ?? null,
                'issue_type'          => !empty($type) ? trim((string)$type) : 'Peace & Order Concern',
                'department'          => 'Peace & Order',
                'complainant_name'    => !empty($complainant) ? trim((string)$complainant) : 'Anonymous / Resident',
                'contact'             => !empty($contact) ? trim((string)$contact) : '09000000000',
                'complainant_age'     => $age,
                'complainant_gender'  => $gender,
                'complainant_address' => $address,
                'respondent_name'     => !empty($respondent) ? trim((string)$respondent) : 'N/A',
                'respondent_address'  => $address,
                'incident_date'       => $parsedDate,
                'location'            => !empty($location) ? trim((string)$location) : 'Barangay San Miguel II',
                'witness_name'        => $witness,
                'description'         => !empty($description) ? trim((string)$description) : 'Imported Peace & Order blotter record.',
                'status'              => $cleanStatus,
            ]);

            $importedCount++;
        }

        return redirect()->back()->with('success', "Successfully imported {$importedCount} blotter records into the Peace & Order Portal!");
    }

    // ── Emergency SOS Dispatch Endpoints ──
    public function getSosAlerts()
    {
        $alerts = EmergencySosAlert::with(['user.resident', 'resident'])
            ->whereIn('status', ['triggered', 'acknowledged', 'responding'])
            ->latest()
            ->get()
            ->map(function ($a) {
                $name = $a->resident_name;
                if (!$name && $a->user) {
                    $name = $a->user->first_name . ' ' . $a->user->last_name;
                }
                $contact = $a->resident_contact ?? ($a->user?->phone_number ?? 'N/A');
                $address = $a->resident_address ?? ($a->user?->resident?->address ?? ($a->user?->address ?? 'Barangay San Miguel II'));

                return [
                    'id'               => $a->id,
                    'resident_name'    => $name ?? 'Barangay Resident',
                    'resident_contact' => $contact,
                    'resident_address' => $address,
                    'emergency_type'   => $a->emergency_type,
                    'message'          => $a->message,
                    'latitude'         => $a->latitude,
                    'longitude'        => $a->longitude,
                    'status'           => $a->status,
                    'dispatched_units' => $a->dispatched_units,
                    'responder_notes'  => $a->responder_notes,
                    'created_at_fmt'   => $a->created_at->format('M d, Y h:i A'),
                    'time_ago'         => $a->created_at->diffForHumans(),
                    'google_maps_url'  => ($a->latitude && $a->longitude) 
                        ? "https://www.google.com/maps?q={$a->latitude},{$a->longitude}" 
                        : null,
                ];
            });

        return response()->json([
            'alerts'        => $alerts,
            'active_count'  => $alerts->where('status', 'triggered')->count(),
            'total_pending' => $alerts->count(),
        ]);
    }

    public function updateSosStatus(Request $request, $id)
    {
        $request->validate([
            'status'           => 'required|in:acknowledged,responding,resolved',
            'dispatched_units' => 'nullable|string',
            'responder_notes'  => 'nullable|string',
        ]);

        $alert = EmergencySosAlert::findOrFail($id);
        $data = ['status' => $request->status];

        if ($request->filled('dispatched_units')) {
            $data['dispatched_units'] = $request->dispatched_units;
        }
        if ($request->filled('responder_notes')) {
            $data['responder_notes'] = $request->responder_notes;
        }

        if ($request->status === 'acknowledged' && !$alert->acknowledged_at) {
            $data['acknowledged_at'] = now();
        }
        if ($request->status === 'resolved') {
            $data['resolved_at'] = now();
        }

        $alert->update($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'SOS status updated successfully.',
                'alert'   => $alert,
            ]);
        }

        return redirect()->back()->with('success', "SOS alert #{$alert->id} marked as " . strtoupper($request->status));
    }
}
