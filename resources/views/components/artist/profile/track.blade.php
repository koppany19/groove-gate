@props([
    'index' => 1,
    'title' => '',
    'url'   => '',
    'meta'  => '',
    'color' => 'from-blue-900',
])

<div class="group flex items-center justify-between p-4 rounded-2xl
            hover:bg-white/5 transition-colors duration-200 cursor-pointer
            border border-transparent hover:border-white/10">

    <div class="flex items-center gap-5">

        <div class="relative w-14 h-14 rounded-xl overflow-hidden
                    bg-gradient-to-br {{ $color }} to-black
                    border border-white/10 flex items-center justify-center">
            <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100
                        transition-opacity absolute z-10"
                 fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 5v14l11-7z"/>
            </svg>
            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/60 transition-colors"></div>
            <span class="text-blue-400 font-black text-xl">{{ $index }}</span>
        </div>

        <div>
            <h3 class="text-base font-bold text-white group-hover:text-blue-400 transition-colors">
                {{ $title }}
            </h3>
            <p class="text-sm text-gray-400 mt-0.5">{{ $meta }}</p>
        </div>
    </div>


    <a href="{{ $url }}" target="_blank"
       class="p-2 text-gray-500 hover:text-blue-400 hover:bg-blue-500/10 rounded-full transition-colors">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
            <path d="M8 5v14l11-7z"/>
        </svg>
    </a>

</div>
