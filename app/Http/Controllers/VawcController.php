<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueReport;
use App\Models\VawcAuditLog;
use App\Notifications\IssueStatusUpdated;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VawcController extends Controller
{
    public function index(Request $request)
    {
        $query = IssueReport::where('department', 'VAWC');

        // Search logic
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('complainant_name', 'like', "%{$search}%")
                    ->orWhere('victim_name', 'like', "%{$search}%")
                    ->orWhere('issue_type', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        // Date Picker Filter
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Status Select Filter
        if ($request->filled('status_filter')) {
            $query->where('status', $request->status_filter);
        }

        // Issue Type Filter
        if ($request->filled('issue_type_filter')) {
            $query->where('issue_type', $request->issue_type_filter);
        }

        // Dropdown timeframe Filter
        if ($request->filled('filter')) {
            $filter = $request->filter;
            if ($filter === 'today') {
                $query->whereDate('created_at', Carbon::today());
            } elseif ($filter === 'month') {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
            }
        }

        $issues = $query->latest()->get();

        $totalV = IssueReport::where('department', 'VAWC')->count();
        $newV = IssueReport::where('department', 'VAWC')->where('status', 'submitted')->count();
        $urgentV = IssueReport::where('department', 'VAWC')->where('status', 'urgent')->count();
        $settledV = IssueReport::where('department', 'VAWC')->where('status', 'settled')->count();

        // Retrieve Privacy Audit Trail
        $auditLogs = VawcAuditLog::latest()->take(100)->get();

        $vawcReports = \App\Models\DepartmentReport::where('department', 'VAWC')->latest()->get();
        $customTemplate = \App\Http\Controllers\DepartmentReportController::getTemplateForDepartment('VAWC');

        return view('vawc.index', compact('issues', 'totalV', 'newV', 'urgentV', 'settledV', 'auditLogs', 'vawcReports', 'customTemplate'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);
        $issue = IssueReport::findOrFail($id);

        $ranks = [
            'submitted'       => 1,
            'pending'         => 1,
            'under_review'    => 2,
            'on_going'        => 3,
            'referred_to_pnp' => 3,
            'urgent'          => 3,
            'approved'        => 3,
            'settled'         => 4,
            'resolved'        => 4,
            'rejected'        => 4,
        ];

        $currentStatus = $issue->status;
        $newStatus = $request->status;

        // Terminal lock
        if (in_array($currentStatus, ['settled', 'resolved', 'rejected'])) {
            return redirect()->back()->with('error', 'This case is already ' . ($currentStatus === 'settled' ? 'resolved' : $currentStatus) . ' and cannot be changed.');
        }

        $currentRank = $ranks[$currentStatus] ?? 0;
        $newRank = $ranks[$newStatus] ?? 0;

        // Strict one-way forward progression
        if ($newStatus !== $currentStatus && $newRank < $currentRank) {
            return redirect()->back()->with('error', 'Status progression is one-way. Cannot revert to a previous stage (' . ucfirst(str_replace('_',' ',$newStatus)) . ').');
        }

        $issue->update(['status' => $newStatus]);

        $caseCode = 'VAWC-' . $issue->created_at->format('Y') . '-' . str_pad($issue->id, 3, '0', STR_PAD_LEFT);
        VawcAuditLog::log(
            action: 'status_update',
            caseId: $issue->id,
            caseCode: $caseCode,
            details: "Status changed from '{$currentStatus}' to '{$newStatus}'."
        );

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

        $caseCode = 'VAWC-' . $issue->created_at->format('Y') . '-' . str_pad($issue->id, 3, '0', STR_PAD_LEFT);
        VawcAuditLog::log(
            action: 'summary_update',
            caseId: $issue->id,
            caseCode: $caseCode,
            details: 'Official staff incident summary updated.'
        );

        return redirect()->back()->with('success', 'Official incident summary securely saved.');
    }

    public function updateReferralDetails(Request $request, $id)
    {
        $issue = IssueReport::findOrFail($id);

        $updateData = [];
        if ($request->has('admin_notes')) {
            $updateData['admin_notes'] = $request->admin_notes;
        }
        if ($request->has('admin_summary')) {
            $updateData['admin_summary'] = $request->admin_summary;
        }
        if ($request->has('location')) {
            $updateData['location'] = $request->location;
        }
        if ($request->has('contact')) {
            $updateData['contact'] = $request->contact;
        }

        if (!empty($updateData)) {
            $issue->update($updateData);

            $caseCode = 'VAWC-' . $issue->created_at->format('Y') . '-' . str_pad($issue->id, 3, '0', STR_PAD_LEFT);
            VawcAuditLog::log(
                action: 'referral_edit',
                caseId: $issue->id,
                caseCode: $caseCode,
                details: 'Referral details updated before dispatch/printing.'
            );
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Referral details updated successfully.',
                'issue' => $issue->fresh()
            ]);
        }

        return redirect()->back()->with('success', 'Referral details updated successfully.');
    }

    public function storeIncident(Request $request)
    {
        $request->validate([
            'issue_type' => 'required|string',
            'complainant_name' => 'required|string',
            'contact' => 'required|string',
            'respondent_name' => 'required|string',
            'witness_name' => 'nullable|string',
            'description' => 'required|string',
        ]);

        $isOnBehalf = $request->boolean('is_on_behalf') || $request->input('is_on_behalf') === '1' || $request->input('is_on_behalf') === 'true';

        $evidencePaths = [];
        if ($request->hasFile('evidence')) {
            foreach ($request->file('evidence') as $file) {
                $evidencePaths[] = $file->store('issue_evidence', 'public');
            }
        }

        $issue = IssueReport::create([
            'user_id' => auth()->id(),
            'issue_type' => $request->issue_type,
            'complainant_name' => $request->complainant_name,
            'complainant_age' => $request->complainant_age ?? null,
            'complainant_gender' => $request->complainant_gender ?? null,
            'complainant_address' => $request->complainant_address ?? null,
            'is_on_behalf' => $isOnBehalf,
            'victim_name' => $isOnBehalf ? ($request->victim_name ?? null) : null,
            'victim_age' => $isOnBehalf ? ($request->victim_age ?? null) : null,
            'victim_gender' => $isOnBehalf ? ($request->victim_gender ?? null) : null,
            'victim_relationship' => $isOnBehalf ? ($request->victim_relationship ?? null) : null,
            'respondent_name' => $request->respondent_name,
            'respondent_address' => $request->respondent_address ?? null,
            'description' => $request->description,
            'location' => $request->incident_location ?? null,
            'incident_date' => $request->incident_date ?? null,
            'witness_name' => $request->witness_name ?? null,
            'evidence' => !empty($evidencePaths) ? json_encode($evidencePaths) : null,
            'contact' => $request->contact,
            'department' => 'VAWC',
            'status' => 'submitted',
            'is_restricted' => true,
        ]);

        $caseCode = 'VAWC-' . $issue->created_at->format('Y') . '-' . str_pad($issue->id, 3, '0', STR_PAD_LEFT);
        VawcAuditLog::log(
            action: 'incident_created',
            caseId: $issue->id,
            caseCode: $caseCode,
            details: "New VAWC incident recorded at desk. (" . ($isOnBehalf ? "On behalf of victim: {$issue->victim_name}" : "Direct filing") . ")"
        );

        return redirect()->back()->with('success', 'New VAWC incident has been recorded securely.');
    }

    public function pnpReferral(Request $request, $id)
    {
        $issue = IssueReport::findOrFail($id);
        $issue->update([
            'status' => 'on_going',
            'admin_notes' => $request->input('admin_notes', 'Escalated to PNP/DSWD for immediate emergency response and assessment.')
        ]);

        $caseCode = 'VAWC-' . $issue->created_at->format('Y') . '-' . str_pad($issue->id, 3, '0', STR_PAD_LEFT);
        VawcAuditLog::log(
            action: 'pnp_escalation',
            caseId: $issue->id,
            caseCode: $caseCode,
            details: 'Case escalated to PNP/DSWD for emergency response. Status updated to On-going.'
        );

        if ($issue->user) {
            $issue->user->notify(new IssueStatusUpdated($issue));
        }

        return redirect()->back()
            ->with('success', 'Incident referred to PNP/DSWD successfully.')
            ->with('referral_issue_id', $issue->id);
    }

    public function printReferral($id)
    {
        $issue = IssueReport::findOrFail($id);

        $caseCode = 'VAWC-' . $issue->created_at->format('Y') . '-' . str_pad($issue->id, 3, '0', STR_PAD_LEFT);
        VawcAuditLog::log(
            action: 'case_view',
            caseId: $issue->id,
            caseCode: $caseCode,
            details: 'Referral Document viewed / printed.'
        );

        return view('vawc.print_referral', compact('issue'));
    }

    public function transferToPeace(Request $request, $id)
    {
        $request->validate([
            'transfer_reason' => 'required|string|min:4'
        ], [
            'transfer_reason.required' => 'A mandatory reason for case transfer is required for the Privacy Audit Trail.',
            'transfer_reason.min' => 'Please provide a sufficient reason for transferring this case.'
        ]);

        $issue = IssueReport::findOrFail($id);
        
        if ($issue->transfer_count >= 1) {
            return redirect()->back()->with('error', 'This case has already been transferred once and cannot be moved again due to audit guardrails.');
        }

        $caseCode = 'VAWC-' . $issue->created_at->format('Y') . '-' . str_pad($issue->id, 3, '0', STR_PAD_LEFT);
        $reason = $request->input('transfer_reason');

        $issue->update([
            'department' => 'Peace & Order',
            'is_restricted' => false,
            'status' => 'submitted',
            'transfer_count' => DB::raw('transfer_count + 1'),
            'transfer_reason' => $reason,
        ]);

        VawcAuditLog::log(
            action: 'case_transfer',
            caseId: $issue->id,
            caseCode: $caseCode,
            details: "Case re-routed to Peace & Order / KP Desk. Reason: \"{$reason}\""
        );

        return redirect()->back()->with('success', 'Case has been re-routed and transferred to Peace & Order Desk. Action logged to Privacy Audit.');
    }

    public function export(Request $request)
    {
        $format = strtolower($request->query('format', 'csv'));
        $period = $request->query('period', 'all');
        $reportType = $request->query('type', 'all');

        $query = IssueReport::where('department', 'VAWC');

        if ($period === 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($period === 'month') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
        } elseif ($period === 'year') {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        if ($reportType === 'pnp_referrals') {
            $query->whereIn('status', ['urgent', 'on_going', 'referred_to_pnp']);
        } elseif ($reportType === 'settled') {
            $query->where('status', 'settled');
        }

        $reports = $query->latest()->get();

        VawcAuditLog::log(
            action: $format === 'pdf' ? 'export_pdf' : 'export_csv',
            details: "Confidential records exported (" . strtoupper($format) . ") — Filter: Period={$period}, Type={$reportType}, Count=" . $reports->count()
        );

        if ($format === 'pdf') {
            return view('vawc.export_pdf', compact('reports', 'period', 'reportType'));
        }

        // CSV Export
        $filename = "VAWC_Reports_" . ($period !== 'all' ? $period . "_" : "") . date('Y-m-d') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'Case Code',
            'Category',
            'Complainant Name',
            'Complainant Age/Gender',
            'On Behalf of Victim?',
            'Victim Name',
            'Victim Age/Gender',
            'Victim Relationship',
            'Contact',
            'Respondent',
            'Incident Date',
            'Location',
            'Status',
            'Date Filed'
        ];

        $callback = function() use($reports, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($reports as $r) {
                $caseCode = 'VAWC-' . $r->created_at->format('Y') . '-' . str_pad($r->id, 3, '0', STR_PAD_LEFT);
                fputcsv($file, [
                    $caseCode,
                    $r->issue_type,
                    $r->complainant_name,
                    ($r->complainant_age ? $r->complainant_age . ' / ' : '') . ($r->complainant_gender ?? 'N/A'),
                    $r->is_on_behalf ? 'YES' : 'NO',
                    $r->is_on_behalf ? ($r->victim_name ?? 'N/A') : 'Self',
                    $r->is_on_behalf ? (($r->victim_age ? $r->victim_age . ' / ' : '') . ($r->victim_gender ?? 'N/A')) : 'N/A',
                    $r->is_on_behalf ? ($r->victim_relationship ?? 'N/A') : 'Complainant is Victim',
                    $r->contact,
                    $r->respondent_name ?? 'N/A',
                    $r->incident_date ? Carbon::parse($r->incident_date)->format('Y-m-d') : 'N/A',
                    $r->location ?? 'Barangay San Miguel II',
                    ucfirst(str_replace('_', ' ', $r->status)),
                    $r->created_at->format('Y-m-d')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getAuditLogs()
    {
        $logs = VawcAuditLog::latest()->take(100)->get()->map(function($l) {
            return [
                'id' => $l->id,
                'staff_name' => $l->staff_name,
                'staff_role' => $l->staff_role,
                'action' => $l->action,
                'action_label' => match($l->action) {
                    'case_transfer' => 'Case Re-Routed',
                    'pnp_escalation' => 'PNP/DSWD Escalation',
                    'case_view' => 'File / PDF Access',
                    'export_pdf' => 'Exported PDF',
                    'export_csv' => 'Exported CSV',
                    'summary_update' => 'Summary Updated',
                    'status_update' => 'Status Updated',
                    'referral_edit' => 'Referral Edited',
                    'incident_created' => 'Incident Created',
                    default => ucfirst(str_replace('_', ' ', $l->action))
                },
                'case_code' => $l->case_code,
                'details' => $l->details,
                'ip_address' => $l->ip_address,
                'created_at_human' => $l->created_at->diffForHumans(),
                'created_at_full' => $l->created_at->format('M d, Y h:i A')
            ];
        });

        return response()->json(['success' => true, 'logs' => $logs]);
    }

    public function sampleTemplate()
    {
        $filename = "VAWC_Import_Template.csv";
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
            'Is On Behalf (YES/NO)',
            'Victim Name',
            'Victim Age',
            'Victim Gender',
            'Victim Relationship',
            'Respondent Name',
            'Address',
            'Incident Date (YYYY-MM-DD)',
            'Location',
            'Description',
            'Witness Name',
            'Status'
        ];

        $sampleRow = [
            'VAWC – Physical Abuse',
            'Juana Dela Cruz',
            '09123456789',
            '28',
            'Female',
            'NO',
            '',
            '',
            '',
            '',
            'John Doe',
            'Block 2 Lot 8, Phase 2',
            date('Y-m-d'),
            'House / Residence',
            'Physical altercation and threat.',
            'Barangay Tanod On Duty',
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

        $firstRow = array_map(fn($v) => strtolower(trim((string)$v)), $rows[0] ?? []);
        $hasHeader = false;
        
        $colMap = [
            'type'        => null,
            'complainant' => null,
            'contact'     => null,
            'age'         => null,
            'gender'      => null,
            'on_behalf'   => null,
            'victim_name' => null,
            'victim_age'  => null,
            'victim_gender' => null,
            'victim_rel'  => null,
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
            if (str_contains($h, 'type') || str_contains($h, 'issue') || str_contains($h, 'case') || str_contains($h, 'category')) {
                $colMap['type'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'complainant') || str_contains($h, 'complainer')) {
                $colMap['complainant'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'contact') || str_contains($h, 'phone') || str_contains($h, 'mobile')) {
                $colMap['contact'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'compage') || (str_contains($h, 'age') && !str_contains($h, 'victim'))) {
                $colMap['age'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'compgender') || (str_contains($h, 'gender') && !str_contains($h, 'victim'))) {
                $colMap['gender'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'onbehalf') || str_contains($h, 'behalf')) {
                $colMap['on_behalf'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'victimname') || str_contains($h, 'victim')) {
                $colMap['victim_name'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'victimage')) {
                $colMap['victim_age'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'victimgender')) {
                $colMap['victim_gender'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'relationship') || str_contains($h, 'relation')) {
                $colMap['victim_rel'] = $idx; $hasHeader = true;
            } elseif (str_contains($h, 'respondent') || str_contains($h, 'accused') || str_contains($h, 'suspect') || str_contains($h, 'perpetrator')) {
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
            $gender = $colMap['gender'] !== null ? ($row[$colMap['gender']] ?? null) : 'Female';
            $onBehalfVal = $colMap['on_behalf'] !== null ? strtolower(trim((string)($row[$colMap['on_behalf']] ?? ''))) : '';
            $isOnBehalf = in_array($onBehalfVal, ['1', 'true', 'yes', 'y']);
            $vName = $colMap['victim_name'] !== null ? ($row[$colMap['victim_name']] ?? null) : null;
            $vAge = $colMap['victim_age'] !== null && is_numeric($row[$colMap['victim_age']] ?? '') ? (int)$row[$colMap['victim_age']] : null;
            $vGender = $colMap['victim_gender'] !== null ? ($row[$colMap['victim_gender']] ?? null) : null;
            $vRel = $colMap['victim_rel'] !== null ? ($row[$colMap['victim_rel']] ?? null) : null;

            $respondent = $colMap['respondent'] !== null ? ($row[$colMap['respondent']] ?? null) : ($row[3] ?? 'N/A');
            $address = $colMap['address'] !== null ? ($row[$colMap['address']] ?? null) : null;
            $dateVal = $colMap['date'] !== null ? ($row[$colMap['date']] ?? null) : ($row[4] ?? date('Y-m-d'));
            $location = $colMap['location'] !== null ? ($row[$colMap['location']] ?? null) : ($row[5] ?? 'Barangay San Miguel II');
            $description = $colMap['description'] !== null ? ($row[$colMap['description']] ?? null) : ($row[6] ?? 'Imported VAWC record.');
            $witness = $colMap['witness'] !== null ? ($row[$colMap['witness']] ?? null) : ($row[7] ?? null);
            $statusVal = $colMap['status'] !== null ? ($row[$colMap['status']] ?? null) : ($row[8] ?? 'submitted');

            if (empty($complainant) && empty($type)) {
                continue;
            }

            $parsedDate = date('Y-m-d');
            if (!empty($dateVal)) {
                try {
                    $parsedDate = Carbon::parse($dateVal)->format('Y-m-d');
                } catch (\Exception $e) {
                    $parsedDate = date('Y-m-d');
                }
            }

            $cleanStatus = strtolower(trim(str_replace([' ', '-'], '_', (string)$statusVal)));
            if (!in_array($cleanStatus, ['submitted', 'under_review', 'pending', 'on_going', 'referred_to_pnp', 'urgent', 'approved', 'settled', 'resolved', 'rejected'])) {
                $cleanStatus = 'submitted';
            }

            IssueReport::create([
                'user_id'             => auth()->id() ?? null,
                'issue_type'          => !empty($type) ? trim((string)$type) : 'VAWC – General Incident',
                'department'          => 'VAWC',
                'is_restricted'       => true,
                'complainant_name'    => !empty($complainant) ? trim((string)$complainant) : 'Confidential Complainant',
                'contact'             => !empty($contact) ? trim((string)$contact) : '09000000000',
                'complainant_age'     => $age,
                'complainant_gender'  => $gender ?: 'Female',
                'complainant_address' => $address,
                'is_on_behalf'        => $isOnBehalf,
                'victim_name'         => $vName,
                'victim_age'          => $vAge,
                'victim_gender'       => $vGender,
                'victim_relationship' => $vRel,
                'respondent_name'     => !empty($respondent) ? trim((string)$respondent) : 'N/A',
                'respondent_address'  => $address,
                'incident_date'       => $parsedDate,
                'location'            => !empty($location) ? trim((string)$location) : 'Barangay San Miguel II',
                'witness_name'        => $witness,
                'description'         => !empty($description) ? trim((string)$description) : 'Imported VAWC confidential record.',
                'status'              => $cleanStatus,
            ]);

            $importedCount++;
        }

        VawcAuditLog::log(
            action: 'import_batch',
            details: "Batch import completed: {$importedCount} records uploaded into VAWC desk."
        );

        return redirect()->back()->with('success', "Successfully imported {$importedCount} confidential cases into the VAWC Portal!");
    }

    public function uploadOfficialDocument(Request $request, $id)
    {
        $request->validate([
            'document_file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:20480',
        ]);

        $issue = IssueReport::findOrFail($id);

        if ($issue->official_document) {
            Storage::disk('public')->delete($issue->official_document);
        }

        $file = $request->file('document_file');
        $originalName = $file->getClientOriginalName();
        $path = $file->store('vawc_documents', 'public');

        $issue->update([
            'official_document' => $path,
            'official_document_name' => $originalName,
        ]);

        $caseCode = 'VAWC-' . $issue->created_at->format('Y') . '-' . str_pad($issue->id, 3, '0', STR_PAD_LEFT);
        VawcAuditLog::log(
            action: 'document_upload',
            caseId: $issue->id,
            caseCode: $caseCode,
            details: "Uploaded official barangay referral document / scan: {$originalName}"
        );

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Official document scan uploaded successfully.',
                'file_url' => asset('storage/' . $path),
                'file_name' => $originalName,
                'file_type' => strtolower(pathinfo($path, PATHINFO_EXTENSION))
            ]);
        }

        return redirect()->back()->with('success', 'Official document scan uploaded successfully.');
    }

    public function removeOfficialDocument(Request $request, $id)
    {
        $issue = IssueReport::findOrFail($id);

        if ($issue->official_document) {
            Storage::disk('public')->delete($issue->official_document);
        }

        $oldName = $issue->official_document_name;
        $issue->update([
            'official_document' => null,
            'official_document_name' => null,
        ]);

        $caseCode = 'VAWC-' . $issue->created_at->format('Y') . '-' . str_pad($issue->id, 3, '0', STR_PAD_LEFT);
        VawcAuditLog::log(
            action: 'document_remove',
            caseId: $issue->id,
            caseCode: $caseCode,
            details: "Removed attached official document scan (" . ($oldName ?: 'Document') . ")."
        );

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Official document removed successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Official document removed successfully.');
    }
}