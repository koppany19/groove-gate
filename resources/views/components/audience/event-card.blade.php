@props(['event'])

@php
    use Illuminate\Support\Facades\Storage;
    $coverSrc = $event->cover_image
        ? (str_starts_with($event->cover_image, 'http') ? $event->cover_image : Storage::url($event->cover_image))
        : null;

    $pillClass = 'flex items-center gap-1.5 text-xs text-gray-300
                  bg-white/10 backdrop-blur-sm px-3 py-1.5
                  rounded-full border border-white/10';
@endphp

<div class="relative rounded-3xl overflow-hidden border border-white/5 group
            hover:border-blue-500/30 hover:shadow-xl hover:shadow-blue-500/10
            hover:-translate-y-1 transition-all duration-300">

    <div class="relative h-64 overflow-hidden">

        @if($coverSrc)
            <img src="{{ $coverSrc }}" alt="{{ $event->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-gradient-to-br from-blue-950 via-gray-900 to-gray-900"></div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>

        <div class="absolute top-4 left-4 bg-black/60 backdrop-blur-md rounded-2xl px-3 py-2
                    border border-white/10 text-center">
            <p class="text-xs font-bold text-blue-400 uppercase tracking-wider leading-none">
                {{ $event->start_date->format('M') }}
            </p>
            <p class="text-2xl font-black text-white leading-tight">
                {{ $event->start_date->format('d') }}
            </p>
        </div>

        @if($event->isSoldOut())
            <div class="absolute top-4 right-4">
                <span class="px-3 py-1 rounded-full text-xs font-bold
                             bg-red-500/10 text-red-400 border border-red-500/20">
                    Sold Out
                </span>
            </div>
        @endif

        <div class="absolute bottom-0 left-0 right-0 p-5">
            <h3 class="text-white font-black text-2xl leading-tight mb-3 drop-shadow-lg">
                {{ $event->name }}
            </h3>

            <div class="flex flex-wrap gap-2">
                <span class="{{ $pillClass }}">
                    <x-icon name="location" size="11" />
                    {{ $event->location }}
                </span>

                <span class="{{ $pillClass }}">
                    <x-icon name="clock" size="11" />
                    {{ $event->start_date->format('M d • H:i') }}
                </span>

                @if($event->capacity)
                    <span class="{{ $pillClass }}">
                        <x-icon name="users" size="11" />
                        {{ number_format($event->capacity) }}
                    </span>
                @endif
            </div>
        </div>

    </div>

    <div class="bg-(--color-card) p-4 flex items-center justify-between gap-3">

        <div>
            @if($event->base_price)
                <div class="flex items-center gap-2">
                    <span class="text-blue-400 font-black text-xl">
                        from €{{ number_format($event->calculatePrice(), 2) }}
                    </span>
                </div>
                <p class="text-xs text-gray-600">per ticket</p>
            @else
                <span class="text-emerald-400 font-bold text-sm">Free entry</span>
            @endif
        </div>

        <a href="{{ route('audience.events.show', $event) }}"
           class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold
                  text-white bg-blue-500 hover:opacity-90 transition-all">
            View
            <x-icon name="arrow-right" size="13" />
        </a>
    </div>
</div>
