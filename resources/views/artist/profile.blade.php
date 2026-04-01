<x-layout>
    @php
        $user = auth()->user();
        $profile = $user->artistProfile;
    @endphp

    <div class="min-h-screen bg-(--artist-background) text-white -m-8">
        <x-artist.profile.hero :user="$user" :profile="$profile" />

        <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 xl:grid-cols-3 gap-8 mt-8 pb-20">

            <div class="xl:col-span-2 space-y-8">
                <div class="grid grid-cols-3 gap-4">
                    <x-artist.profile.stat-card
                        label="Total Bookings"
                        value="0"
                        color="blue"
                    />
                    <x-artist.profile.stat-card
                        label="Shows Played"
                        value="0"
                        color="purple"
                    />
                    <x-artist.profile.stat-card
                        label="Rating"
                        value="—"
                        color="yellow">
                        <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </x-artist.profile.stat-card>
                </div>

                <div class="bg-[#121A27] border border-white/5 rounded-3xl p-8 shadow-2xl">
                    <h2 class="text-2xl font-bold text-white mb-6">Popular Tracks</h2>

                    @forelse($profile->tracks()->get() as $index => $track)
                        <x-artist.profile.track
                            :index="$index + 1"
                            :title="$track->title"
                            :url="$track->url"
                            meta="Track"
                            color="{{ $index % 2 === 0 ? 'from-blue-900' : 'from-purple-900' }}"
                        />
                    @empty
                        <p class="text-gray-500 text-sm py-4">No tracks uploaded yet.</p>
                    @endforelse
                </div>

                <div class="bg-[#121A27] border border-white/5 rounded-3xl p-8 shadow-2xl">
                    <h2 class="text-2xl font-bold text-white mb-6">About the Artist</h2>
                    @if($profile->bio)
                        <p class="text-gray-300 leading-relaxed">{{ $profile->bio }}</p>
                    @else
                        <p class="text-gray-500 text-sm">No biography added yet.</p>
                    @endif
                </div>
            </div>

            <div class="space-y-8">
                <x-artist.profile.booking-card :profile="$profile" />
                <x-artist.profile.availability :profile="$profile" />
            </div>
        </div>
    </div>
</x-layout>
