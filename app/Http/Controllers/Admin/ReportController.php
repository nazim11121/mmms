<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = Report::with('reporter', 'reportedUser')
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(20);
        return view('admin.reports.index', compact('reports'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:reviewed,resolved',
            'admin_note' => 'nullable|string',
        ]);
        $report->update($request->only('status', 'admin_note'));
        return back()->with('success', 'Report updated.');
    }
}
