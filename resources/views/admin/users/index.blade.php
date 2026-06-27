@extends('layouts.admin')
@section('title', 'Members')
@section('page-title', 'Manage Members')
@section('content')
<style>
.admin-search-bar {
    background: var(--surface); border: 1px solid var(--border); border-radius: 12px;
    padding: 16px 20px; margin-bottom: 20px; display: flex; gap: 12px; flex-wrap: wrap; align-items: center;
}
.admin-search-input {
    flex: 1; min-width: 200px; padding: 9px 14px; border: 1.5px solid var(--border);
    border-radius: 9px; font-size: .875rem; font-family: inherit; color: var(--text1);
    background: var(--bg); outline: none; transition: border-color .2s;
}
.admin-search-input:focus { border-color: var(--brand); }
.admin-select { padding: 9px 12px; border: 1.5px solid var(--border); border-radius: 9px; font-size: .875rem; font-family: inherit; background: var(--bg); color: var(--text1); outline: none; }
.admin-filter-btn { padding: 9px 20px; background: var(--brand); color: #fff; border: none; border-radius: 9px; font-size: .875rem; font-weight: 700; font-family: inherit; cursor: pointer; display: flex; align-items: center; gap: 6px; transition: background .2s; }
.admin-filter-btn:hover { background: var(--brand-dark); }

.data-table { width: 100%; border-collapse: collapse; }
.data-table th { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text4); padding: 0 14px 12px; text-align: left; border-bottom: 1.5px solid var(--border); white-space: nowrap; }
.data-table td { padding: 13px 14px; font-size: .875rem; color: var(--text2); border-bottom: 1px solid var(--border-2); vertical-align: middle; }
.data-table tr:last-child td { border-bottom: none; }
.data-table tr:hover td { background: rgba(181,52,26,.025); }
.user-td { display: flex; align-items: center; gap: 10px; }
.user-td img { width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border); flex-shrink: 0; }
.user-td-name { font-weight: 600; color: var(--text1); font-size: .875rem; white-space: nowrap; }
.user-td-email { font-size: .73rem; color: var(--text4); }
.status-pill { padding: 3px 10px; border-radius: 20px; font-size: .72rem; font-weight: 700; display: inline-block; }
.status-pill.active { background: rgba(34,197,94,.1); color: #16a34a; }
.status-pill.inactive { background: rgba(120,120,120,.1); color: #666; }
.status-pill.suspended { background: rgba(239,68,68,.1); color: #dc2626; }
.role-pill { padding: 2px 8px; border-radius: 5px; font-size: .68rem; font-weight: 700; text-transform: uppercase; background: rgba(181,52,26,.1); color: var(--brand); }
.role-pill.admin { background: rgba(139,92,246,.1); color: #7c3aed; }
.td-actions { display: flex; gap: 6px; }
.td-btn { padding: 5px 10px; border-radius: 6px; font-size: .75rem; font-weight: 600; border: none; cursor: pointer; font-family: inherit; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: all .15s; }
.td-btn.view { background: rgba(59,130,246,.1); color: #3b82f6; }
.td-btn.view:hover { background: #3b82f6; color: #fff; }
.td-btn.suspend { background: rgba(239,68,68,.1); color: #dc2626; }
.td-btn.suspend:hover { background: #dc2626; color: #fff; }
.td-btn.activate { background: rgba(34,197,94,.1); color: #16a34a; }
.td-btn.activate:hover { background: #16a34a; color: #fff; }
</style>

<!-- Filter bar -->
<form method="GET" action="{{ route('admin.users.index') }}" class="admin-search-bar">
    <input type="text" name="search" class="admin-search-input" placeholder="Search name, email, phone..." value="{{ request('search') }}">
    <select name="status" class="admin-select">
        <option value="">All Status</option>
        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
    </select>
    <select name="gender" class="admin-select">
        <option value="">Any Gender</option>
        <option value="male" {{ request('gender') === 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ request('gender') === 'female' ? 'selected' : '' }}>Female</option>
    </select>
    <button type="submit" class="admin-filter-btn"><i class="fas fa-search"></i> Filter</button>
    @if(request()->hasAny(['search','status','gender']))
        <a href="{{ route('admin.users.index') }}" style="font-size:.83rem; color:var(--text3); text-decoration:none; font-weight:500; align-self:center;">Clear</a>
    @endif
</form>

<!-- Table -->
<div class="panel">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
        <div style="font-size:.875rem; color:var(--text3);">{{ $users->total() }} member{{ $users->total() != 1 ? 's' : '' }}</div>
    </div>
    <div style="overflow-x:auto;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Joined</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>
                        <div class="user-td">
                            <img src="{{ $u->photo_url }}" alt="{{ $u->name }}">
                            <div>
                                <div class="user-td-name">{{ $u->name }}</div>
                                <div class="user-td-email">{{ $u->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="text-transform:capitalize; font-size:.83rem;">{{ $u->profile?->gender ?? '—' }}</td>
                    <td style="font-size:.83rem;">{{ $u->phone ?? '—' }}</td>
                    <td style="white-space:nowrap; font-size:.8rem; color:var(--text4);">{{ $u->created_at->format('d M Y') }}</td>
                    <td><span class="status-pill {{ $u->status }}">{{ ucfirst($u->status) }}</span></td>
                    <td><span class="role-pill {{ $u->role }}">{{ ucfirst($u->role) }}</span></td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('admin.users.show', $u) }}" class="td-btn view"><i class="fas fa-eye"></i></a>
                            @if($u->status !== 'suspended')
                            <form method="POST" action="{{ route('admin.users.status', $u) }}" style="margin:0" onsubmit="return confirm('Suspend this user?')">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="suspended">
                                <button type="submit" class="td-btn suspend"><i class="fas fa-ban"></i></button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('admin.users.status', $u) }}" style="margin:0">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="active">
                                <button type="submit" class="td-btn activate"><i class="fas fa-check"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top:20px;">{{ $users->withQueryString()->links() }}</div>
</div>
@endsection
