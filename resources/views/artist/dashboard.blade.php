<x-layout>
    @php
        $user = auth()->user();
        $profile = $user->artistProfile;
        $completeness = $profile->profileCompleteness();
    @endphp

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">
                    Welcome back, {{ $profile->stage_name ?? $user->name }} 👋
                </h1>
                <p class="text-zinc-400 text-sm mt-1">
                    Here's what's happening with your profile.
                </p>
            </div>
        </div>

        {{-- Stat kártyák --}}
        <div class="grid grid-cols-3 gap-4">

            {{-- Profil kitöltöttség --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 space-y-3">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-semibold text-zinc-500 uppercase tracking-widest">
                        Profile Completeness
                    </p>
                    <span class="text-xs font-mono
                        {{ $completeness === 100 ? 'text-green-400' : ($completeness >= 50 ? 'text-yellow-400' : 'text-red-400') }}">
                        {{ $completeness }}%
                    </span>
                </div>
                <div class="w-full bg-zinc-800 rounded-full h-1.5">
                    <div class="h-1.5 rounded-full transition-all duration-500
                        {{ $completeness === 100 ? 'bg-green-400' : ($completeness >= 50 ? 'bg-yellow-400' : 'bg-red-400') }}"
                         style="width: {{ $completeness }}%">
                    </div>
                </div>
                <p class="text-2xl font-bold text-white">{{ $completeness }}%</p>
                @if($completeness < 100)
                    <a href="{{ route('artist.profile.edit') }}"
                       class="text-xs text-zinc-400 hover:text-white transition-colors">
                        Complete your profile →
                    </a>
                @else
                    <p class="text-xs text-green-400">Profile complete! ✓</p>
                @endif
            </div>

            {{-- Bookings --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 space-y-3">
                <p class="text-xs font-semibold text-zinc-500 uppercase tracking-widest">
                    Total Bookings
                </p>
                <p class="text-2xl font-bold text-white">0</p>
                <p class="text-xs text-zinc-600">Bookings coming soon...</p>
            </div>

            {{-- Közelgő fellépések --}}
            <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 space-y-3">
                <p class="text-xs font-semibold text-zinc-500 uppercase tracking-widest">
                    Upcoming Shows
                </p>
                <p class="text-2xl font-bold text-white">0</p>
                <p class="text-xs text-zinc-600">No upcoming shows yet.</p>
            </div>

        </div> {{-- ← Ez hiányzott! --}}

        {{-- Naptár + Quick info --}}
        <div class="grid grid-cols-5 gap-4">

            {{-- Availability naptár (3/5) --}}
            <div class="col-span-3 bg-zinc-900 border border-zinc-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-white font-semibold">My Availability</h2>
                    <span class="text-xs text-zinc-500">Click to mark unavailable</span>
                </div>
                <livewire:artist-availability-calendar />
            </div>

            {{-- Quick info (2/5) --}}
            <div class="col-span-2 space-y-4">

                {{-- Tracks --}}
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-white font-semibold text-sm">My Tracks</h3>
                        <span class="text-xs text-zinc-500">
                            {{ $profile->tracks()->count() }}/5
                        </span>
                    </div>
                    @if($profile->tracks()->count() > 0)
                        <div class="space-y-2">
                            @foreach($profile->tracks()->latest()->take(3)->get() as $track)
                                <div class="flex items-center gap-2 text-sm text-zinc-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-zinc-600"></span>
                                    {{ $track->title }}
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-zinc-600">No tracks uploaded yet.</p>
                    @endif
                    <a href="{{ route('artist.tracks.index') }}"
                       class="mt-3 block text-xs text-zinc-400 hover:text-white transition-colors">
                        Manage tracks →
                    </a>
                </div>

                {{-- Profil info --}}
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 space-y-3">
                    <h3 class="text-white font-semibold text-sm">Profile Info</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs">
                            <span class="text-zinc-500">Genre</span>
                            <span class="text-zinc-300">
                                {{ $profile->genre ? implode(', ', array_slice($profile->genre, 0, 2)) : '—' }}
                            </span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-zinc-500">Type</span>
                            <span class="text-zinc-300">
                                {{ $profile->artist_type?->value ?? '—' }}
                            </span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-zinc-500">Price range</span>
                            <span class="text-zinc-300">
                                @if($profile->price_min && $profile->price_max)
                                    €{{ $profile->price_min }} – €{{ $profile->price_max }}
                                @else
                                    —
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-zinc-500">Location</span>
                            <span class="text-zinc-300">{{ $profile->location ?? '—' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('artist.profile.edit') }}"
                       class="block text-xs text-zinc-400 hover:text-white transition-colors">
                        Edit profile →
                    </a>
                </div>

            </div>
        </div>

    </div>
</x-layout>
