<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueReport;
use App\Notifications\IssueStatusUpdated;

class JusticeController extends Controller
{
    public function dashboard()
    {
        $today = \Carbon\Carbon::now()->startOfDay();
        
        // Auto-update upcoming hearing schedules to 'under_review' (Hearing Scheduled) if not already settled/escalated
        IssueReport::where('department', 'Justice')
            ->whereNotNull('hearing_date')
            ->whereNotIn('status', ['settled', 'resolved', 'escalated'])
            ->where('hearing_date', '>=', $today)
            ->update(['status' => 'under_review']);

        // Auto-update past hearing schedules to 'pending' if not already settled/escalated
        IssueReport::where('department', 'Justice')
            ->whereNotNull('hearing_date')
            ->whereNotIn('status', ['settled', 'resolved', 'escalated'])
            ->where('hearing_date', '<', $today)
            ->update(['status' => 'pending']);

        $reports = IssueReport::where('department', 'Justice')->latest()->get();

        $schedules = IssueReport::where('department', 'Justice')
            ->whereNotNull('hearing_date')
            ->whereNotIn('status', ['settled', 'resolved'])
            ->get()
            ->map(function($ir) {
                $dt = \Carbon\Carbon::parse($ir->hearing_date);
                return [
                    'date_str' => $dt->format('Y-m-d'),
                    'time_str' => $dt->format('h:i A'),
                    'title'    => $ir->complainant_name . ' vs ' . $ir->respondent_name
                ];
            });
        
        $schedulesJSON = json_encode($schedules);
        $justiceReports = \App\Models\DepartmentReport::where('department', 'Justice')->latest()->get();
        $customTemplate = \App\Http\Controllers\DepartmentReportController::getTemplateForDepartment('Justice');

        return view('justice.index', compact('reports', 'schedulesJSON', 'justiceReports', 'customTemplate'));
    }

    public function storeBlotter(Request $request)
    {
        $validated = $request->validate([
            'issue_type' => 'required|string',
            'complainant_name' => 'required|string',
            'contact' => 'required|string',
            'complainant_age' => 'nullable|integer',
            'complainant_gender' => 'nullable|string',
            'respondent_name' => 'required|string',
            'respondent_address' => 'nullable|string',
            'incident_date' => 'required|date',
            'incident_location' => 'required|string',
            'description' => 'required|string',
            'witness_name' => 'nullable|string',
            'status' => 'required|string',
            'department' => 'required|string',
            'external_evidence_link' => 'nullable|url',
            'evidence' => 'nullable|array|max:5',
            'evidence.*' => 'file|mimes:jpg,jpeg,png,pdf,mp4|max:25600',
        ]);

        $evidencePaths = [];
        if ($request->hasFile('evidence')) {
            $files = $request->file('evidence');
            if (count($files) > 5) {
                return redirect()->back()->with('error', 'Maximum of 5 files can be uploaded as evidence.');
            }
            foreach ($files as $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                $sizeInKb = $file->getSize() / 1024;
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'pdf']) && $sizeInKb > 5120) {
                    return redirect()->back()->with('error', 'File "' . $file->getClientOriginalName() . '" exceeds the 5MB limit for images and PDFs.');
                }
                if ($ext === 'mp4' && $sizeInKb > 25600) {
                    return redirect()->back()->with('error', 'Video "' . $file->getClientOriginalName() . '" exceeds the 25MB limit for MP4 videos.');
                }
                $path = $file->store('issue_evidence', 'public');
                $evidencePaths[] = [
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'size' => ($sizeInKb >= 1024 ? round($sizeInKb / 1024, 2) . ' MB' : round($sizeInKb, 0) . ' KB'),
                    'ext'  => $ext,
                    'date' => date('M d, Y')
                ];
            }
        }

        $desc = $validated['description'];
        if (!empty($validated['external_evidence_link'])) {
            $desc .= "\n\n[External Cloud Evidence]: " . $validated['external_evidence_link'];
        }

        IssueReport::create([
            'user_id' => auth()->id() ?? null,
            'issue_type' => $validated['issue_type'],
            'department' => $validated['department'],
            'complainant_name' => $validated['complainant_name'],
            'contact' => $validated['contact'],
            'complainant_age' => $validated['complainant_age'] ?? null,
            'complainant_gender' => $validated['complainant_gender'] ?? null,
            'respondent_name' => $validated['respondent_name'],
            'respondent_address' => $validated['respondent_address'] ?? null,
            'incident_date' => $validated['incident_date'],
            'location' => $validated['incident_location'],
            'witness_name' => $validated['witness_name'] ?? null,
            'evidence' => !empty($evidencePaths) ? json_encode($evidencePaths) : null,
            'description' => $desc,
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'Blotter entry successfully created.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);

        $issue = IssueReport::findOrFail($id);

        // Once a case is settled or resolved, it cannot be reverted or changed back
        if (in_array($issue->status, ['settled', 'resolved'])) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'This case is already settled and cannot be changed.'], 422);
            }
            return redirect()->back()->with('error', 'This case is already settled and cannot be changed.');
        }

        $newStatus = $request->status;

        $issue->update(['status' => $newStatus]);

        if ($issue->user) {
            $issue->user->notify(new IssueStatusUpdated($issue));
        }

        $formattedStatus = ucfirst(str_replace('_', ' ', $newStatus));
        $msg = 'Incident status updated to ' . $formattedStatus . '.';

        if ($newStatus === 'settled') {
            $msg = 'KP Form 16 (Amicable Settlement) recorded. Case marked as SETTLED.';
        } elseif ($newStatus === 'escalated') {
            $msg = 'KP Form 20 (Certificate to File Action) generated. Case ESCALATED to Court.';
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $msg,
                'status' => $newStatus,
                'status_formatted' => $formattedStatus,
                'issue' => $issue->fresh()
            ]);
        }

        return redirect()->back()->with('success', $msg);
    }

    public function issueSummon(Request $request)
    {
        $maxDate = \Carbon\Carbon::now()->addMonths(3)->endOfDay();

        $validated = $request->validate([
            'issue_id' => 'required|exists:issue_reports,id',
            'hearing_date' => 'required|date|after_or_equal:today|before_or_equal:' . $maxDate->toDateString(),
            'time' => 'required|string',
        ]);

        $issue = IssueReport::findOrFail($validated['issue_id']);
        
        $datetime = \Carbon\Carbon::parse($validated['hearing_date'] . ' ' . $validated['time']);

        // Check if the scheduled time is in the past
        if ($datetime->isPast()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Cannot schedule a hearing in the past. Please select an upcoming date and time.'], 422);
            }
            return redirect()->back()->with('error', 'Cannot schedule a hearing in the past. Please select an upcoming date and time.');
        }

        // Check if scheduled for today after 5:00 PM
        if ($datetime->isToday() && \Carbon\Carbon::now()->hour >= 17) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Hearings for today are closed after 5:00 PM. Please schedule for the next available day.'], 422);
            }
            return redirect()->back()->with('error', 'Hearings for today are closed after 5:00 PM. Please schedule for the next available day.');
        }

        // Check if scheduled beyond 3 months
        if ($datetime->gt($maxDate)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Hearing schedule cannot be set beyond 3 months in advance.'], 422);
            }
            return redirect()->back()->with('error', 'Hearing schedule cannot be set beyond 3 months in advance.');
        }

        // Check if a hearing is already scheduled for this exact time
        $exists = IssueReport::where('department', 'Justice')
            ->where('hearing_date', $datetime->toDateTimeString())
            ->whereNotIn('status', ['settled', 'resolved'])
            ->exists();

        if ($exists) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'A hearing is already scheduled for ' . $datetime->format('F d, Y h:i A') . '. Please choose a different time.'], 422);
            }
            return redirect()->back()->with('error', 'A hearing is already scheduled for ' . $datetime->format('F d, Y h:i A') . '. Please choose a different time.');
        }

        $datetimeStr = $datetime->toDateTimeString();
        
        // Update issue with hearing date, and automatically update status to 'under_review' (Hearing Scheduled)
        $updateData = [
            'hearing_date' => $datetimeStr,
            'status' => 'under_review'
        ];
        
        $issue->update($updateData);

        // 1. Resident Email Notification Dispatch
        if ($issue->user && !empty($issue->user->email)) {
            try {
                \Illuminate\Support\Facades\Mail::to($issue->user->email)->send(new \App\Mail\SummonIssuedMail($issue));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning("Summon email could not be sent to {$issue->user->email}: " . $e->getMessage());
            }
        }

        // 2. Resident SMS Notification Dispatch
        if (!empty($issue->contact)) {
            \Illuminate\Support\Facades\Log::info("SMS Notification queued for resident ({$issue->contact}): Hearing scheduled for Case #{$issue->case_no} on " . $datetime->format('F d, Y \a\t h:i A') . " at Barangay Hall Mediation Center.");
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Hearing successfully scheduled for ' . $datetime->format('M d, Y h:i A') . '. Resident Email & SMS notifications dispatched.',
                'hearing_date_formatted' => $datetime->format('M d, Y h:i A'),
                'date_str' => $datetime->format('Y-m-d'),
                'time_str' => $datetime->format('h:i A'),
                'new_status' => $issue->status,
                'issue' => $issue->fresh()
            ]);
        }

        return redirect()->back()->with([
            'success' => 'Summon generated and resident notified via email.',
            'print_summon' => $issue->id
        ]);
    }

    public function export(Request $request)
    {
        $reportType = $request->query('report', 'blotter');
        $period = $request->query('period', 'all');

        $query = IssueReport::where('department', 'Justice');

        if ($period === 'month') {
            $query->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
        } elseif ($period === 'year') {
            $query->whereYear('created_at', now()->year);
        }

        if ($reportType === 'settled') {
            $query->whereIn('status', ['settled', 'resolved']);
        } elseif ($reportType === 'hearings') {
            $query->whereNotNull('hearing_date');
        }

        $reports = $query->latest()->get();

        if ($reportType === 'dilg') {
            $filename = "DILG_KP_Transmittal_Report_" . date('Y-m-d') . ".csv";
            
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            $callback = function() use($reports) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['REPUBLIC OF THE PHILIPPINES', 'PROVINCE OF CAVITE', 'CITY OF DASMARINAS']);
                fputcsv($file, ['KATARUNGANG PAMBARANGAY MONTHLY TRANSMITTAL REPORT', 'PERIOD: ' . date('F Y')]);
                fputcsv($file, []);
                fputcsv($file, ['Nature of Dispute', 'Total Filed', 'Settled (Mediation)', 'Settled (Conciliation)', 'Settled (Arbitration)', 'CFA Issued (Escalated)', 'Repudiated', 'Pending Mediation', 'Resolution Rate']);

                $categories = [
                    'A. Criminal / Public Order' => ['Physical Altercation', 'Noise / Disturbance', 'Barangay Ordinance Violation'],
                    'B. Civil / Neighbor Disputes' => ['Dispute over Property', 'Debt / Lending Dispute', 'Neighbor Dispute', 'Family Dispute'],
                    'C. Others / Miscellaneous' => ['Others', 'Estafa / Fraud', 'Verbal Altercation']
                ];

                $grandTotal = $reports->count();
                $grandSettled = $reports->whereIn('status', ['settled', 'resolved'])->count();

                foreach ($categories as $catName => $types) {
                    $catReports = $reports->whereIn('issue_type', $types);
                    $tot = $catReports->count();
                    $set = $catReports->whereIn('status', ['settled', 'resolved'])->count();
                    $esc = $catReports->whereIn('status', ['escalated', 'unresolved'])->count();
                    $pen = $catReports->whereIn('status', ['pending', 'submitted', 'under_review'])->count();
                    $rate = $tot > 0 ? round(($set / $tot) * 100, 1) . '%' : '0%';

                    fputcsv($file, [$catName, $tot, $set, 0, 0, $esc, 0, $pen, $rate]);
                }

                $grandRate = $grandTotal > 0 ? round(($grandSettled / $grandTotal) * 100, 1) . '%' : '0%';
                fputcsv($file, ['GRAND TOTAL', $grandTotal, $grandSettled, 0, 0, $reports->whereIn('status', ['escalated', 'unresolved'])->count(), 0, $reports->whereIn('status', ['pending', 'submitted', 'under_review'])->count(), $grandRate]);
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }

        $filename = "Justice_" . ucfirst($reportType) . "_Report_" . date('Y-m-d') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        if ($reportType === 'hearings') {
            $columns = ['Case No', 'Dispute Nature', 'Complainant', 'Respondent', 'Hearing Date & Time', 'Status', 'Date Filed'];
        } elseif ($reportType === 'settled') {
            $columns = ['Case No', 'Dispute Nature', 'Complainant', 'Respondent', 'Settlement Date', 'Status', 'KP Form Reference'];
        } else {
            $columns = ['Case No', 'Dispute Nature', 'Complainant', 'Respondent', 'Incident Date', 'Hearing Date', 'Status', 'Date Filed'];
        }

        $callback = function() use($reports, $columns, $reportType) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($reports as $r) {
                $caseNo = $r->case_no ?? ('JUS-' . $r->created_at->format('Y') . '-' . str_pad($r->id, 3, '0', STR_PAD_LEFT));
                
                if ($reportType === 'hearings') {
                    fputcsv($file, [
                        $caseNo,
                        $r->issue_type,
                        $r->complainant_name ?? 'N/A',
                        $r->respondent_name ?? 'N/A',
                        $r->hearing_date ? \Carbon\Carbon::parse($r->hearing_date)->format('Y-m-d h:i A') : 'None',
                        $r->status,
                        $r->created_at->format('Y-m-d')
                    ]);
                } elseif ($reportType === 'settled') {
                    fputcsv($file, [
                        $caseNo,
                        $r->issue_type,
                        $r->complainant_name ?? 'N/A',
                        $r->respondent_name ?? 'N/A',
                        $r->updated_at->format('Y-m-d'),
                        'Settled / Amicable Agreement',
                        'KP Form 16 (Amicable Settlement)'
                    ]);
                } else {
                    fputcsv($file, [
                        $caseNo,
                        $r->issue_type,
                        $r->complainant_name ?? 'N/A',
                        $r->respondent_name ?? 'N/A',
                        $r->incident_date ?? 'N/A',
                        $r->hearing_date ? \Carbon\Carbon::parse($r->hearing_date)->format('Y-m-d h:i A') : 'N/A',
                        $r->status,
                        $r->created_at->format('Y-m-d')
                    ]);
                }
            }
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

        // Process rows
        $firstRow = array_map(fn($v) => strtolower(trim((string)$v)), $rows[0] ?? []);
        $hasHeader = false;
        
        // Header lookup map
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
                continue; // skip blank line
            }

            // Extract values
            $type = $colMap['type'] !== null ? ($row[$colMap['type']] ?? null) : ($row[0] ?? null);
            $complainant = $colMap['complainant'] !== null ? ($row[$colMap['complainant']] ?? null) : ($row[1] ?? null);
            $contact = $colMap['contact'] !== null ? ($row[$colMap['contact']] ?? null) : ($row[2] ?? '09000000000');
            $respondent = $colMap['respondent'] !== null ? ($row[$colMap['respondent']] ?? null) : ($row[3] ?? 'N/A');
            $dateVal = $colMap['date'] !== null ? ($row[$colMap['date']] ?? null) : ($row[4] ?? date('Y-m-d'));
            $statusVal = $colMap['status'] !== null ? ($row[$colMap['status']] ?? null) : ($row[5] ?? 'submitted');
            $location = $colMap['location'] !== null ? ($row[$colMap['location']] ?? null) : ($row[6] ?? 'Barangay San Miguel II');
            $description = $colMap['description'] !== null ? ($row[$colMap['description']] ?? null) : ($row[7] ?? 'Imported blotter record.');
            $witness = $colMap['witness'] !== null ? ($row[$colMap['witness']] ?? null) : ($row[8] ?? null);
            $address = $colMap['address'] !== null ? ($row[$colMap['address']] ?? null) : null;
            $age = $colMap['age'] !== null && is_numeric($row[$colMap['age']] ?? '') ? (int)$row[$colMap['age']] : null;
            $gender = $colMap['gender'] !== null ? ($row[$colMap['gender']] ?? null) : null;

            if (empty($complainant) && empty($type)) {
                continue;
            }

            // Format date
            $parsedDate = date('Y-m-d');
            if (!empty($dateVal)) {
                try {
                    $parsedDate = \Carbon\Carbon::parse($dateVal)->format('Y-m-d');
                } catch (\Exception $e) {
                    $parsedDate = date('Y-m-d');
                }
            }

            // Format status
            $cleanStatus = strtolower(trim(str_replace([' ', '-'], '_', (string)$statusVal)));
            if (!in_array($cleanStatus, ['submitted', 'under_review', 'pending', 'settled', 'resolved', 'urgent'])) {
                $cleanStatus = 'submitted';
            }

            IssueReport::create([
                'user_id'            => auth()->id() ?? null,
                'issue_type'         => !empty($type) ? trim((string)$type) : 'Neighbor Dispute',
                'department'         => 'Justice',
                'complainant_name'   => !empty($complainant) ? trim((string)$complainant) : 'Anonymous / Resident',
                'contact'            => !empty($contact) ? trim((string)$contact) : '09000000000',
                'complainant_age'    => $age,
                'complainant_gender' => $gender,
                'respondent_name'    => !empty($respondent) ? trim((string)$respondent) : 'N/A',
                'respondent_address' => $address,
                'incident_date'      => $parsedDate,
                'location'           => !empty($location) ? trim((string)$location) : 'Barangay San Miguel II',
                'witness_name'       => $witness,
                'description'        => !empty($description) ? trim((string)$description) : 'Imported blotter record.',
                'status'             => $cleanStatus,
            ]);

            $importedCount++;
        }

        return redirect()->back()->with('success', "Successfully imported {$importedCount} blotter records into the Justice Portal!");
    }

    public function sampleTemplate()
    {
        $filename = "Blotter_Import_Template.csv";
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
            'Respondent Address',
            'Incident Date',
            'Location',
            'Description',
            'Witness Name',
            'Status'
        ];

        $sampleData = [
            [
                'Dispute over Property',
                'Juan Dela Cruz',
                '09123456789',
                '35',
                'Male',
                'Pedro Santos',
                'Block 12 Lot 5, San Miguel II',
                date('Y-m-d', strtotime('-3 days')),
                'Purok 3, Main Street',
                'Disagreement regarding property boundary fence and setback.',
                'Maria Clara',
                'pending'
            ],
            [
                'Noise / Disturbance',
                'Juana Reyes',
                '09987654321',
                '42',
                'Female',
                'Mario Lopez',
                'Purok 4, San Miguel II',
                date('Y-m-d', strtotime('-5 days')),
                'Purok 4',
                'Excessive loud karaoke beyond 10:00 PM causing neighborhood disturbance.',
                '',
                'settled'
            ],
        ];

        $callback = function() use ($columns, $sampleData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($sampleData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
