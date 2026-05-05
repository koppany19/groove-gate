@php use Illuminate\Support\Facades\Storage; @endphp

<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1100px] mx-auto">

            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('audience.events.index') }}"
                   class="p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>
            </div>

            <div class="relative mb-8">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-[600px] h-40
                            bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative w-full h-152 rounded-3xl overflow-hidden">
                    @if($event->cover_image)
                        <img src="{{ str_starts_with($event->cover_image, 'http') ? $event->cover_image : Storage::url($event->cover_image) }}"
                             alt="{{ $event->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-950 via-gray-900 to-gray-900"></div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 right-0 px-7 py-5
                                bg-black/40 backdrop-blur-md border-t border-white/10">
                        <h1 class="text-2xl font-black text-white tracking-tight mb-2">{{ $event->name }}</h1>
                        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-300">
                            <span class="flex items-center gap-1.5">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                {{ $event->location }}
                            </span>
                            <span class="text-white/20">·</span>
                            <span class="flex items-center gap-1.5">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                {{ $event->start_date->format('M d, Y') }}
                                @if($event->end_date) – {{ $event->end_date->format('M d, Y') }} @endif
                            </span>
                            @if($event->capacity)
                                <span class="text-white/20">·</span>
                                <span>{{ number_format($event->capacity) }} capacity</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 mb-8">

                <div class="xl:col-span-2 space-y-5">

                    <div class="bg-[#1A1D24] border border-white/5 border-t-2 border-t-gray-500/60
                                rounded-3xl p-8 shadow-xl hover:border-white/10 transition-all"
                         x-data="{ expanded: false }">

                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-white">About this Event</h3>
                        </div>

                        @if($event->description)
                            <p class="text-gray-300 leading-relaxed text-sm" :class="expanded ? '' : 'line-clamp-3'">
                                {{ $event->description }}
                            </p>
                            <button @click="expanded = !expanded"
                                    class="text-xs text-gray-500 hover:text-white mt-3 transition-colors">
                                <span x-text="expanded ? 'Show less ↑' : 'Show more...'"></span>
                            </button>
                        @else
                            <p class="text-gray-600 text-sm">No description provided.</p>
                        @endif
                    </div>

                    <div class="bg-[#1A1D24] border border-white/5 border-t-2 border-t-gray-500/60
                                rounded-3xl p-8 shadow-xl hover:border-white/10 transition-all">

                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400">
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-white">Event Details</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 rounded-2xl p-4 border border-white/5 relative overflow-hidden">
                                <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-blue-500/10 rounded-full blur-xl"></div>
                                <p class="text-xs text-gray-500 mb-1 relative">Start Date</p>
                                <p class="text-white text-2xl font-black relative">{{ $event->start_date->format('M d, Y') }}</p>
                                <p class="text-gray-400 text-sm mt-0.5 relative">{{ $event->start_date->format('H:i') }}</p>
                            </div>

                            @if($event->end_date)
                                <div class="bg-white/5 rounded-2xl p-4 border border-white/5 relative overflow-hidden">
                                    <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-purple-500/10 rounded-full blur-xl"></div>
                                    <p class="text-xs text-gray-500 mb-1 relative">End Date</p>
                                    <p class="text-white text-2xl font-black relative">{{ $event->end_date->format('M d, Y') }}</p>
                                    <p class="text-gray-400 text-sm mt-0.5 relative">{{ $event->end_date->format('H:i') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($event->confirmedBookings->isNotEmpty())
                        <div class="bg-[#1A1D24] border border-white/5 border-t-2 border-t-orange-500/60
                                    rounded-3xl p-8 shadow-xl hover:border-white/10 transition-all">

                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400">
                                        <path d="M9 18V5l12-2v13"/>
                                        <circle cx="6" cy="18" r="3"/>
                                        <circle cx="18" cy="16" r="3"/>
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-white">Lineup</h3>
                            </div>

                            <div class="space-y-3">
                                @foreach($event->confirmedBookings as $booking)
                                    @php
                                        $artist = $booking->artistProfile;
                                        $artistName = $artist->stage_name ?? $artist->user->name;
                                        $avatarSrc = $artist->user->avatar
                                            ? (str_starts_with($artist->user->avatar, 'http')
                                                ? $artist->user->avatar
                                                : Storage::url($artist->user->avatar))
                                            : null;
                                    @endphp
                                    <div class="flex items-center gap-4 p-4 rounded-2xl
                                                bg-white/5 border border-white/5 hover:border-white/10 transition-all">
                                        <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0
                                                    bg-white/10 flex items-center justify-center">
                                            @if($avatarSrc)
                                                <img src="{{ $avatarSrc }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-sm font-black text-blue-400">
                                                    {{ strtoupper(substr($artistName, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2">
                                                <div class="w-2 h-2 rounded-full bg-emerald-400 flex-shrink-0"></div>
                                                <p class="text-white font-semibold text-sm truncate">{{ $artistName }}</p>
                                            </div>
                                            @if($booking->performance_date)
                                                <p class="text-gray-500 text-xs mt-0.5 pl-4">
                                                    {{ $booking->performance_date->format('M d, Y') }}
                                                    @if($booking->duration) · {{ $booking->duration }} min @endif
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <div class="space-y-5">
                    <x-organiser.events.event-info-card :event="$event" />
                </div>

            </div>

            @if($event->ticketTypes->isNotEmpty())
                <div class="bg-[#1A1D24] border border-white/5 border-t-2 border-t-blue-500/60
                            rounded-3xl p-8 shadow-xl hover:border-white/10 transition-all">

                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center shrink-0">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gray-400">
                                <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-white">Tickets</h3>
                    </div>

                    <div class="space-y-3">
                        @foreach($event->ticketTypes as $type)
                            <div class="flex items-center justify-between p-4 rounded-2xl
                                        bg-white/5 border border-white/5 hover:border-white/10 transition-all">
                                <div class="flex-1 min-w-0">
                                    <p class="text-white font-semibold text-sm">{{ $type->name }}</p>
                                    @if($type->sale_end_at)
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            Sale ends {{ $type->sale_end_at->format('M d, Y') }}
                                        </p>
                                    @endif
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="text-right">
                                        <p class="text-white font-black text-lg">€{{ number_format($type->price, 2) }}</p>
                                        <p class="text-xs text-gray-500">{{ $type->remainingTickets() }} left</p>
                                    </div>

                                    @if(!$type->isAvailable())
                                        <span class="px-3 py-1.5 rounded-xl text-xs font-bold
                                                     bg-red-500/10 text-red-400 border border-red-500/20">
                                            Sold out
                                        </span>
                                    @else
                                        <form action="{{ route('audience.checkout.create', [$event, $type]) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="px-4 py-2 rounded-xl text-sm font-bold text-white
                                                           bg-gradient-to-r from-blue-600 to-blue-500
                                                           hover:from-blue-500 hover:to-blue-400
                                                           shadow-lg shadow-blue-500/20 transition-all"
                                            >
                                                Buy
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>
