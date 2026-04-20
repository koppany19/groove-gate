<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8">

        <x-artist.profile.hero :user="$artist->user" :profile="$artist" :readonly="true" />

        <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1
                    xl:grid-cols-3 gap-8 mt-8 pb-20">

            <div class="xl:col-span-2 space-y-8">

                <div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20
                                    flex items-center justify-center shrink-0">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                 stroke="#3b82f6" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">About the Artist</h2>
                            <p class="text-xs text-gray-500">Biography</p>
                        </div>
                    </div>
                    @if($artist->bio)
                        <p class="text-gray-300 leading-relaxed">{{ $artist->bio }}</p>
                    @else
                        <p class="text-gray-600 text-sm">No biography added yet.</p>
                    @endif
                </div>

                @if($artist->tracks->count() > 0)
                    <div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-9 h-9 rounded-xl bg-orange-500/10 border border-orange-500/20
                                        flex items-center justify-center shrink-0">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     stroke="#f97316" stroke-width="2">
                                    <path d="M9 18V5l12-2v13"/>
                                    <circle cx="6" cy="18" r="3"/>
                                    <circle cx="18" cy="16" r="3"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-white">Tracks</h2>
                                <p class="text-xs text-gray-500">{{ $artist->tracks->count() }} tracks</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            @foreach($artist->tracks as $index => $track)
                                <x-artist.profile.track
                                    :index="$index + 1"
                                    :title="$track->title"
                                    :url="$track->url"
                                    meta="Track"
                                    color="from-blue-900"
                                />
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <div class="space-y-6">

                <div class="bg-(--color-card) border border-blue-500/30 rounded-3xl p-6 shadow-xl">
                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-3">Interested?</p>
                    <h3 class="text-white font-bold text-lg mb-1">
                        Book {{ $artist->stage_name ?? $artist->user->name }}
                    </h3>
                    <p class="text-gray-500 text-xs mb-5">
                        Send a booking request to this artist for your event.
                    </p>

                    @if($artist->price_min && $artist->price_max)
                        <div class="flex items-center justify-between mb-5 pb-5 border-b border-white/5">
                            <span class="text-sm text-gray-400">Price range</span>
                            <span class="text-blue-400 font-bold">
                                €{{ number_format($artist->price_min) }} – €{{ number_format($artist->price_max) }}
                            </span>
                        </div>
                    @endif

                    @if($artist->duration)
                        <div class="flex items-center justify-between mb-5 pb-5 border-b border-white/5">
                            <span class="text-sm text-gray-400">Set duration</span>
                            <span class="text-white font-semibold">{{ $artist->duration }} min</span>
                        </div>
                    @endif

                    <button disabled
                            class="w-full py-3.5 rounded-2xl text-white font-bold text-sm
                                   bg-blue-500/50 cursor-not-allowed
                                   flex items-center justify-center gap-2">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.46-1.46a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        Send Booking Request
                    </button>
                    <p class="text-xs text-gray-600 text-center mt-2">Coming soon</p>
                </div>

                <x-artist.profile.availability-readonly :availability="$artist->availability" />

            </div>

        </div>
    </div>
</x-layout>
