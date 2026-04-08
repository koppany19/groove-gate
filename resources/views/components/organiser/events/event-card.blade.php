@props(['event'])

<div class="relative rounded-3xl overflow-hidden border border-white/5 hover:border-blue-500/30 transition-all duration-300 group hover:shadow-xl hover:shadow-blue-500/10 hover:-translate-y-1">

    <div class="relative h-64 overflow-hidden">
        @if($event->cover_image)
            <img src="{{ str_starts_with($event->cover_image, 'http') ? $event->cover_image : Storage::url($event->cover_image) }}"
                 alt="{{ $event->name }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-gradient-to-br from-blue-950 via-gray-900 to-gray-900"></div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>

        <div class="absolute top-4 left-4 bg-black/60 backdrop-blur-md rounded-2xl px-3 py-2 border border-white/10 text-center">
            <p class="text-xs font-bold text-blue-400 uppercase tracking-wider leading-none">
                {{ $event->start_date->format('M') }}
            </p>
            <p class="text-2xl font-black text-white leading-tight">
                {{ $event->start_date->format('d') }}
            </p>
        </div>

        <div class="absolute top-4 right-4">
            <x-organiser.events.event-status-badge :status="$event->status" />
        </div>

        <div class="absolute bottom-0 left-0 right-0 p-5">
            <h3 class="text-white font-black text-2xl leading-tight mb-3 drop-shadow-lg">
                {{ $event->name }}
            </h3>
            <div class="flex flex-wrap gap-2">
                <span class="flex items-center gap-1.5 text-xs text-gray-300 bg-white/10 backdrop-blur-sm px-3 py-1.5 rounded-full border border-white/10">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                    {{ $event->location }}
                </span>
                <span class="flex items-center gap-1.5 text-xs text-gray-300 bg-white/10 backdrop-blur-sm px-3 py-1.5 rounded-full border border-white/10">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    {{ $event->start_date->format('M d • H:i') }}
                </span>
                @if($event->capacity)
                    <span class="flex items-center gap-1.5 text-xs text-gray-300 bg-white/10 backdrop-blur-sm px-3 py-1.5 rounded-full border border-white/10">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                        </svg>
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
                    <span class="text-blue-400 font-black text-xl">€{{ number_format($event->base_price, 2) }}</span>
                    @if($event->is_dynamic_price)
                        <span class="text-xs px-2 py-0.5 rounded-full bg-orange-500/10 text-orange-400 border border-orange-500/20 font-semibold">dynamic</span>
                    @endif
                </div>
                <p class="text-xs text-gray-600">per ticket</p>
            @else
                <span class="text-emerald-400 font-bold text-sm">Free entry</span>
            @endif
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('organiser.events.edit', $event) }}"
               class="p-2 rounded-xl text-gray-500 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </a>
            <a href="{{ route('organiser.events.show', $event) }}"
               class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold text-white bg-blue-500 hover:opacity-90 transition-all">
                View
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </a>
        </div>
    </div>
</div>
