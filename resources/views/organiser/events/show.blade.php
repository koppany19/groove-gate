<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10"
         x-data="{ tab: 'overview' }">
        <div class="max-w-[1100px] mx-auto">

            <div class="flex items-center justify-between gap-4 mb-6">
                <a href="{{ route('organiser.events.index') }}"
                   class="p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>

                <div class="flex items-center gap-2">
                    <a href="{{ route('organiser.events.edit', $event) }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold
                              text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit
                    </a>

                    @if($event->status === \App\EventStatus::DRAFT)
                        <form action="{{ route('organiser.events.publish', $event) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold
                                           text-white bg-emerald-500/80 hover:bg-emerald-500
                                           border border-emerald-500/50 transition-all">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                Publish
                            </button>
                        </form>
                    @endif

                    @if($event->status === \App\EventStatus::PUBLISHED)
                        <form action="{{ route('organiser.events.cancel', $event) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    onclick="return confirm('Are you sure?')"
                                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold
                                           text-white bg-red-500/10 hover:bg-red-500/20
                                           border border-red-500/20 transition-all">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="15" y1="9" x2="9" y2="15"/>
                                    <line x1="9" y1="9" x2="15" y2="15"/>
                                </svg>
                                Cancel Event
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="relative">
                <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-[600px] h-40
                            bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative w-full h-150 rounded-3xl overflow-hidden mb-8">
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
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-2xl font-black text-white tracking-tight">{{ $event->name }}</h1>
                            <x-organiser.events.event-status-badge :status="$event->status" />
                        </div>
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
                            @if($event->base_price)
                                <span class="text-white/20">·</span>
                                <span>€{{ number_format($event->base_price, 2) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-0 border-b border-white/10 mb-8">
                @foreach(['overview' => 'Overview', 'lineup' => 'Lineup', 'tickets' => 'Tickets', 'statistics' => 'Statistics'] as $key => $label)
                    <button
                        @click="tab = '{{ $key }}'"
                        class="px-5 py-3.5 text-sm font-medium transition-all border-b-2 -mb-px"
                        :class="tab === '{{ $key }}'
                            ? 'text-white border-blue-500'
                            : 'text-gray-500 border-transparent hover:text-gray-300'">
                        {{ $label }}
                        @if($key === 'lineup')
                            <span class="ml-1.5 text-xs px-1.5 py-0.5 rounded-full bg-white/10 text-gray-400">
                                {{ $event->bookings->count() }}
                            </span>
                        @endif
                    </button>
                @endforeach
            </div>

            <div x-show="tab === 'overview'" class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <div class="xl:col-span-2 space-y-5">

                    <div class="bg-(--color-surface-3) border border-white/5 border-t-2 border-t-gray-500/60
                                rounded-3xl p-8 shadow-xl hover:border-white/10 transition-all">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10
                                        flex items-center justify-center shrink-0">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" class="text-gray-400">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-white">About this Event</h3>
                        </div>
                        @if($event->description)
                            <p class="text-gray-300 leading-relaxed text-sm"
                               :class="expanded ? '' : 'line-clamp-3'">
                                {{ $event->description }}
                            </p>
                            <button @click="expanded = !expanded"
                                    class="text-xs text-gray-500 hover:text-white mt-3 transition-colors">
                                <span x-text="expanded ? 'Show less ↑' : 'Show more...'"></span>
                            </button>
                        @else
                            <p class="text-gray-600 text-sm">No description added yet.</p>
                        @endif
                    </div>

                    <div class="bg-(--color-surface-3) border border-white/5 border-t-2 border-t-gray-500/60
                                rounded-3xl p-8 shadow-xl hover:border-white/10 transition-all">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10
                                        flex items-center justify-center shrink-0">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" class="text-gray-400">
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

                    <div class="bg-(--color-surface-3) border border-white/5 border-t-2 border-t-gray-500/60
                                rounded-3xl p-8 shadow-xl hover:border-white/10 transition-all">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10
                                        flex items-center justify-center shrink-0">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" class="text-gray-400">
                                    <path d="M9 18V5l12-2v13"/>
                                    <circle cx="6" cy="18" r="3"/>
                                    <circle cx="18" cy="16" r="3"/>
                                </svg>
                            </div>
                            <h3 class="text-base font-bold text-white">Confirmed Lineup</h3>
                        </div>
                        @if($event->confirmedBookings->isEmpty())
                            <div class="flex flex-col items-center justify-center py-8 rounded-2xl
                                        border border-dashed border-white/10 bg-white/[0.02]">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10
                                            flex items-center justify-center mb-3">
                                    <svg width="20" height="20" fill="none" stroke="currentColor"
                                         stroke-width="1.5" viewBox="0 0 24 24" class="text-gray-600">
                                        <path d="M9 18V5l12-2v13"/>
                                        <circle cx="6" cy="18" r="3"/>
                                        <circle cx="18" cy="16" r="3"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-sm mb-1">No artists confirmed yet</p>
                                <p class="text-gray-600 text-xs mb-4">Accepted bookings will appear here</p>
                                <a href="{{ route('organiser.artists.index') }}"
                                   class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium
                                          text-white bg-gradient-to-r from-blue-600 to-blue-500
                                          hover:from-blue-500 hover:to-blue-400
                                          shadow-lg shadow-blue-500/20 transition-all">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"/>
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                    Browse Artists
                                </a>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($event->confirmedBookings as $booking)
                                    <div class="flex items-center gap-4 p-4 rounded-2xl
                                                bg-white/5 border border-white/5 hover:border-white/10 transition-all">
                                        <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0
                                                    bg-white/10 flex items-center justify-center">
                                            @if($booking->artistProfile->user->avatar)
                                                <img src="{{ str_starts_with($booking->artistProfile->user->avatar, 'http') ? $booking->artistProfile->user->avatar : Storage::url($booking->artistProfile->user->avatar) }}"
                                                     alt="{{ $booking->artistProfile->stage_name ?? $booking->artistProfile->user->name }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <span class="text-sm font-black text-blue-400">
                                                    {{ strtoupper(substr($booking->artistProfile->stage_name ?? $booking->artistProfile->user->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2">
                                                <div class="w-2 h-2 rounded-full bg-emerald-400 flex-shrink-0"></div>
                                                <p class="text-white font-semibold text-sm truncate">
                                                    {{ $booking->artistProfile->stage_name ?? $booking->artistProfile->user->name }}
                                                </p>
                                            </div>
                                            @if($booking->performance_date)
                                                <p class="text-gray-500 text-xs mt-0.5 pl-4">
                                                    {{ $booking->performance_date->format('M d, Y') }}
                                                    @if($booking->duration) · {{ $booking->duration }} min @endif
                                                </p>
                                            @endif
                                        </div>
                                        @if($booking->fee)
                                            <span class="text-sm font-bold text-blue-400">
                                                €{{ number_format($booking->fee, 2) }}
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>

                <div class="space-y-5">
                    <x-organiser.events.event-info-card :event="$event" />
                </div>
            </div>

            <div x-show="tab === 'lineup'">
                <div class="bg-[#121A27] border border-white/5 rounded-3xl p-8 shadow-xl">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-base font-bold text-white">All Booking Requests</h3>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $event->bookings->count() }} total requests</p>
                        </div>
                        <a href="{{ route('organiser.artists.index') }}"
                           class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium
                                  text-white bg-gradient-to-r from-blue-600 to-blue-500
                                  hover:from-blue-500 hover:to-blue-400
                                  shadow-lg shadow-blue-500/20 transition-all">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            Browse Artists
                        </a>
                    </div>

                    @if($event->bookings->isEmpty())
                        <div class="flex flex-col items-center justify-center py-12 rounded-2xl
                                    border border-dashed border-white/10 bg-white/[0.02]">
                            <p class="text-gray-500 text-sm">No booking requests yet</p>
                            <p class="text-gray-600 text-xs mt-1">Browse artists and send booking requests</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($event->bookings as $booking)
                                <div class="flex items-center gap-4 p-4 rounded-2xl
                                            bg-white/5 border border-white/5 hover:border-white/10 transition-all">
                                    <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0
                                                bg-white/10 flex items-center justify-center">
                                        @if($booking->artistProfile->user->avatar)
                                            <img src="{{ str_starts_with($booking->artistProfile->user->avatar, 'http') ? $booking->artistProfile->user->avatar : Storage::url($booking->artistProfile->user->avatar) }}"
                                                 alt="{{ $booking->artistProfile->stage_name ?? $booking->artistProfile->user->name }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <span class="text-sm font-black text-blue-400">
                                                {{ strtoupper(substr($booking->artistProfile->stage_name ?? $booking->artistProfile->user->name, 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white font-semibold text-sm truncate">
                                            {{ $booking->artistProfile->stage_name ?? $booking->artistProfile->user->name }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            @if($booking->performance_date)
                                                <span class="text-xs text-gray-500">
                                                    {{ $booking->performance_date->format('M d, Y') }}
                                                </span>
                                            @endif
                                            @if($booking->duration)
                                                <span class="text-gray-700">·</span>
                                                <span class="text-xs text-gray-500">{{ $booking->duration }} min</span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($booking->fee)
                                        <span class="text-sm font-bold text-white">
                                            €{{ number_format($booking->fee, 2) }}
                                        </span>
                                    @endif
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold border flex-shrink-0 {{ $booking->status->color() }}">
                                        {{ $booking->status->label() }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div x-show="tab === 'tickets'">
                <div class="bg-(--color-surface-3) border border-white/5 rounded-3xl p-8 shadow-xl">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-base font-bold text-white">Ticket Types</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Manage pricing and availability</p>
                        </div>
                    </div>

                    @if($event->ticketTypes->isEmpty())
                        <div class="flex flex-col items-center justify-center py-10 rounded-2xl border border-dashed border-white/10 bg-white/[0.02] mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center mb-3">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" class="text-gray-600">
                                    <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v2z"/>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-sm mb-1">No ticket types yet</p>
                            <p class="text-gray-600 text-xs">Add your first ticket type below</p>
                        </div>
                    @else
                        <div class="space-y-3 mb-6">
                            @foreach($event->ticketTypes as $type)
                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-white/10 transition-all">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white font-semibold text-sm">{{ $type->name }}</p>
                                        <div class="flex items-center gap-3 mt-1">
                                            @if($type->sale_start_at || $type->sale_end_at)
                                                <span class="text-xs text-gray-500">
                                                    @if($type->sale_start_at)
                                                        {{ $type->sale_start_at->format('M d') }}
                                                    @endif
                                                    @if($type->sale_end_at)
                                                        → {{ $type->sale_end_at->format('M d, Y') }}
                                                    @endif
                                                </span>
                                            @endif
                                            <span class="text-xs {{ $type->isAvailable() ? 'text-emerald-400' : 'text-red-400' }}">
                                                {{ $type->isAvailable() ? 'On sale' : 'Not available' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-white font-bold text-sm">€{{ number_format($type->price, 2) }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $type->soldTickets() }} / {{ $type->quantity }} sold</p>
                                    </div>

                                    <div class="w-px h-8 bg-white/10"></div>

                                    <div class="flex items-center gap-2">
                                        @if($type->soldTickets() === 0)
                                            <form action="{{ route('organiser.events.ticket-types.destroy', [$event, $type]) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Delete this ticket type?')"
                                                        class="p-2 rounded-lg text-gray-600 hover:text-red-400 hover:bg-red-500/10 transition-all">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6"/>
                                                        <path d="M19 6l-1 14H6L5 6"/>
                                                        <path d="M10 11v6M14 11v6"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="border border-white/10 rounded-2xl p-5"
                         x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center gap-2 text-sm font-medium text-gray-400 hover:text-white transition-colors w-full">
                            <div class="w-6 h-6 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center flex-shrink-0">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                     stroke="#3b82f6" stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19"/>
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                </svg>
                            </div>
                            Add ticket type
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" class="ml-auto transition-transform"
                                 :class="open ? 'rotate-180' : ''">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>

                        <div x-show="open" x-transition class="mt-5">
                            <form action="{{ route('organiser.events.ticket-types.store', $event) }}" method="POST">
                                @csrf

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                            Name
                                        </label>
                                        <input type="text"
                                               name="name"
                                               placeholder="e.g. Early Bird"
                                               value="{{ old('name') }}"
                                               class="w-full px-4 py-3 rounded-xl text-white text-sm
                                          bg-white/5 border border-white/10 outline-none
                                          focus:border-blue-500/50 transition-all placeholder-gray-600">
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                            Price (€)
                                        </label>
                                        <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2
                                             text-gray-500 text-sm font-bold">€</span>
                                            <input type="number"
                                                   name="price"
                                                   placeholder="0.00"
                                                   min="0"
                                                   step="0.01"
                                                   value="{{ old('price') }}"
                                                   class="w-full pl-8 pr-4 py-3 rounded-xl text-white text-sm
                                              bg-white/5 border border-white/10 outline-none
                                              focus:border-blue-500/50 transition-all placeholder-gray-600">
                                        </div>
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                            Quantity
                                        </label>
                                        <input type="number"
                                               name="quantity"
                                               placeholder="100"
                                               min="1"
                                               value="{{ old('quantity') }}"
                                               class="w-full px-4 py-3 rounded-xl text-white text-sm
                                          bg-white/5 border border-white/10 outline-none
                                          focus:border-blue-500/50 transition-all placeholder-gray-600">
                                    </div>

                                    <div class="space-y-1.5">
                                        <label class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                            Sale ends
                                            <span class="text-gray-600 normal-case font-normal">(optional)</span>
                                        </label>
                                        <input type="datetime-local"
                                               name="sale_end_at"
                                               value="{{ old('sale_end_at') }}"
                                               class="w-full px-4 py-3 rounded-xl text-white text-sm
                                          bg-white/5 border border-white/10 outline-none
                                          focus:border-blue-500/50 transition-all
                                          [color-scheme:dark]">
                                    </div>
                                </div>

                                <button type="submit"
                                        class="w-full py-3 rounded-xl text-white font-bold text-sm
                                   bg-gradient-to-r from-blue-600 to-blue-500
                                   hover:from-blue-500 hover:to-blue-400
                                   shadow-lg shadow-blue-500/20 transition-all">
                                    Create Ticket Type
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="border-t border-white/5 pt-8 mt-8">

                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10
                                        flex items-center justify-center shrink-0">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" class="text-gray-400">
                                    <rect x="3" y="3" width="7" height="7"/>
                                    <rect x="14" y="3" width="7" height="7"/>
                                    <rect x="3" y="14" width="7" height="7"/>
                                    <rect x="14" y="14" width="3" height="3"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white">Validate Ticket</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Enter a barcode to admit a guest</p>
                            </div>
                        </div>

                        @if(session('validation_success'))
                            <div class="p-4 rounded-2xl flex items-start gap-3 mb-4
                                        bg-emerald-500/10 border border-emerald-500/20">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     stroke="#10b981" stroke-width="2" class="shrink-0 mt-0.5">
                                    <polyline points="20 6 9 17 4 12"/>
                                </svg>
                                <p class="text-sm font-semibold text-emerald-400">
                                    {{ session('validation_success') }}
                                </p>
                            </div>
                        @endif

                        @if(session('validation_error'))
                            <div class="p-4 rounded-2xl flex items-start gap-3 mb-4
                                        bg-red-500/10 border border-red-500/20">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     stroke="#ef4444" stroke-width="2" class="shrink-0 mt-0.5">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="15" y1="9" x2="9" y2="15"/>
                                    <line x1="9" y1="9" x2="15" y2="15"/>
                                </svg>
                                <p class="text-sm font-semibold text-red-400">
                                    {{ session('validation_error') }}
                                </p>
                            </div>
                        @endif

                        <form action="{{ route('organiser.events.validate-ticket', $event) }}" method="POST">
                            @csrf
                            <div class="flex gap-3">
                                <input type="text"
                                       name="barcode"
                                       placeholder="Enter 9-digit barcode..."
                                       maxlength="9"
                                       value="{{ old('barcode') }}"
                                       class="flex-1 px-4 py-3 rounded-xl text-white text-sm font-mono
                                              bg-white/5 border border-white/10 outline-none
                                              focus:border-blue-500/50 transition-all placeholder-gray-600">
                                <button type="submit"
                                        class="px-6 py-3 rounded-xl text-white font-bold text-sm
                                               bg-gradient-to-r from-blue-600 to-blue-500
                                               hover:from-blue-500 hover:to-blue-400
                                               shadow-lg shadow-blue-500/20 transition-all">
                                    Validate
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

            <div x-show="tab === 'statistics'">
                <div class="bg-[#121A27] border border-white/5 rounded-3xl p-8 shadow-xl">
                    <div class="flex flex-col items-center justify-center py-16 gap-3">
                        <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10
                                    flex items-center justify-center">
                            <svg width="24" height="24" fill="none" stroke="currentColor"
                                 stroke-width="1.5" viewBox="0 0 24 24" class="text-gray-600">
                                <line x1="18" y1="20" x2="18" y2="10"/>
                                <line x1="12" y1="20" x2="12" y2="4"/>
                                <line x1="6" y1="20" x2="6" y2="14"/>
                            </svg>
                        </div>
                        <p class="text-gray-400 text-sm font-medium">Statistics coming soon</p>
                        <p class="text-gray-600 text-xs">Revenue and ticket data will appear here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
