<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Artist\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $profile = $user->artistProfile;

        return view('artist.profile', compact('user', 'profile'));
    }

    public function edit()
    {
        $user = auth()->user();
        $profile = $user->artistProfile;

        return view('artist.profile-edit', compact('profile', 'user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $profile = auth()->user()->artistProfile;
        $user = auth()->user();
        $data = $request->validated();

        unset($data['cover_image'], $data['avatar']);

        if ($request->hasFile('cover_image')) {
            if ($profile->cover_image && !str_starts_with($profile->cover_image, 'http')) {
                Storage::disk('public')->delete($profile->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')
                ->store('covers', 'public');
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && !str_starts_with($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->update([
                'avatar' => $request->file('avatar')->store('avatars', 'public')
            ]);
        }

        $profile->update($data);

        return redirect()->route('artist.profile.show')->with('success', 'Profile updated successfully!');
    }
}
