@extends('layouts.admin')
@section('title', 'Create Plan')
@section('page-title', 'Create Subscription Plan')
@section('content')
<style>
.plan-form-wrap { max-width: 640px; }
.pf-field { margin-bottom: 18px; }
.pf-label { display: block; font-size: .8rem; font-weight: 600; color: var(--text2); margin-bottom: 6px; letter-spacing: .02em; }
.pf-label span { color: #dc3545; }
.pf-input, .pf-select, .pf-textarea {
    width: 100%; padding: 10px 13px; border: 1.5px solid var(--border);
    border-radius: 9px; background: var(--surface); color: var(--text1);
    font-size: .875rem; font-family: inherit; outline: none; transition: border-color .2s; box-sizing: border-box; -webkit-appearance: none;
}
.pf-input:focus, .pf-select:focus, .pf-textarea:focus { border-color: var(--brand); box-shadow: 0 0 0 3px rgba(181,52,26,.08); }
.pf-textarea { resize: vertical; min-height: 80px; }
.pf-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.pf-error { font-size: .76rem; color: #dc3545; margin-top: 4px; display: flex; align-items: center; gap: 4px; }
.pf-hint { font-size: .75rem; color: var(--text4); margin-top: 4px; }
.feature-row { display: flex; gap: 8px; margin-bottom: 8px; }
.feature-row input { flex: 1; padding: 8px 12px; border: 1.5px solid var(--border); border-radius: 8px; font-size: .875rem; font-family: inherit; background: var(--bg); color: var(--text1); outline: none; }
.feature-row input:focus { border-color: var(--brand); }
.feature-remove { width: 34px; height: 34px; background: rgba(239,68,68,.1); color: #dc2626; border: 1px solid rgba(239,68,68,.2); border-radius: 7px; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all .15s; }
.feature-remove:hover { background: #dc2626; color: #fff; }
.pf-submit { padding: 11px 28px; background: var(--brand); color: #fff; border: none; border-radius: 9px; font-size: .9rem; font-weight: 700; font-family: inherit; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all .2s; }
.pf-submit:hover { background: var(--brand-dark); transform: translateY(-1px); }
</style>

<div style="margin-bottom:20px;">
    <a href="{{ route('admin.plans.index') }}" style="font-size:.83rem; color:var(--text3); text-decoration:none; display:inline-flex; align-items:center; gap:5px;">
        <i class="fas fa-arrow-left"></i> Back to Plans
    </a>
</div>

<div class="panel plan-form-wrap">
    <div class="panel-title" style="margin-bottom:22px;"><i class="fas fa-plus-circle"></i> New Subscription Plan</div>

    @if($errors->any())
    <div style="background:rgba(220,53,69,.08);border:1.5px solid rgba(220,53,69,.25);border-radius:9px;padding:12px 16px;margin-bottom:18px;font-size:.83rem;color:#b02a37;">
        <i class="fas fa-exclamation-circle" style="margin-right:6px;"></i>{{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.plans.store') }}">
        @csrf
        <div class="pf-grid">
            <div class="pf-field">
                <label class="pf-label">Plan Name <span>*</span></label>
                <input type="text" name="name" class="pf-input" value="{{ old('name') }}" placeholder="e.g. Gold" required>
                @error('name')<div class="pf-error"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror
            </div>
            <div class="pf-field">
                <label class="pf-label">Price (BDT) <span>*</span></label>
                <input type="number" name="price" class="pf-input" value="{{ old('price', 0) }}" min="0" placeholder="0 = Free" required>
                @error('price')<div class="pf-error"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror
            </div>
            <div class="pf-field">
                <label class="pf-label">Duration (days) <span>*</span></label>
                <input type="number" name="duration_days" class="pf-input" value="{{ old('duration_days', 30) }}" min="1" required>
            </div>
            <div class="pf-field">
                <label class="pf-label">Sort Order</label>
                <input type="number" name="sort_order" class="pf-input" value="{{ old('sort_order', 0) }}" min="0">
                <div class="pf-hint">Lower number appears first</div>
            </div>
        </div>
        <div class="pf-field">
            <label class="pf-label">Description</label>
            <textarea name="description" class="pf-textarea" placeholder="Brief description of this plan...">{{ old('description') }}</textarea>
        </div>
        <div class="pf-field">
            <label class="pf-label" style="display:flex;align-items:center;gap:8px; cursor:pointer;">
                <input type="checkbox" name="is_popular" value="1" {{ old('is_popular') ? 'checked' : '' }} style="width:16px;height:16px;accent-color:var(--brand);">
                Mark as Most Popular
            </label>
        </div>
        <div class="pf-field">
            <label class="pf-label">Features</label>
            <div id="featuresContainer">
                <div class="feature-row">
                    <input type="text" name="features[]" placeholder="e.g. Unlimited profile views">
                    <button type="button" class="feature-remove" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <button type="button" id="addFeature" style="margin-top:8px; padding:6px 14px; background:var(--bg); border:1.5px dashed var(--border); border-radius:7px; font-size:.8rem; font-weight:600; color:var(--text3); cursor:pointer; display:inline-flex; align-items:center; gap:5px; transition:all .15s; font-family:inherit;">
                <i class="fas fa-plus"></i> Add Feature
            </button>
        </div>
        <div style="padding-top:16px; border-top:1px solid var(--border-2); display:flex; gap:12px; align-items:center;">
            <button type="submit" class="pf-submit"><i class="fas fa-save"></i> Create Plan</button>
            <a href="{{ route('admin.plans.index') }}" style="font-size:.875rem; color:var(--text3); text-decoration:none; font-weight:500;">Cancel</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('addFeature').addEventListener('click', function() {
    const row = document.createElement('div');
    row.className = 'feature-row';
    row.innerHTML = '<input type="text" name="features[]" placeholder="Feature description"><button type="button" class="feature-remove" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>';
    document.getElementById('featuresContainer').appendChild(row);
    row.querySelector('input').focus();
});
</script>
@endpush
@endsection
