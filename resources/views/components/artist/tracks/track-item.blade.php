@props(['track'])

<div class="flex items-center gap-4 p-4 rounded-2xl border border-white/5
            bg-white/5 hover:bg-white/8 transition-all group">

    <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20
                flex items-center justify-center flex-shrink-0">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
             stroke="#3b82f6" stroke-width="2">
            <path d="M9 18V5l12-2v13"/>
            <circle cx="6" cy="18" r="3"/>
            <circle cx="18" cy="16" r="3"/>
        </svg>
    </div>

    <div class="flex-1 min-w-0">
        <p class="text-white text-sm font-semibold truncate">{{ $track->title }}</p>
        <a href="{{ $track->url }}" target="_blank"
           class="text-xs text-gray-500 hover:text-blue-400 transition-colors truncate block">
            {{ $track->url }}
        </a>
    </div>

    @php
        $platform = match(true) {
            str_contains($track->url, 'spotify')     => ['label' => 'Spotify',    'class' => 'text-green-400 bg-green-500/10 border-green-500/20'],
            str_contains($track->url, 'soundcloud')  => ['label' => 'SoundCloud', 'class' => 'text-orange-400 bg-orange-500/10 border-orange-500/20'],
            str_contains($track->url, 'youtube')     => ['label' => 'YouTube',    'class' => 'text-red-400 bg-red-500/10 border-red-500/20'],
            default                                  => ['label' => 'Link',       'class' => 'text-gray-400 bg-white/5 border-white/10'],
        };
    @endphp

    <span class="text-xs px-2.5 py-1 rounded-full border font-medium flex-shrink-0
                 {{ $platform['class'] }}">
        {{ $platform['label'] }}
    </span>

    <form action="{{ route('artist.tracks.destroy', $track) }}" method="POST"
          onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="w-8 h-8 rounded-xl flex items-center justify-center
                       text-gray-600 hover:text-red-400 hover:bg-red-500/10
                       transition-all opacity-0 group-hover:opacity-100">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"/>
                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                <path d="M10 11v6M14 11v6"/>
                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
            </svg>
        </button>
    </form>

</div>
