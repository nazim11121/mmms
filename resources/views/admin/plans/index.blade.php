@extends('layouts.admin')
@section('title', 'Subscription Plans')
@section('page-title', 'Subscription Plans')
@section('content')
<style>
.plans-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
.plan-admin-card { background: var(--surface); border: 1.5px solid var(--border); border-radius: 18px; padding: 24px; position: relative; transition: transform .25s, box-shadow .25s; }
.plan-admin-card:hover { transform: translateY(-4px); box-shadow: var(--sh-xl); }
.plan-admin-card.popular { border-color: var(--brand); }
.plan-popular-tag { position: absolute; top: -12px; left: 20px; background: var(--brand); color: #fff; padding: 3px 14px; border-radius: 20px; font-size: .7rem; font-weight: 700; letter-spacing: .04em; }
.plan-admin-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 14px; }
.plan-admin-name { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 700; color: var(--text1); }
.plan-admin-desc { font-size: .82rem; color: var(--text3); margin-bottom: 14px; }
.plan-admin-price { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--brand); margin-bottom: 4px; }
.plan-admin-duration { font-size: .8rem; color: var(--text4); margin-bottom: 16px; }
.plan-features { list-style: none; display: flex; flex-direction: column; gap: 7px; margin-bottom: 20px; }
.plan-features li { font-size: .82rem; color: var(--text2); display: flex; align-items: center; gap: 7px; }
.plan-features li i { color: var(--success); font-size: .8rem; }
.plan-admin-actions { display: flex; gap: 8px; }
.plan-admin-btn { flex: 1; padding: 8px; border-radius: 8px; font-size: .8rem; font-weight: 700; font-family: inherit; cursor: pointer; border: none; display: flex; align-items: center; justify-content: center; gap: 5px; text-decoration: none; transition: all .15s; }
.plan-admin-btn.edit { background: rgba(59,130,246,.1); color: #3b82f6; border: 1px solid rgba(59,130,246,.25); }
.plan-admin-btn.edit:hover { background: #3b82f6; color: #fff; }
.plan-admin-btn.delete { background: rgba(239,68,68,.1); color: #dc2626; border: 1px solid rgba(239,68,68,.25); }
.plan-admin-btn.delete:hover { background: #dc2626; color: #fff; }
</style>

<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
    <p style="color:var(--text3); font-size:.875rem; margin:0;">Manage membership packages</p>
    <a href="{{ route('admin.plans.create') }}" style="padding:9px 20px; background:var(--brand); color:#fff; border-radius:9px; text-decoration:none; font-size:.875rem; font-weight:700; display:inline-flex; align-items:center; gap:7px; transition:background .2s;">
        <i class="fas fa-plus"></i> Add New Plan
    </a>
</div>

<div class="plans-grid">
    @forelse($plans as $plan)
    <div class="plan-admin-card {{ $plan->is_popular ? 'popular' : '' }}">
        @if($plan->is_popular)<span class="plan-popular-tag">Most Popular</span>@endif
        <div class="plan-admin-header">
            <div>
                <div class="plan-admin-name">{{ $plan->name }}</div>
            </div>
            <div style="background:rgba(181,52,26,.1); color:var(--brand); padding:3px 9px; border-radius:6px; font-size:.72rem; font-weight:700;">
                Sort: {{ $plan->sort_order }}
            </div>
        </div>
        <div class="plan-admin-desc">{{ $plan->description }}</div>
        <div class="plan-admin-price">{{ $plan->price == 0 ? 'Free' : '৳' . number_format($plan->price) }}</div>
        <div class="plan-admin-duration">{{ $plan->duration_days }} day{{ $plan->duration_days != 1 ? 's' : '' }}</div>
        @if($plan->features)
        <ul class="plan-features">
            @foreach($plan->features as $f)
            <li><i class="fas fa-check-circle"></i>{{ $f }}</li>
            @endforeach
        </ul>
        @endif
        <div class="plan-admin-actions">
            <a href="{{ route('admin.plans.edit', $plan) }}" class="plan-admin-btn edit"><i class="fas fa-edit"></i> Edit</a>
            <form method="POST" action="{{ route('admin.plans.destroy', $plan) }}" style="flex:1; margin:0;" onsubmit="return confirm('Delete this plan? This cannot be undone.')">
                @csrf @method('DELETE')
                <button type="submit" class="plan-admin-btn delete" style="width:100%;"><i class="fas fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
    @empty
    <div style="grid-column:1/-1; text-align:center; padding:48px; color:var(--text4);">
        <i class="fas fa-crown" style="font-size:2.5rem; margin-bottom:14px; display:block;"></i>
        <div style="font-family:'Playfair Display',serif; font-size:1.1rem; color:var(--text3); margin-bottom:6px;">No plans yet</div>
        <a href="{{ route('admin.plans.create') }}" style="display:inline-flex; align-items:center; gap:6px; margin-top:12px; padding:9px 20px; background:var(--brand); color:#fff; border-radius:9px; text-decoration:none; font-size:.875rem; font-weight:700;">
            <i class="fas fa-plus"></i> Create First Plan
        </a>
    </div>
    @endforelse
</div>
@endsection
