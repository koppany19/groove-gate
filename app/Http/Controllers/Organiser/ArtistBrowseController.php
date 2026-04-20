<?php

namespace App\Http\Controllers\Organiser;

use App\ArtistTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\ArtistProfile;
use Illuminate\Http\Request;

class ArtistBrowseController extends Controller
{
    public function index(Request $request)
    {
        $artists = ArtistProfile::with('user')
            ->whereHas('user', fn ($query) => $query->whereNotNull('email_verified_at'))
            ->when($request->genre, fn ($query, $genre) => $query->whereJsonContains('genre', $genre))
            ->when($request->location, fn ($query, $location) => $query->where('location', 'like', "%$location%"))
            ->when($request->artist_type, fn ($query, $artistType) => $query->where('artist_type', $artistType))
            ->when($request->available, fn ($query) => $query->where('is_available', true))
            ->paginate(12);

        $genres = ArtistTypeEnum::cases();

        return view('organiser.artists.index', compact('artists', 'genres'));
    }

    public function show(ArtistProfile $artist)
    {
        $artist->load('user', 'tracks', 'availability');

        return view('organiser.artists.show', compact('artist'));
    }
}
