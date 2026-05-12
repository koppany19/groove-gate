@props(['artist'])

<a href="{{ route('organiser.artists.show', $artist) }}"
   class="block bg-(--color-card) border border-white/5 rounded-3xl overflow-hidden
          hover:border-blue-500/30 hover:-translate-y-1 hover:shadow-xl
          hover:shadow-blue-500/10 transition-all duration-300 group">

    <div class="relative h-40 overflow-hidden">
        @if($artist->cover_image)
            <img src="{{ str_starts_with($artist->cover_image, 'http')
                            ? $artist->cover_image
                            : Storage::url($artist->cover_image) }}"
                 alt="{{ $artist->stage_name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-gradient-to-br from-blue-950 via-gray-900 to-gray-900"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>

        @if($artist->is_available)
            <div class="absolute top-3 right-3 flex items-center gap-1.5
                        bg-black/60 backdrop-blur-sm px-2.5 py-1 rounded-full
                        border border-emerald-500/30">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-xs text-emerald-400 font-medium">Available</span>
            </div>
        @endif
    </div>

    <div class="p-5">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-12 h-12 rounded-full overflow-hidden border-2 border-white/10
                        bg-[#151E2D] flex items-center justify-center flex-shrink-0">
                @if($artist->user->avatar)
                    <img src="{{ str_starts_with($artist->user->avatar, 'http')
                                    ? $artist->user->avatar
                                    : Storage::url($artist->user->avatar) }}"
                         alt="{{ $artist->stage_name }}"
                         class="w-full h-full object-cover">
                @else
                    <span class="text-lg font-black text-blue-400">
                        {{ strtoupper(substr($artist->stage_name ?? $artist->user->name, 0, 1)) }}
                    </span>
                @endif
            </div>

            <div class="min-w-0">
                <p class="text-white font-bold truncate">
                    {{ $artist->stage_name ?? $artist->user->name }}
                </p>
                @if($artist->location)
                    <p class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                        <x-icon name="location" size="10" />
                        {{ $artist->location }}
                    </p>
                @endif
            </div>
        </div>

        @if($artist->genre)
            <div class="flex flex-wrap gap-1.5 mb-3">
                @foreach(array_slice($artist->genre, 0, 3) as $genre)
                    <span class="text-xs px-2.5 py-1 rounded-full bg-blue-500/10
                                 text-blue-400 border border-blue-500/20 font-medium">
                        {{ $genre }}
                    </span>
                @endforeach
                @if(count($artist->genre) > 3)
                    <span class="text-xs px-2.5 py-1 rounded-full bg-white/5
                                 text-gray-500 border border-white/10">
                        +{{ count($artist->genre) - 3 }}
                    </span>
                @endif
            </div>
        @endif
    </div>
</a>
