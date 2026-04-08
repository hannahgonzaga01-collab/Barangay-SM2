<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueReport;
use App\Notifications\IssueStatusUpdated;

class JusticeController extends Controller
{
    public function dashboard()
    {
        $reports = IssueReport::where('department', 'Justice')->latest()->get();
        return view('justice.index', compact('reports'));
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
            'respondent_name' => $validated['respondent_name'],
            'respondent_address' => $validated['respondent_address'] ?? null,
            'incident_date' => $validated['incident_date'],
            'location' => $validated['incident_location'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'Blotter entry successfully created.');
    }

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

    public function issueSummon(Request $request)
    {
        $validated = $request->validate([
            'issue_id' => 'required|exists:issue_reports,id',
            'hearing_date' => 'required|date',
            'time' => 'required|string',
        ]);

        $issue = IssueReport::findOrFail($validated['issue_id']);
        
        $datetime = \Carbon\Carbon::parse($validated['hearing_date'] . ' ' . $validated['time'])->toDateTimeString();
        
        // Update issue with hearing date, and change status if currently submitted
        $updateData = ['hearing_date' => $datetime];
        if ($issue->status === 'submitted') {
            $updateData['status'] = 'under_review';
        }
        
        $issue->update($updateData);

        if ($issue->user) {
            \Illuminate\Support\Facades\Mail::to($issue->user->email)->send(new \App\Mail\SummonIssuedMail($issue));
        }

        return redirect()->back()->with([
            'success' => 'Summon generated and resident notified via email.',
            'print_summon' => [
                'case_no' => 'JUS-'.$issue->created_at->format('Y').'-'.str_pad($issue->id,3,'0',STR_PAD_LEFT),
                'complainant' => $issue->complainant_name ?? '',
                'respondent' => $issue->respondent_name ?? '',
                'issue_type' => $issue->issue_type ?? '',
                'date' => \Carbon\Carbon::parse($datetime)->format('F d, Y'),
                'time' => \Carbon\Carbon::parse($datetime)->format('h:i A'),
            ]
        ]);
    }
}
