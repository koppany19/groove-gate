@props(['event'])

<div class="space-y-4">

    <div class="bg-[#1A1D24] border border-white/5 border-t-2 border-t-blue-500/60
                rounded-3xl overflow-hidden shadow-xl hover:border-white/10 transition-all">
        <div class="px-6 pt-6 pb-4 border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                        <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm">Ticket Info</p>
                    <p class="text-gray-500 text-xs">Pricing and availability</p>
                </div>
            </div>
        </div>

        @if($event->base_price)
            <div class="px-6 py-5 border-b border-white/5 bg-gradient-to-r from-blue-500/5 to-transparent">
                <p class="text-xs text-gray-500 mb-1">Base Price</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-black text-blue-400">€{{ number_format($event->base_price, 2) }}</span>
                    <span class="text-gray-500 text-sm mb-1">per ticket</span>
                </div>
                @if($event->is_dynamic_price)
                    <div class="flex items-center gap-1.5 mt-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-orange-400 animate-pulse"></div>
                        <span class="text-xs text-orange-400 font-medium">Dynamic pricing enabled</span>
                    </div>
                @endif
            </div>
        @else
            <div class="px-6 py-5 border-b border-white/5">
                <span class="text-2xl font-black text-blue-400">Free Entry</span>
            </div>
        @endif

        @if($event->sale_end_at)
            <div class="px-6 py-4 flex items-center justify-between">
                <span class="text-sm text-gray-400">Sale ends</span>
                <span class="text-sm font-bold text-white">
                    {{ $event->sale_end_at->format('M d, Y') }}
                </span>
            </div>
        @endif
    </div>

    <div class="bg-[#1A1D24] border border-white/5 border-t-2 border-t-emerald-500/60
                rounded-3xl overflow-hidden shadow-xl hover:border-white/10 transition-all">
        <div class="px-6 pt-6 pb-4 border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" class="text-gray-400">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm">Capacity</p>
                    <p class="text-gray-500 text-xs">Seats and entry type</p>
                </div>
            </div>
        </div>

        <div class="px-6 py-5 space-y-4">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-400">Total Seats</span>
                <span class="text-white-400 text-2xl font-black">
                    {{ $event->capacity ? number_format($event->capacity) : 'Unlimited' }}
                </span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-400">Entry Type</span>
                <span class="flex items-center gap-2 text-sm font-bold
                             {{ $event->has_seats ? 'text-emerald-500' : 'text-emerald-400' }}">
                    @if($event->has_seats)
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                        Assigned Seats
                    @else
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                        </svg>
                        Free Standing
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div class="bg-[#1A1D24] border border-white/5 border-t-2 border-t-purple-500/60
                rounded-3xl overflow-hidden shadow-xl hover:border-white/10 transition-all">
        <div class="px-6 pt-6 pb-4 border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" class="text-gray-400">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-bold text-sm">Location</p>
                    <p class="text-gray-500 text-xs">Event venue</p>
                </div>
            </div>
        </div>

        <div class="px-6 py-5">
            <p class="text-white font-semibold mb-4">{{ $event->location }}</p>
            <a href="https://www.google.com/maps/search/{{ urlencode($event->location) }}"
               target="_blank"
               class="flex items-center justify-center gap-2 w-full py-3 rounded-xl
                      text-sm font-semibold text-purple-300
                      bg-purple-500/10 border border-purple-500/20
                      hover:bg-blue-500/20 transition-all">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                View on Google Maps
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                    <polyline points="15 3 21 3 21 9"/>
                    <line x1="10" y1="14" x2="21" y2="3"/>
                </svg>
            </a>
        </div>
    </div>
</div>
