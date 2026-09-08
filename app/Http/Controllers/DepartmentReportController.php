<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DepartmentReport;
use Illuminate\Support\Facades\Storage;

class DepartmentReportController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'department'       => 'required|string',
            'report_title'     => 'required|string',
            'reporting_period' => 'required|string',
        ]);

        $reportData = $request->input('report_data');
        if (is_string($reportData)) {
            $reportData = json_decode($reportData, true);
        }

        $templateFilePath = null;
        if ($request->hasFile('template_file')) {
            $templateFilePath = $request->file('template_file')->store('report_templates', 'public');
        }

        $user = auth()->user();
        $submittedBy = $request->input('submitted_by');
        if (empty(trim((string)$submittedBy))) {
            $submittedBy = $user ? trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) : 'Department Staff';
            if (empty(trim((string)$submittedBy))) {
                $submittedBy = $user->name ?? 'Department Staff';
            }
        }

        $submittedRole = $request->input('submitted_role') ?? ($user->role ?? 'Staff');

        $report = DepartmentReport::create([
            'department'       => $request->department,
            'report_title'     => $request->report_title,
            'reporting_period' => $request->reporting_period,
            'report_data'      => $reportData,
            'template_file'    => $templateFilePath,
            'submitted_by'     => $submittedBy,
            'submitted_role'   => $submittedRole,
            'status'           => 'Submitted',
        ]);

        return redirect()->back()->with('success', "{$request->department} report has been successfully submitted to Admin!");
    }

    public function show($id)
    {
        $report = DepartmentReport::findOrFail($id);
        return view('reports.department_view', compact('report'));
    }

    public function uploadTemplate(Request $request)
    {
        $request->validate([
            'department'    => 'required|string',
            'template_file' => 'required|file|max:15360', // 15MB max
        ]);

        $path = $request->file('template_file')->store('report_templates', 'public');

        return redirect()->back()->with('success', 'New report template uploaded successfully for ' . $request->department);
    }
}
