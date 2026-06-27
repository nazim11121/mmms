@extends('layouts.admin')
@section('title', 'Reports')
@section('page-title', 'Member Reports')
@section('content')
<style>
.report-filter { background: var(--surface); border: 1px solid var(--border); border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
.report-filter select { padding: 8px 12px; border: 1.5px solid var(--border); border-radius: 8px; font-size: .83rem; font-family: inherit; background: var(--bg); color: var(--text1); outline: none; }
.rf-btn { padding: 8px 18px; background: var(--brand); color: #fff; border: none; border-radius: 8px; font-size: .83rem; font-weight: 700; font-family: inherit; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: background .2s; }
.rf-btn:hover { background: var(--brand-dark); }

.reports-list { display: flex; flex-direction: column; gap: 12px; }
.report-card { background: var(--surface); border: 1px solid var(--border); border-radius: 14px; padding: 16px 20px; }
.report-card.pending { border-left: 3px solid #d97706; }
.report-card.resolved { border-left: 3px solid #16a34a; }
.report-card.reviewed { border-left: 3px solid #3b82f6; }
.report-header { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 10px; }
.report-avatars { display: flex; }
.report-avatars img { width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid var(--surface); flex-shrink: 0; box-shadow: var(--sh-sm); }
.report-avatars img:last-child { margin-left: -10px; }
.report-body { flex: 1; min-width: 0; }
.report-names { font-size: .875rem; font-weight: 600; color: var(--text1); margin-bottom: 3px; }
.report-reason { font-size: .83rem; color: var(--text2); margin-bottom: 4px; }
.report-meta { font-size: .75rem; color: var(--text4); }
.report-status-badge { padding: 3px 10px; border-radius: 20px; font-size: .7rem; font-weight: 700; flex-shrink: 0; align-self: flex-start; }
.report-status-badge.pending { background: rgba(245,158,11,.1); color: #d97706; }
.report-status-badge.resolved { background: rgba(34,197,94,.1); color: #16a34a; }
.report-status-badge.reviewed { background: rgba(59,130,246,.1); color: #3b82f6; }
.report-actions { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--border-2); }
.ra-btn { padding: 6px 14px; border-radius: 7px; font-size: .78rem; font-weight: 700; cursor: pointer; border: none; font-family: inherit; display: inline-flex; align-items: center; gap: 5px; transition: all .2s; }
.ra-btn.resolve { background: rgba(34,197,94,.1); color: #16a34a; border: 1px solid rgba(34,197,94,.25); }
.ra-btn.resolve:hover { background: #16a34a; color: #fff; }
.ra-btn.dismiss { background: rgba(120,120,120,.1); color: #666; border: 1px solid rgba(120,120,120,.2); }
.ra-btn.dismiss:hover { background: #666; color: #fff; }
.ra-btn.view-profile { background: rgba(59,130,246,.1); color: #3b82f6; border: 1px solid rgba(59,130,246,.2); text-decoration: none; }
.ra-btn.view-profile:hover { background: #3b82f6; color: #fff; }
</style>

<form method="GET" class="report-filter">
    <select name="status">
        <option value="">All Status</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
        <option value="reviewed" {{ request('status') === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
    </select>
    <button type="submit" class="rf-btn"><i class="fas fa-filter"></i> Filter</button>
    @if(request('status'))
        <a href="{{ route('admin.reports.index') }}" style="font-size:.83rem; color:var(--text3); text-decoration:none; align-self:center; font-weight:500;">Clear</a>
    @endif
    <div style="margin-left:auto; font-size:.83rem; color:var(--text3);">{{ $reports->total() }} report{{ $reports->total() != 1 ? 's' : '' }}</div>
</form>

@if($reports->count() > 0)
<div class="reports-list">
    @foreach($reports as $report)
    <div class="report-card {{ $report->status }}">
        <div class="report-header">
            <div class="report-avatars">
                <img src="{{ $report->reporter->photo_url }}" alt="{{ $report->reporter->name }}" title="Reporter: {{ $report->reporter->name }}">
                <img src="{{ $report->reportedUser->photo_url }}" alt="{{ $report->reportedUser->name }}" title="Reported: {{ $report->reportedUser->name }}">
            </div>
            <div class="report-body">
                <div class="report-names">
                    <strong>{{ $report->reporter->name }}</strong> reported <strong>{{ $report->reportedUser->name }}</strong>
                </div>
                <div class="report-reason">{{ ucfirst(str_replace('_', ' ', $report->reason)) }}</div>
                <div class="report-meta"><i class="fas fa-clock" style="margin-right:3px;"></i>{{ $report->created_at->diffForHumans() }}</div>
                @if($report->description)
                <div style="margin-top:8px; font-size:.82rem; color:var(--text3); background:var(--bg); padding:8px 12px; border-radius:7px; border-left:2px solid var(--border);">
                    "{{ $report->description }}"
                </div>
                @endif
            </div>
            <span class="report-status-badge {{ $report->status }}">{{ ucfirst($report->status) }}</span>
        </div>

        @if($report->status === 'pending')
        <div class="report-actions">
            <a href="{{ route('admin.users.show', $report->reportedUser) }}" class="ra-btn view-profile">
                <i class="fas fa-eye"></i> View Reported Profile
            </a>
            <form method="POST" action="{{ route('admin.reports.update', $report) }}" style="margin:0">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="resolved">
                <button type="submit" class="ra-btn resolve"><i class="fas fa-check"></i> Mark Resolved</button>
            </form>
            <form method="POST" action="{{ route('admin.reports.update', $report) }}" style="margin:0">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="reviewed">
                <button type="submit" class="ra-btn dismiss"><i class="fas fa-times"></i> Dismiss</button>
            </form>
        </div>
        @endif
    </div>
    @endforeach
</div>
<div style="margin-top:24px;">{{ $reports->withQueryString()->links() }}</div>
@else
<div style="text-align:center; padding:64px 20px;">
    <i class="fas fa-flag" style="font-size:3rem; color:var(--text4); margin-bottom:16px; display:block;"></i>
    <div style="font-family:'Playfair Display',serif; font-size:1.2rem; color:var(--text2); margin-bottom:8px;">No reports found</div>
    <p style="color:var(--text3); font-size:.9rem;">{{ request('status') ? 'No ' . request('status') . ' reports.' : 'No reports have been submitted yet.' }}</p>
</div>
@endif
@endsection
