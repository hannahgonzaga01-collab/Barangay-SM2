<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DepartmentReport;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DepartmentReportController extends Controller
{
    /**
     * Retrieve the active custom report template metadata for a department.
     */
    public static function getTemplateForDepartment(string $department): ?array
    {
        $key = 'report_template_' . Str::slug($department, '_');
        $setting = SiteSetting::where('key', $key)->first();
        if ($setting && !empty($setting->value)) {
            $decoded = json_decode($setting->value, true);
            if (is_array($decoded) && !empty($decoded['path']) && Storage::disk('public')->exists($decoded['path'])) {
                return $decoded;
            }
        }
        return null;
    }

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
        } elseif ($request->filled('template_file_path')) {
            $candidate = $request->input('template_file_path');
            if (Storage::disk('public')->exists($candidate)) {
                $templateFilePath = $candidate;
            }
        }

        // If no file provided in form, auto-attach the active custom template for this department
        if (!$templateFilePath) {
            $activeTemplate = self::getTemplateForDepartment($request->department);
            if ($activeTemplate && !empty($activeTemplate['path'])) {
                $templateFilePath = $activeTemplate['path'];
            }
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

        $file = $request->file('template_file');
        $path = $file->store('report_templates', 'public');
        $key  = 'report_template_' . Str::slug($request->department, '_');

        // Delete old template file if it exists
        $existing = SiteSetting::where('key', $key)->first();
        if ($existing && !empty($existing->value)) {
            $old = json_decode($existing->value, true);
            if (!empty($old['path']) && Storage::disk('public')->exists($old['path'])) {
                Storage::disk('public')->delete($old['path']);
            }
        }

        $user = auth()->user();
        $uploader = $user ? trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) : 'Staff';
        if (empty($uploader)) $uploader = $user->name ?? 'Staff';

        $templateData = [
            'original_name' => $file->getClientOriginalName(),
            'path'          => $path,
            'extension'     => strtolower($file->getClientOriginalExtension()),
            'size_bytes'    => $file->getSize(),
            'size_human'    => round($file->getSize() / 1024, 1) . ' KB',
            'uploaded_at'   => now()->format('M d, Y h:i A'),
            'uploaded_by'   => $uploader,
            'department'    => $request->department,
        ];

        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => json_encode($templateData)]
        );

        return redirect()->back()->with('success', "New custom template for {$request->department} uploaded and set as active format!");
    }

    public function deleteTemplate(Request $request)
    {
        $request->validate([
            'department' => 'required|string',
        ]);

        $key = 'report_template_' . Str::slug($request->department, '_');
        $existing = SiteSetting::where('key', $key)->first();
        if ($existing) {
            if (!empty($existing->value)) {
                $old = json_decode($existing->value, true);
                if (!empty($old['path']) && Storage::disk('public')->exists($old['path'])) {
                    Storage::disk('public')->delete($old['path']);
                }
            }
            $existing->delete();
        }

        return redirect()->back()->with('success', "Custom template removed. {$request->department} reverted to standard system format.");
    }
}
