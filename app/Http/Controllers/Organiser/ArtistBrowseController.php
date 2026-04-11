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
            ->whereHas('email_verified_at', fn ($query) => $query->whereNotNull('email_verified_at'))
            ->where($request->genre, fn ($query, $genre) => $query->whereJsonContains('genres', $genre))
            ->where($request->location, fn ($query, $location) => $query->where('location', 'like', "%$location%"))
            ->where($request->artist_type, fn ($query, $artistType) => $query->where('artist_type', $artistType))
            ->where($request->available, fn ($query) => $query->where('available', true))
            ->paginate(12);

        $genres = ArtistTypeEnum::cases();

        return view('organiser.artist.index', compact('artists', 'genres'));
    }

    public function show(ArtistProfile $artist)
    {
        $artist->load('user', 'tracks', 'availability');

        return view('organiser.artist.show', compact('artist'));
    }
}
