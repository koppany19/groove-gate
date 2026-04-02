<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\ArtistTrack;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->artistProfile();
        $tracks = $profile->tracks()->latest()->get();

        return view('artist.tracks', compact('tracks', 'profile', 'user'));
    }

    public function store(Request $request)
    {
        $profile = auth()->user()->artistProfile;

        if($profile->tracks()->count() > 6){
            return back()->withErrors(['trakcs' => 'You can only add up to 5 tracks']);
        }

        $validated = request()->validate([
            'title' => 'required|string|max:150',
            'url' => 'required|url|max:255',
        ]);

        $profile->tracks()->create($validated);
        return back()->with('success', 'Track added successfully!');
    }

    public function destroy(ArtistTrack $track)
    {
        if($track->artist_profile_id !== auth()->user()->artistProfile->id){
            abort(403);
        }
        $track->delete();

        return back()->with('success', 'Track deleted successfully!');
    }
}
