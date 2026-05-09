<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\ArtistProfile;
use App\Models\OrganiserProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        if($user->role->value === 'artist') {
            ArtistProfile::create([
                'user_id'     => $user->id,
                'stage_name'  => $request->stage_name,
                'bio'         => $request->bio,
                'genre'       => $request->genre ?? [],
                'genre_other' => $request->genre_other,
                'artist_type' => $request->artist_type,
                'price_min'   => $request->price_min,
                'price_max'   => $request->price_max,
                'duration'    => $request->duration,
                'location'    => $request->location,
            ]);
        }

        if($user->role->value === 'organiser') {
            OrganiserProfile::create([
                'user_id'      => $user->id,
                'company_name' => $request->company_name,
                'description'  => $request->description,
                'phone'        => $request->phone,
                'location'     => $request->location,
            ]);
        }

        Auth::login($user);

        return redirect()->route($user->role->value . '.dashboard')->with('success', 'You have been registered successfully.');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $role = auth()->user()->role->value;
            return redirect()->route($role . '.dashboard')->with('success', 'You are now logged in');
        }

        return back()
            ->withErrors(['email' => 'These credentials do not match our records.',])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
