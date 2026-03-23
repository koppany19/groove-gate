<?php

namespace App\Http\Controllers;

use App\Models\ArtistProfile;
use App\Models\OrganiserProfile;
use App\Models\User;
use App\UserRole;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate(
                ['google_id' => $googleUser->id],
                [
                    'name'              => $googleUser->name,
                    'email'             => $googleUser->email,
                    'avatar'            => $googleUser->avatar,
                    'password'          => null,
                    'email_verified_at' => now(),
                ]
            );

            auth()->login($user);

            if(!$user->role) {
                return redirect()->route('auth.select-role');
            }

            return redirect()->route($user->role->value . '.dashboard')->with('success', 'Welcome back, ' . $user->name . '!');

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Google authentication failed. Please try again.']);
        }
    }

    public function showSelectRole()
    {
        return view('auth.select-role');
    }

    public function storeRole(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:audience,artist,organiser'
        ]);

        $user = auth()->user();
        $user->update(['role' => $validated['role']]);

        if ($validated['role'] === 'artist') {
            ArtistProfile::create(['user_id' => $user->id]);
        }

        if ($validated['role'] === 'organiser') {
            OrganiserProfile::create(['user_id' => $user->id]);
        }

        return redirect()->route($validated['role'] . '.dashboard')->with('success', 'Welcome to GrooveGate!');
    }
}
