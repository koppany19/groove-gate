@props(['tracks', 'profile'])

<div class="bg-(--color-edit-background) border border-white/5 rounded-3xl p-6 shadow-xl">

    <div class="flex items-center justify-between mb-5">
        <h2 class="text-lg font-bold text-white flex items-center gap-2">
            <div class="w-1 h-5 bg-blue-500 rounded-full"></div>
            My Tracks
        </h2>
        <span class="text-xs text-gray-500">
            {{ $tracks->count() }}/5 tracks
        </span>
    </div>

    @if($tracks->count() > 0)
        <div class="space-y-3">
            @foreach($tracks as $track)
                <x-artist.tracks.track-item :track="$track" />
            @endforeach
        </div>
    @else
        <div class="text-center py-10">
            <div class="w-14 h-14 rounded-full bg-white/5 flex items-center
                        justify-center mx-auto mb-3">
                <svg width="22" height="22" fill="none" stroke="currentColor"
                     stroke-width="1.5" viewBox="0 0 24 24" class="text-gray-600">
                    <path d="M9 18V5l12-2v13"/>
                    <circle cx="6" cy="18" r="3"/>
                    <circle cx="18" cy="16" r="3"/>
                </svg>
            </div>
            <p class="text-gray-500 text-sm">No tracks uploaded yet.</p>
            <p class="text-gray-600 text-xs mt-1">
                Add up to 5 tracks to your profile.
            </p>
        </div>
    @endif

</div>
