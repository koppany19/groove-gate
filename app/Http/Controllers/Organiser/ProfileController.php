<?php

namespace App\Http\Controllers\Organiser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organiser\UpdateOrganiserProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $profile = $user->organiserProfile;

        return view('organiser.profile', compact('profile', 'user'));
    }

    public function edit()
    {
        $user = auth()->user();
        $profile = $user->organiserProfile;

        return view('organiser.profile-edit', compact('profile', 'user'));
    }

    public function update(UpdateOrganiserProfileRequest $request)
    {
        $user = auth()->user();
        $profile = $user->organiserProfile;
        $validated = $request->validated();

        unset($validated['avatar'], $validated['cover_image']);

        if($request->hasFile('avatar')) {
            if ($user->avatar && !str_starts_with($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->update(['avatar' => $request->file('avatar')->store('avatars', 'public')]);
        }

        if($request->hasFile('cover_image')) {
            if($profile->cover_image && !str_starts_with($profile->cover_image, 'http')) {
                Storage::disk('public')->delete($profile->cover_image);
            }

            $validated['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        }

        $profile->update($validated);

        return redirect()->route('organiser.profile')->with('success', 'Profile updated successfully.');
    }
}
