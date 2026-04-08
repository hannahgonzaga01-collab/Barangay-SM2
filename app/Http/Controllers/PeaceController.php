<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueReport;
use App\Notifications\IssueStatusUpdated;

class PeaceController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);

        $issue = IssueReport::findOrFail($id);
        $issue->update(['status' => $request->status]);

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
            'respondent_address' => 'nullable|string',
            'incident_date' => 'required|date',
            'incident_location' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'department' => 'required|string',
        ]);

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
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'Official Blotter Entry permanently recorded.');
    }

    // Handles transferring a case to Katarungang Pambarangay
    public function storePatrol(Request $request)
    {
        $validated = $request->validate([
            'personnel'   => 'required|string',
            'patrol_date' => 'required|date',
            'patrol_time' => 'nullable',
            'area'        => 'required|string',
            'notes'       => 'nullable|string'
        ]);

        \App\Models\IssueReport::create([
            'user_id'          => auth()->id() ?? null,
            'department'       => 'Peace & Order',
            'issue_type'       => 'Patrol Schedule',
            'complainant_name' => $validated['personnel'],
            'incident_date'    => $validated['patrol_date'],
            'location'         => $validated['area'],
            'description'      => $validated['notes'] ?? 'Patrol Duty',
            'status'           => 'pending',
            'contact'          => 'N/A'
        ]);

        return redirect()->back()->with('success', 'Patrol Schedule officially recorded.');
    }

    public function escalateToJustice(Request $request, $id)
    {
        $issue = IssueReport::findOrFail($id);
        
        $updateData = [
            'department' => 'Justice',
            'status' => 'submitted', // Reset status as it enters a new evaluation pipeline
        ];
        
        if ($request->filled('admin_summary')) {
            $updateData['admin_summary'] = $request->admin_summary;
        }

        $issue->update($updateData);

        if ($issue->user) {
            $issue->user->notify(new IssueStatusUpdated($issue));
        }

        return redirect()->back()->with('success', 'Incident officially escalated to Katarungang Pambarangay (Justice).');
    }
}
