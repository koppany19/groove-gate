@props([
    'index' => 1,
    'title' => '',
    'url'   => '',
    'meta'  => '',
    'color' => 'from-blue-900',
])

@php
    $embedUrl = null;

    if (str_contains($url, 'soundcloud.com')) {
        $embedUrl = 'https://w.soundcloud.com/player/?url='
                    . urlencode($url)
                    . '&color=%233b82f6&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false';

    } elseif (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
        preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
        if (isset($matches[1])) {
            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
        }

    } elseif (str_contains($url, 'spotify.com')) {
        $embedUrl = str_replace('open.spotify.com', 'open.spotify.com/embed', $url);
    }
@endphp

<div x-data="{ open: false }">

    <div @click="open = !open"
         class="group flex items-center justify-between p-4 rounded-2xl
                hover:bg-white/5 transition-colors duration-200 cursor-pointer
                border border-transparent hover:border-white/10"
         :class="open ? 'bg-white/5 border-white/10 rounded-b-none' : ''">

        <div class="flex items-center gap-5">

            <div class="relative w-14 h-14 rounded-xl overflow-hidden
                        bg-gradient-to-br {{ $color }} to-black
                        border border-white/10 flex items-center justify-center">

                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition-colors"></div>
                <template x-if="!open">
                    <svg class="w-6 h-6 text-white relative z-10"
                         fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </template>
                <template x-if="open">
                    <svg class="w-6 h-6 text-white relative z-10"
                         fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                    </svg>
                </template>

            </div>

            <div>
                <h3 class="text-base font-bold text-white group-hover:text-blue-400 transition-colors">
                    {{ $title }}
                </h3>
                <p class="text-sm text-gray-400 mt-0.5">{{ $meta }}</p>
            </div>

        </div>

        <div class="flex items-center gap-3">
            @php
                $platform = match(true) {
                    str_contains($url, 'spotify')    => ['label' => 'Spotify',    'class' => 'text-green-400 bg-green-500/10 border-green-500/20'],
                    str_contains($url, 'soundcloud') => ['label' => 'SoundCloud', 'class' => 'text-orange-400 bg-orange-500/10 border-orange-500/20'],
                    str_contains($url, 'youtube')    => ['label' => 'YouTube',    'class' => 'text-red-400 bg-red-500/10 border-red-500/20'],
                    default                          => ['label' => 'Link',       'class' => 'text-gray-400 bg-white/5 border-white/10'],
                };
            @endphp

            <span class="text-xs px-2.5 py-1 rounded-full border font-medium {{ $platform['class'] }}">
                {{ $platform['label'] }}
            </span>

            <x-icon name="chevron-down" size="16" class="text-gray-500 transition-transform duration-200" />
        </div>

    </div>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="border border-white/10 border-t-0 rounded-b-2xl overflow-hidden">

        @if($embedUrl)
            @if(str_contains($url, 'youtube'))
                <iframe src="{{ $embedUrl }}"
                        width="100%" height="250"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                </iframe>

            @elseif(str_contains($url, 'soundcloud'))
                <iframe src="{{ $embedUrl }}"
                        width="100%" height="120"
                        frameborder="0"
                        allow="autoplay">
                </iframe>

            @elseif(str_contains($url, 'spotify'))
                <iframe src="{{ $embedUrl }}"
                        width="100%" height="80"
                        frameborder="0"
                        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                        loading="lazy">
                </iframe>
            @endif
        @else
            <div class="p-4 flex items-center justify-between bg-white/5">
                <p class="text-sm text-gray-400">No preview available</p>
                <a href="{{ $url }}" target="_blank"
                   class="text-xs text-blue-400 hover:underline">
                    Open link →
                </a>
            </div>
        @endif
    </div>
</div>
