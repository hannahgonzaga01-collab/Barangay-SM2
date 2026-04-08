<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssueReport;
use App\Notifications\IssueStatusUpdated;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        return view('vawc.index', compact('issues', 'totalV', 'newV', 'urgentV', 'settledV'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|string']);

        $issue = IssueReport::findOrFail($id);
        $issue->update(['status' => $request->status]);

        // Notify the resident if possible
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

    public function storeIncident(Request $request)
    {
        $request->validate([
            'issue_type' => 'required|string',
            'complainant_name' => 'required|string',
            'contact' => 'required|string',
            'respondent_name' => 'required|string',
            'description' => 'required|string',
        ]);

        IssueReport::create([
            'user_id' => auth()->id(),
            'issue_type' => $request->issue_type,
            'complainant_name' => $request->complainant_name,
            'complainant_age' => $request->complainant_age ?? null,
            'complainant_gender' => $request->complainant_gender ?? null,
            'respondent_name' => $request->respondent_name,
            'respondent_address' => $request->respondent_address ?? null,
            'description' => $request->description,
            'location' => $request->incident_location ?? null,
            'incident_date' => $request->incident_date ?? null,
            'contact' => $request->contact,
            'department' => 'VAWC',
            'status' => 'submitted',
        ]);

        return redirect()->back()->with('success', 'New VAWC incident has been proudly recorded securely.');
    }

    public function pnpReferral(Request $request, $id)
    {
        $issue = IssueReport::findOrFail($id);
        $issue->update([
            'status' => 'on_going',
            'admin_notes' => 'Escalated to PNP/DSWD for immediate emergency assessment.'
        ]);

        if ($issue->user) {
            $issue->user->notify(new IssueStatusUpdated($issue));
        }

        return redirect()->back()
            ->with('success', 'Incident referred to PNP successfully. Referral Document is generating...')
            ->with('referral_pdf', $id);
    }

    public function printReferral($id)
    {
        $issue = IssueReport::findOrFail($id);
        return view('vawc.print_referral', compact('issue'));
    }
}
