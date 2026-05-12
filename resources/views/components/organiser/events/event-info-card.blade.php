@props(['event'])

<div class="space-y-4">

    <div class="bg-[#1A1D24] border border-white/5 border-t-2 border-t-blue-500/60 rounded-3xl overflow-hidden shadow-xl hover:border-white/10 transition-all">
        <div class="px-6 pt-6 pb-4 border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center">
                    <x-icon name="ticket" size="16" stroke="#3b82f6" />
                </div>
                <div>
                    <p class="text-white font-bold text-sm">Ticket Info</p>
                    <p class="text-gray-500 text-xs">Pricing and availability</p>
                </div>
            </div>
        </div>

        @if($event->base_price)
            <div class="px-6 py-5 border-b border-white/5 bg-gradient-to-r from-blue-500/5 to-transparent">
                @if($event->is_dynamic_price)
                    <p class="text-xs text-gray-500 mb-1">Current Price</p>
                    <div class="flex items-end gap-2">
                        <span class="text-3xl font-black text-blue-400">
                            €{{ number_format($event->calculatePrice(), 2) }}
                        </span>
                        <span class="text-gray-500 text-sm mb-1">per ticket</span>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center gap-1.5">
                            <div class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></div>
                            <span class="text-xs text-white-400 font-medium">Dynamic pricing enabled</span>
                        </div>
                        <span class="text-xs text-gray-600">
                            Base €{{ number_format($event->base_price, 2) }}
                        </span>
                    </div>
                @else
                    <p class="text-xs text-gray-500 mb-1">Base Price</p>
                    <div class="flex items-end gap-2">
                        <span class="text-3xl font-black text-blue-400">
                            €{{ number_format($event->base_price, 2) }}
                        </span>
                        <span class="text-gray-500 text-sm mb-1">per ticket</span>
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
                <span class="text-sm font-bold {{ $event->isOnSale() ? 'text-white' : 'text-red-400' }}">
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
                    <x-icon name="users" size="16" class="text-gray-400" />
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
                <span class="text-2xl font-black text-white">
                    {{ $event->capacity ? number_format($event->capacity) : 'Unlimited' }}
                </span>
            </div>


            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-400">Entry Type</span>
                <span class="flex items-center gap-2 text-sm font-bold
                             {{ $event->has_seats ? 'text-emerald-500' : 'text-emerald-400' }}">
                    @if($event->has_seats)
                        <x-icon name="ticket" size="13" />
                        Assigned Seats
                    @else
                        <x-icon name="user" size="13" />
                        Free Standing
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div class="bg-[#1A1D24] border border-white/5 border-t-2 border-t-purple-500/60 rounded-3xl overflow-hidden shadow-xl hover:border-white/10 transition-all">
        <div class="px-6 pt-6 pb-4 border-b border-white/5">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                    <x-icon name="location" size="16" class="text-gray-400" />
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
               class="flex items-center justify-center gap-2 w-full py-3 rounded-xl text-sm font-semibold text-purple-300
                      bg-purple-500/10 border border-purple-500/20 hover:bg-purple-500/20 transition-all">
                <x-icon name="location" size="15" />
                View on Google Maps
                <x-icon name="arrow-right" size="12" />
            </a>
        </div>
    </div>
</div>
