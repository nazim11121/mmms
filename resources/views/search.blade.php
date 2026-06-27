@extends('layouts.app')
@section('title', 'Browse Profiles — MMMS')
@push('styles')
<style>
.search-page { padding: 40px 0 64px; background: var(--bg); min-height: 80vh; }
.search-layout { display: grid; grid-template-columns: 280px 1fr; gap: 28px; align-items: start; }

/* Filter sidebar */
.filter-sidebar {
    background: var(--surface); border: 1px solid var(--border);
    border-radius: 16px; overflow: hidden; position: sticky; top: 80px;
}
.filter-header {
    padding: 18px 20px; background: var(--brand);
    display: flex; align-items: center; justify-content: space-between;
}
.filter-header-title { font-size: .9rem; font-weight: 700; color: #fff; display: flex; align-items: center; gap: 8px; }
.filter-reset { font-size: .78rem; color: rgba(255,255,255,.75); text-decoration: none; cursor: pointer; background: none; border: none; font-family: inherit; padding: 0; }
.filter-reset:hover { color: #fff; }
.filter-body { padding: 20px; display: flex; flex-direction: column; gap: 0; }
.filter-group { padding: 14px 0; border-bottom: 1px solid var(--border-2); }
.filter-group:last-child { border-bottom: none; }
.filter-group-label { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--text4); margin-bottom: 10px; }
.filter-row { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
.filter-select, .filter-input {
    width: 100%; padding: 8px 10px; border: 1.5px solid var(--border);
    border-radius: 8px; background: var(--bg); color: var(--text1);
    font-size: .83rem; font-family: inherit; outline: none;
    transition: border-color .2s; -webkit-appearance: none; box-sizing: border-box;
}
.filter-select:focus, .filter-input:focus { border-color: var(--brand); }
.filter-btn {
    width: 100%; padding: 10px; background: var(--brand); color: #fff;
    border: none; border-radius: 8px; font-size: .875rem; font-weight: 700;
    font-family: inherit; cursor: pointer; margin-top: 16px;
    display: flex; align-items: center; justify-content: center; gap: 7px;
    transition: background .2s, transform .15s;
}
.filter-btn:hover { background: var(--brand-dark); transform: translateY(-1px); }

/* Results header */
.results-header {
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;
    gap: 12px; margin-bottom: 20px;
}
.results-count { font-size: .9rem; color: var(--text3); }
.results-count strong { color: var(--text1); font-weight: 700; }
.results-sort { display: flex; align-items: center; gap: 8px; font-size: .85rem; color: var(--text3); }
.results-sort select { border: 1.5px solid var(--border); border-radius: 8px; padding: 6px 10px; font-size: .83rem; font-family: inherit; background: var(--surface); color: var(--text1); outline: none; cursor: pointer; }

/* Profile cards grid */
.profiles-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 16px; }

.pcard {
    background: var(--surface); border-radius: 14px; overflow: hidden;
    border: 1px solid var(--border); transition: transform .25s, box-shadow .25s, border-color .25s;
    display: flex; flex-direction: column; text-decoration: none;
}
.pcard:hover { transform: translateY(-5px); box-shadow: var(--sh-xl); border-color: rgba(181,52,26,.2); }
.pcard-photo { position: relative; aspect-ratio: 3/4; background: #1A1714; overflow: hidden; }
.pcard-photo img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s; }
.pcard:hover .pcard-photo img { transform: scale(1.05); }
.pcard-photo-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(10,5,2,.7) 0%, transparent 55%); }
.pcard-photo-age {
    position: absolute; bottom: 8px; left: 8px;
    background: rgba(0,0,0,.55); color: #fff; border-radius: 6px;
    padding: 2px 8px; font-size: .72rem; font-weight: 600; backdrop-filter: blur(4px);
}
.pcard-photo-verified {
    position: absolute; top: 8px; right: 8px;
    background: rgba(45,122,79,.9); color: #fff; border-radius: 5px;
    padding: 2px 7px; font-size: .68rem; font-weight: 700;
    display: flex; align-items: center; gap: 3px;
}
.pcard-body { padding: 12px 14px 14px; flex: 1; display: flex; flex-direction: column; }
.pcard-name { font-family: 'Playfair Display', serif; font-size: .95rem; font-weight: 600; color: var(--text1); margin-bottom: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.pcard-meta { font-size: .75rem; color: var(--text3); display: flex; flex-wrap: wrap; gap: 4px; align-items: center; margin-bottom: 10px; }
.pcard-meta span { display: flex; align-items: center; gap: 3px; }
.pcard-actions { display: flex; gap: 6px; margin-top: auto; }
.pcard-btn {
    flex: 1; padding: 7px 4px; border-radius: 7px; font-size: .75rem; font-weight: 600;
    text-align: center; cursor: pointer; border: none; font-family: inherit;
    text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 4px;
    transition: all .2s;
}
.pcard-btn.primary { background: var(--brand); color: #fff; }
.pcard-btn.primary:hover { background: var(--brand-dark); }
.pcard-btn.icon { width: 32px; flex: 0 0 32px; background: var(--bg); color: var(--text3); border: 1px solid var(--border); border-radius: 7px; display: flex; align-items: center; justify-content: center; }
.pcard-btn.icon:hover { color: var(--brand); border-color: var(--brand); background: rgba(181,52,26,.06); }

/* Pagination */
.pagination-wrap { display: flex; justify-content: center; margin-top: 36px; }
.pagination-wrap .pagination { display: flex; gap: 4px; list-style: none; }
.pagination-wrap .page-item .page-link {
    padding: 8px 14px; border: 1.5px solid var(--border); border-radius: 8px;
    color: var(--text2); text-decoration: none; font-size: .875rem; font-weight: 500;
    background: var(--surface); transition: all .2s; display: flex; align-items: center;
}
.pagination-wrap .page-item.active .page-link { background: var(--brand); border-color: var(--brand); color: #fff; }
.pagination-wrap .page-item .page-link:hover:not(.active) { border-color: var(--brand); color: var(--brand); }
.pagination-wrap .page-item.disabled .page-link { opacity: .45; cursor: not-allowed; }

/* Empty state */
.empty-state { text-align: center; padding: 64px 20px; }
.empty-state-icon { font-size: 3.5rem; color: var(--text4); margin-bottom: 20px; }
.empty-state-title { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--text2); margin-bottom: 8px; }
.empty-state-desc { color: var(--text3); font-size: .9rem; }

@media (max-width: 900px) {
    .search-layout { grid-template-columns: 1fr; }
    .filter-sidebar { position: static; }
}
@media (max-width: 480px) {
    .profiles-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>
@endpush
@section('content')
<div class="search-page">
    <div class="container">
        <!-- Page heading -->
        <div style="margin-bottom: 24px;">
            <h1 style="font-family:'Playfair Display',serif; font-size:1.6rem; font-weight:700; color:var(--text1); margin-bottom:4px;">Browse Profiles</h1>
            <p style="color:var(--text3); font-size:.9rem;">Find your life partner from thousands of verified members</p>
        </div>

        <div class="search-layout">
            <!-- Filters -->
            <aside class="filter-sidebar">
                <div class="filter-header">
                    <span class="filter-header-title"><i class="fas fa-sliders-h"></i> Filters</span>
                    <a href="{{ route('search') }}" class="filter-reset">Reset all</a>
                </div>
                <form method="GET" action="{{ route('search') }}" class="filter-body">
                    <div class="filter-group">
                        <div class="filter-group-label">Looking For</div>
                        <select name="gender" class="filter-select">
                            <option value="">Any gender</option>
                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <div class="filter-group-label">Age Range</div>
                        <div class="filter-row">
                            <input type="number" name="age_from" class="filter-input" placeholder="Min" value="{{ request('age_from') }}" min="18" max="70">
                            <input type="number" name="age_to" class="filter-input" placeholder="Max" value="{{ request('age_to') }}" min="18" max="80">
                        </div>
                    </div>
                    <div class="filter-group">
                        <div class="filter-group-label">Location</div>
                        <select name="district" class="filter-select">
                            <option value="">Any district</option>
                            @foreach(['Dhaka','Chattogram','Khulna','Rajshahi','Sylhet','Barishal','Mymensingh','Rangpur'] as $d)
                                <option value="{{ $d }}" {{ request('district') == $d ? 'selected' : '' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <div class="filter-group-label">Religion</div>
                        <select name="religion" class="filter-select">
                            <option value="">Any religion</option>
                            @foreach(['Islam','Hinduism','Christianity','Buddhism','Other'] as $r)
                                <option value="{{ strtolower($r) }}" {{ request('religion') == strtolower($r) ? 'selected' : '' }}>{{ $r }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <div class="filter-group-label">Education</div>
                        <select name="education" class="filter-select">
                            <option value="">Any level</option>
                            @foreach(['SSC','HSC','Bachelor','Masters','PhD','Other'] as $e)
                                <option value="{{ $e }}" {{ request('education') == $e ? 'selected' : '' }}>{{ $e }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-group">
                        <div class="filter-group-label">Marital Status</div>
                        <select name="marital_status" class="filter-select">
                            <option value="">Any status</option>
                            @foreach(['never_married' => 'Never Married', 'divorced' => 'Divorced', 'widowed' => 'Widowed'] as $k => $v)
                                <option value="{{ $k }}" {{ request('marital_status') == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="filter-btn">
                        <i class="fas fa-search"></i> Search Profiles
                    </button>
                </form>
            </aside>

            <!-- Results -->
            <div>
                <div class="results-header">
                    <div class="results-count">
                        Found <strong>{{ $members->total() }}</strong> profiles
                        @if(request()->hasAny(['gender','age_from','age_to','district','religion','education','marital_status']))
                            matching your filters
                        @endif
                    </div>
                    <div class="results-sort">
                        Sort:
                        <select onchange="window.location.href='{{ route('search') }}?'+new URLSearchParams({...Object.fromEntries(new URLSearchParams(window.location.search)),'sort':this.value})">
                            <option value="newest" {{ request('sort','newest') == 'newest' ? 'selected' : '' }}>Newest first</option>
                            <option value="active" {{ request('sort') == 'active' ? 'selected' : '' }}>Recently active</option>
                        </select>
                    </div>
                </div>

                @if($members->count() > 0)
                <div class="profiles-grid">
                    @foreach($members as $member)
                    <div class="pcard">
                        <div class="pcard-photo">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy">
                            <div class="pcard-photo-overlay"></div>
                            @if($member->profile?->date_of_birth)
                                <div class="pcard-photo-age">{{ $member->profile->age }} yrs</div>
                            @endif
                            @if($member->profile?->is_verified)
                                <div class="pcard-photo-verified"><i class="fas fa-check"></i> Verified</div>
                            @endif
                        </div>
                        <div class="pcard-body">
                            <div class="pcard-name">{{ $member->name }}</div>
                            <div class="pcard-meta">
                                @if($member->profile?->district)
                                    <span><i class="fas fa-map-marker-alt"></i> {{ $member->profile->district }}</span>
                                @endif
                                @if($member->profile?->education)
                                    <span><i class="fas fa-graduation-cap"></i> {{ $member->profile->education }}</span>
                                @endif
                            </div>
                            <div class="pcard-actions">
                                <a href="{{ route('profile.show', $member) }}" class="pcard-btn primary">View</a>
                                @auth
                                <form method="POST" action="{{ route('member.shortlist.toggle', $member) }}" style="margin:0">
                                    @csrf
                                    <button type="submit" class="pcard-btn icon" title="Shortlist"><i class="fas fa-bookmark"></i></button>
                                </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pagination-wrap">
                    {{ $members->withQueryString()->links() }}
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fas fa-search"></i></div>
                    <div class="empty-state-title">No profiles found</div>
                    <p class="empty-state-desc">Try adjusting your filters to see more results.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
