<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\ProfilePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = auth()->user()->photos()->orderBy('sort_order')->get();
        return view('member.photos.index', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'photos' => 'required|array|max:10',
        ]);

        $user = auth()->user();
        $uploaded = 0;

        foreach ($request->file('photos') as $file) {
            $path = $file->store("photos/{$user->id}", 'public');
            $isPrimary = $user->photos()->count() === 0 && $uploaded === 0;
            ProfilePhoto::create([
                'user_id' => $user->id,
                'photo_path' => $path,
                'is_primary' => $isPrimary,
                'sort_order' => $user->photos()->count(),
            ]);
            $uploaded++;
        }

        return back()->with('success', "{$uploaded} photo(s) uploaded successfully!");
    }

    public function setPrimary(ProfilePhoto $photo)
    {
        if ($photo->user_id !== auth()->id()) abort(403);

        auth()->user()->photos()->update(['is_primary' => false]);
        $photo->update(['is_primary' => true]);

        return back()->with('success', 'Primary photo updated!');
    }

    public function destroy(ProfilePhoto $photo)
    {
        if ($photo->user_id !== auth()->id()) abort(403);

        Storage::disk('public')->delete($photo->photo_path);
        $photo->delete();

        return back()->with('success', 'Photo deleted.');
    }
}
