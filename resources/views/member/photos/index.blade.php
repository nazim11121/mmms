@extends('layouts.member')
@section('title', 'My Photos')
@section('page-title', 'My Photos')
@section('content')
<style>
.photo-upload-zone {
    border: 2px dashed var(--border); border-radius: 14px; padding: 32px;
    text-align: center; background: var(--bg); transition: all .2s; cursor: pointer;
    margin-bottom: 24px;
}
.photo-upload-zone:hover, .photo-upload-zone.drag-over { border-color: var(--brand); background: rgba(181,52,26,.04); }
.photo-upload-zone i { font-size: 2.2rem; color: var(--text4); margin-bottom: 12px; display: block; }
.photo-upload-zone p { color: var(--text3); font-size: .9rem; margin: 0 0 4px; }
.photo-upload-zone small { color: var(--text4); font-size: .78rem; }
.upload-file-input { position: absolute; inset: 0; opacity: 0; cursor: pointer; }

.photos-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); gap: 14px; }
.photo-item { position: relative; border-radius: 12px; overflow: hidden; aspect-ratio: 3/4; background: #1A1714; }
.photo-item img { width: 100%; height: 100%; object-fit: cover; display: block; }
.photo-item-overlay {
    position: absolute; inset: 0; background: rgba(0,0,0,.55);
    opacity: 0; transition: opacity .2s; display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 8px;
}
.photo-item:hover .photo-item-overlay { opacity: 1; }
.photo-action {
    padding: 6px 14px; border-radius: 7px; font-size: .76rem; font-weight: 600;
    cursor: pointer; border: none; font-family: inherit; display: inline-flex; align-items: center; gap: 5px;
    transition: transform .15s;
}
.photo-action:hover { transform: scale(1.03); }
.photo-action.primary { background: #fff; color: var(--brand); }
.photo-action.danger { background: rgba(239,68,68,.9); color: #fff; }
.photo-action.outline { background: rgba(255,255,255,.15); color: #fff; border: 1px solid rgba(255,255,255,.4); }

.photo-badge {
    position: absolute; top: 8px; left: 8px;
    background: var(--brand); color: #fff; padding: 3px 9px;
    border-radius: 6px; font-size: .68rem; font-weight: 700;
    display: flex; align-items: center; gap: 4px;
}
.visibility-pill {
    position: absolute; bottom: 8px; right: 8px;
    background: rgba(0,0,0,.6); color: rgba(255,255,255,.85);
    padding: 2px 8px; border-radius: 5px; font-size: .66rem; font-weight: 600;
    backdrop-filter: blur(4px);
}
</style>

<!-- Upload -->
<div class="panel" style="margin-bottom:24px;">
    <div class="panel-title" style="margin-bottom:18px;"><i class="fas fa-cloud-upload-alt"></i> Upload Photos</div>
    <form method="POST" action="{{ route('member.photos.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="photo-upload-zone" onclick="document.getElementById('photoFile').click()">
            <i class="fas fa-images"></i>
            <p>Click to browse or drag & drop photos</p>
            <small>JPG, PNG, WEBP up to 5MB · Max {{ 6 - $photos->count() }} more photos</small>
        </div>
        <input type="file" id="photoFile" name="photo" accept="image/*" style="display:none" required>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:16px;">
            <div>
                <label style="font-size:.8rem; font-weight:600; color:var(--text2); display:block; margin-bottom:5px;">Visibility</label>
                <select name="visibility" style="width:100%; padding:9px 12px; border:1.5px solid var(--border); border-radius:8px; font-size:.875rem; font-family:inherit; background:var(--surface); color:var(--text1); outline:none;">
                    <option value="members">Members only</option>
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>
            <div style="display:flex; align-items:flex-end;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:.875rem; color:var(--text2); padding-bottom:9px;">
                    <input type="checkbox" name="is_primary" value="1" style="width:16px;height:16px;accent-color:var(--brand);">
                    Set as primary photo
                </label>
            </div>
        </div>

        @error('photo')<div style="font-size:.78rem;color:#dc3545;margin-bottom:10px;display:flex;align-items:center;gap:5px;"><i class="fas fa-times-circle"></i>{{ $message }}</div>@enderror

        <button type="submit" style="padding:10px 24px; background:var(--brand); color:#fff; border:none; border-radius:9px; font-size:.875rem; font-weight:700; font-family:inherit; cursor:pointer; display:inline-flex; align-items:center; gap:7px; transition:all .2s;">
            <i class="fas fa-upload"></i> Upload Photo
        </button>
    </form>
</div>

<!-- Photos grid -->
<div class="panel">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px;">
        <div class="panel-title" style="margin-bottom:0;"><i class="fas fa-th"></i> My Photos ({{ $photos->count() }}/6)</div>
    </div>
    @if($photos->count() > 0)
    <div class="photos-grid">
        @foreach($photos as $photo)
        <div class="photo-item">
            <img src="{{ Storage::url($photo->photo_path) }}" alt="Photo {{ $loop->iteration }}" loading="lazy">
            @if($photo->is_primary)
                <div class="photo-badge"><i class="fas fa-star"></i> Primary</div>
            @endif
            <div class="visibility-pill">{{ ucfirst($photo->visibility) }}</div>
            <div class="photo-item-overlay">
                @if(!$photo->is_primary)
                <form method="POST" action="{{ route('member.photos.primary', $photo) }}" style="margin:0;">
                    @csrf @method('PATCH')
                    <button type="submit" class="photo-action primary"><i class="fas fa-star"></i> Set Primary</button>
                </form>
                @endif
                <form method="POST" action="{{ route('member.photos.destroy', $photo) }}" style="margin:0;" onsubmit="return confirm('Delete this photo?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="photo-action danger"><i class="fas fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div style="text-align:center; padding:48px 20px; color:var(--text4);">
        <i class="fas fa-images" style="font-size:3rem; margin-bottom:14px; display:block;"></i>
        <div style="font-family:'Playfair Display',serif; font-size:1.1rem; color:var(--text3); margin-bottom:6px;">No photos yet</div>
        <div style="font-size:.85rem;">Upload your first photo to attract more profile views</div>
    </div>
    @endif
</div>
@endsection
