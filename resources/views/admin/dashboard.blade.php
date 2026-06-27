@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('content')
<style>
.admin-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
.admin-stat {
    background: var(--surface); border: 1px solid var(--border); border-radius: 14px;
    padding: 20px; display: flex; align-items: center; gap: 14px;
    transition: transform .2s, box-shadow .2s;
}
.admin-stat:hover { transform: translateY(-3px); box-shadow: var(--sh-md); }
.admin-stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
.admin-stat-num { font-family: 'Playfair Display', serif; font-size: 1.7rem; font-weight: 700; color: var(--text1); line-height: 1; }
.admin-stat-label { font-size: .75rem; color: var(--text3); font-weight: 600; text-transform: uppercase; letter-spacing: .04em; margin-top: 3px; }

.admin-section-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }

.recent-table { width: 100%; border-collapse: collapse; }
.recent-table th { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text4); padding: 0 12px 12px; text-align: left; border-bottom: 1px solid var(--border); }
.recent-table td { padding: 12px; font-size: .875rem; color: var(--text2); border-bottom: 1px solid var(--border-2); vertical-align: middle; }
.recent-table tr:last-child td { border-bottom: none; }
.recent-table tr:hover td { background: var(--bg); }
.user-cell { display: flex; align-items: center; gap: 10px; }
.user-cell img { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 1.5px solid var(--border); flex-shrink: 0; }
.user-cell-name { font-weight: 600; color: var(--text1); font-size: .875rem; }
.user-cell-email { font-size: .75rem; color: var(--text4); }

.status-pill { padding: 3px 9px; border-radius: 20px; font-size: .72rem; font-weight: 700; }
.status-pill.active { background: rgba(34,197,94,.1); color: #16a34a; }
.status-pill.inactive { background: rgba(150,150,150,.1); color: #777; }
.status-pill.suspended { background: rgba(239,68,68,.1); color: #dc2626; }

@media (max-width: 1100px) { .admin-stats { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 900px) { .admin-section-grid { grid-template-columns: 1fr; } }
@media (max-width: 600px) { .admin-stats { grid-template-columns: repeat(2, 1fr); } }
</style>

<!-- Stats -->
<div class="admin-stats">
    @php
    $statCards = [
        [$stats['total_members'], 'Total Members', 'fa-users', 'rgba(59,130,246,.1)', '#3b82f6'],
        [$stats['active_members'], 'Active Members', 'fa-user-check', 'rgba(34,197,94,.1)', '#16a34a'],
        [$stats['new_today'], 'New Today', 'fa-user-plus', 'rgba(181,52,26,.1)', 'var(--brand)'],
        [$stats['total_interests'], 'Total Interests', 'fa-heart', 'rgba(236,72,153,.1)', '#db2777'],
        [$stats['active_subscriptions'], 'Active Subs', 'fa-crown', 'rgba(200,139,58,.12)', 'var(--gold)'],
        [$stats['pending_reports'], 'Pending Reports', 'fa-flag', 'rgba(245,158,11,.1)', '#d97706'],
        [$stats['new_this_month'], 'This Month', 'fa-calendar', 'rgba(139,92,246,.1)', '#7c3aed'],
        ['৳' . number_format($stats['total_revenue']), 'Revenue', 'fa-money-bill', 'rgba(20,184,166,.1)', '#0d9488'],
    ];
    @endphp
    @foreach($statCards as [$val, $label, $icon, $bg, $color])
    <div class="admin-stat">
        <div class="admin-stat-icon" style="background:{{ $bg }}; color:{{ $color }};"><i class="fas {{ $icon }}"></i></div>
        <div>
            <div class="admin-stat-num" data-counter data-target="{{ is_numeric($val) ? $val : '' }}">{{ $val }}</div>
            <div class="admin-stat-label">{{ $label }}</div>
        </div>
    </div>
    @endforeach
</div>

<!-- Recent activity -->
<div class="admin-section-grid">
    <!-- Recent users -->
    <div class="panel">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px;">
            <div class="panel-title" style="margin-bottom:0;"><i class="fas fa-users"></i> Recent Members</div>
            <a href="{{ route('admin.users.index') }}" style="font-size:.78rem; color:var(--brand); text-decoration:none; font-weight:600;">View all →</a>
        </div>
        <div style="overflow-x:auto;">
            <table class="recent-table">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Joined</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentMembers as $u)
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="{{ $u->photo_url }}" alt="{{ $u->name }}">
                                <div>
                                    <div class="user-cell-name">{{ $u->name }}</div>
                                    <div class="user-cell-email">{{ $u->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="white-space:nowrap; font-size:.78rem; color:var(--text4);">{{ $u->created_at->format('d M Y') }}</td>
                        <td><span class="status-pill {{ $u->status }}">{{ ucfirst($u->status) }}</span></td>
                        <td><a href="{{ route('admin.users.show', $u) }}" style="font-size:.78rem; color:var(--brand); text-decoration:none; font-weight:600;">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick links -->
    <div>
        <div class="panel" style="margin-bottom:16px;">
            <div class="panel-title" style="margin-bottom:16px;"><i class="fas fa-bolt"></i> Quick Actions</div>
            @php
            $quickLinks = [
                [route('admin.users.index'), 'fa-users', 'Manage Members', 'See all registered members'],
                [route('admin.plans.index'), 'fa-crown', 'Subscription Plans', 'Edit membership packages'],
                [route('admin.settings.index'), 'fa-cog', 'Site Settings', 'Configure site options'],
                [route('admin.reports.index'), 'fa-flag', 'Reports', $stats['pending_reports'] . ' pending'],
            ];
            @endphp
            @foreach($quickLinks as [$href, $icon, $title, $desc])
            <a href="{{ $href }}" style="display:flex; align-items:center; gap:12px; padding:11px 14px; border:1px solid var(--border); border-radius:10px; text-decoration:none; transition:all .2s; margin-bottom:8px; background:var(--bg);">
                <div style="width:36px; height:36px; background:rgba(181,52,26,.1); color:var(--brand); border-radius:9px; display:flex; align-items:center; justify-content:center; font-size:.9rem; flex-shrink:0;">
                    <i class="fas {{ $icon }}"></i>
                </div>
                <div>
                    <div style="font-size:.875rem; font-weight:600; color:var(--text1);">{{ $title }}</div>
                    <div style="font-size:.75rem; color:var(--text4);">{{ $desc }}</div>
                </div>
                <i class="fas fa-chevron-right" style="color:var(--text4); font-size:.7rem; margin-left:auto;"></i>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
