<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10"
         x-data="{ tab: 'overview' }">
        <div class="max-w-[1100px] mx-auto">

            <div class="flex items-center justify-between gap-4 mb-6">
                <a href="{{ route('organiser.events.index') }}"
                   class="p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                    <x-icon name="arrow-left" size="18" />
                </a>

                <div class="flex items-center gap-2">
                    <a href="{{ route('organiser.events.edit', $event) }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold
                              text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                        <x-icon name="edit" size="13" />
                        Edit
                    </a>

                    @if($event->status === \App\EventStatus::DRAFT)
                        <form action="{{ route('organiser.events.publish', $event) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold
                                           text-white bg-emerald-500/80 hover:bg-emerald-500
                                           border border-emerald-500/50 transition-all">
                                <x-icon name="check" size="13" />
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
                                <x-icon name="cancel" size="13" />
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
                                <x-icon name="location" size="12" />
                                {{ $event->location }}
                            </span>
                            <span class="text-white/20">·</span>
                            <span class="flex items-center gap-1.5">
                                <x-icon name="calendar" size="12" />
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
                                <x-icon name="file" size="14" class="text-gray-400" />
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
                                <x-icon name="calendar" size="14" class="text-gray-400" />
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
                                <x-icon name="music" size="14" class="text-gray-400" />
                            </div>
                            <h3 class="text-base font-bold text-white">Confirmed Lineup</h3>
                        </div>
                        @if($event->confirmedBookings->isEmpty())
                            <div class="flex flex-col items-center justify-center py-8 rounded-2xl
                                        border border-dashed border-white/10 bg-white/[0.02]">
                                <div class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10
                                            flex items-center justify-center mb-3">
                                    <x-icon name="music" size="20" stroke-width="1.5" class="text-gray-600" />
                                </div>
                                <p class="text-gray-500 text-sm mb-1">No artists confirmed yet</p>
                                <p class="text-gray-600 text-xs mb-4">Accepted bookings will appear here</p>
                                <a href="{{ route('organiser.artists.index') }}"
                                   class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium
                                          text-white bg-gradient-to-r from-blue-600 to-blue-500
                                          hover:from-blue-500 hover:to-blue-400
                                          shadow-lg shadow-blue-500/20 transition-all">
                                    <x-icon name="plus" size="13" />
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
                            <x-icon name="plus" size="13" />
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
                                <x-icon name="ticket" size="20" stroke-width="1.5" class="text-gray-600" />
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
                                                    <x-icon name="trash" size="14" />
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
                                <x-icon name="plus" size="12" stroke="#3b82f6" />
                            </div>
                            Add ticket type
                            <x-icon name="chevron-down" size="14" class="ml-auto transition-transform" />
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
                                <x-icon name="qr" size="14" class="text-gray-400" />
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white">Validate Ticket</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Enter a barcode to admit a guest</p>
                            </div>
                        </div>

                        @if(session('validation_success'))
                            <div class="p-4 rounded-2xl flex items-start gap-3 mb-4
                                        bg-emerald-500/10 border border-emerald-500/20">
                                <x-icon name="check" size="16" stroke="#10b981" class="shrink-0 mt-0.5" />
                                <p class="text-sm font-semibold text-emerald-400">
                                    {{ session('validation_success') }}
                                </p>
                            </div>
                        @endif

                        @if(session('validation_error'))
                            <div class="p-4 rounded-2xl flex items-start gap-3 mb-4
                                        bg-red-500/10 border border-red-500/20">
                                <x-icon name="cancel" size="16" stroke="#ef4444" class="shrink-0 mt-0.5" />
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

            <div x-show="tab === 'statistics'" class="space-y-6">

                <div class="grid grid-cols-2 xl:grid-cols-4 gap-4">
                    <x-stat-card label="Tickets Sold" value="{{ $stats['totalTicketsSold'] }}" color="blue" />
                    <x-stat-card label="Total Revenue" value="€{{ number_format($stats['totalRevenue'], 2) }}" color="purple" />
                    <x-stat-card label="Occupancy Rate" value="{{ $stats['occupancyRate'] }}%" color="yellow" />
                    <x-stat-card label="Available Seats" value="{{ $stats['availableSeats'] }}" color="blue" />
                </div>

                <div class="bg-(--color-surface-3) border border-white/5 rounded-3xl p-8 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10
                                    flex items-center justify-center shrink-0">
                            <x-icon name="chart" size="14" class="text-gray-400" />
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-white">Last 7 Days</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Ticket sales and revenue</p>
                        </div>
                    </div>
                    <canvas id="eventChart" height="100"></canvas>
                </div>

                @if($stats['ticketTypes']->isNotEmpty())
                    <div class="bg-(--color-surface-3) border border-white/5 rounded-3xl p-8 shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10
                                        flex items-center justify-center shrink-0">
                                <x-icon name="ticket" size="14" class="text-gray-400" />
                            </div>
                            <h3 class="text-base font-bold text-white">Ticket Type Breakdown</h3>
                        </div>
                        <div class="space-y-4">
                            @foreach($stats['ticketTypes'] as $type)
                                <div>
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-sm font-medium text-white">{{ $type['name'] }}</span>
                                        <div class="flex items-center gap-4">
                                            <span class="text-xs text-gray-500">{{ $type['sold'] }} / {{ $type['total'] }} sold</span>
                                            <span class="text-sm font-bold text-blue-400">€{{ number_format($type['revenue'], 2) }}</span>
                                        </div>
                                    </div>
                                    <div class="h-2 rounded-full bg-white/5 overflow-hidden">
                                        <div class="h-full rounded-full bg-gradient-to-r from-blue-600 to-blue-400 transition-all"
                                             style="width: {{ $type['total'] > 0 ? round(($type['sold'] / $type['total']) * 100) : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const ctx = document.getElementById('eventChart');
                    if (!ctx) return;

                    new Chart(ctx, {
                        data: {
                            labels: @json($stats['chartData']['labels']),
                            datasets: [
                                {
                                    type: 'bar',
                                    label: 'Tickets',
                                    data: @json($stats['chartData']['tickets']),
                                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                                    borderColor: 'rgba(59, 130, 246, 0.6)',
                                    borderWidth: 1,
                                    borderRadius: 6,
                                    yAxisID: 'y',
                                },
                                {
                                    type: 'line',
                                    label: 'Revenue (€)',
                                    data: @json($stats['chartData']['revenue']),
                                    borderColor: 'rgba(168, 85, 247, 0.8)',
                                    backgroundColor: 'rgba(168, 85, 247, 0.05)',
                                    borderWidth: 2,
                                    pointBackgroundColor: 'rgba(168, 85, 247, 1)',
                                    pointRadius: 4,
                                    tension: 0.4,
                                    fill: true,
                                    yAxisID: 'y1',
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            interaction: { mode: 'index', intersect: false },
                            plugins: {
                                legend: {
                                    labels: { color: '#9ca3af', font: { size: 12 } },
                                },
                            },
                            scales: {
                                x: {
                                    ticks: { color: '#6b7280' },
                                    grid: { color: 'rgba(255,255,255,0.05)' },
                                },
                                y: {
                                    position: 'left',
                                    ticks: { color: '#6b7280', stepSize: 1 },
                                    grid: { color: 'rgba(255,255,255,0.05)' },
                                },
                                y1: {
                                    position: 'right',
                                    ticks: { color: '#6b7280', callback: v => '€' + v },
                                    grid: { drawOnChartArea: false },
                                },
                            },
                        },
                    });
                });
            </script>
        </div>
    </div>
</x-layout>
