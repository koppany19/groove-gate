<x-layout>
    <div class="min-h-screen bg-[#060913] text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1400px] mx-auto">

            <div class="flex items-center gap-4 mb-10">
                <a href="{{ route('artist.profile.show') }}"
                   class="p-2 rounded-xl bg-white/5 hover:bg-white/10
                          border border-white/10 transition-all">
                    <svg width="18" height="18" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-white tracking-tight">
                        Edit Profile
                    </h1>
                    <p class="text-sm text-gray-400 mt-1">
                        Update your artist profile information
                    </p>
                </div>
            </div>

            <form action="{{ route('artist.profile.update') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                    <div class="xl:col-span-2 space-y-6">
                        <x-artist.profile-edit.basic-info :profile="$profile" />
                        <x-artist.profile-edit.artist-type :profile="$profile" />
                        <x-artist.profile-edit.about :profile="$profile" />
                        <x-artist.profile-edit.genres :profile="$profile" />
                    </div>

                    <div class="space-y-6">
                        <x-artist.profile-edit.save-card :profile="$profile" />
                        <x-artist.profile-edit.cover-upload :user="$user" :profile="$profile" />
                        <x-artist.profile-edit.pricing :profile="$profile" />
                        <x-artist.profile-edit.social-links :profile="$profile" />
                    </div>
                </div>
            </form>

            @php
                $tracks = $profile->tracks()->latest()->get();
            @endphp


            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mt-8">
                <div class="xl:col-span-2 space-y-6">
                    <x-artist.tracks.track-list :tracks="$tracks" :profile="$profile" />
                </div>
                <div>
                    <x-artist.tracks.track-form :profile="$profile" />
                </div>
            </div>

        </div>
    </div>
</x-layout>
