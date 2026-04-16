<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1400px] mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-black text-white tracking-tight">Browse Artists</h1>
                <p class="text-sm text-gray-400 mt-1">{{ $artists->total() }} artists available</p>
            </div>

            <x-organiser.artists.artist-filter :genres="$genres" />

            @if($artists->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($artists as $artist)
                        <x-organiser.artists.artist-card :artist="$artist" />
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $artists->links() }}
                </div>

            @else
                <div class="flex flex-col items-center justify-center py-24">
                    <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-6">
                        <svg width="36" height="36" fill="none" stroke="currentColor"
                             stroke-width="1.5" viewBox="0 0 24 24" class="text-gray-600">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white mb-2">No artists found</h2>
                    <p class="text-gray-500 text-sm mb-6">Try adjusting your filters.</p>
                    <a href="{{ route('organiser.artists.index') }}"
                       class="px-6 py-2.5 rounded-xl text-sm font-bold text-white
                              bg-blue-500 hover:opacity-90 transition-all">
                        Clear filters
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-layout>
