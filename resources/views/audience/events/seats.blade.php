<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10"
         x-data="{
            selected: [],
            maxSeats: 4,
            toggle(seatId, seatNumber) {
                const idx = this.selected.findIndex(s => s.id === seatId)
                if (idx > -1) {
                    this.selected.splice(idx, 1)
                } else {
                    if (this.selected.length >= this.maxSeats) return
                    this.selected.push({ id: seatId, number: seatNumber })
                }
            },
            isSelected(seatId) {
                return this.selected.some(s => s.id === seatId)
            },
            totalPrice() {
                return (this.selected.length * {{ $event->calculatePrice() }}).toFixed(2)
            }
         }">

        <div class="max-w-[1100px] mx-auto">

            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('audience.events.show', $event) }}"
                   class="p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                    <x-icon name="arrow-left" size="18" />
                </a>
                <div>
                    <h1 class="text-2xl font-black text-white tracking-tight">Choose Your Seats</h1>
                    <p class="text-sm text-(--color-muted) mt-0.5">{{ $event->name }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                <div class="xl:col-span-2">
                    <div class="bg-(--color-surface-3) border border-white/5 border-t-2 border-t-blue-500/60
                                rounded-3xl p-8 shadow-xl mb-3">

                        <div class="flex justify-center mb-10">
                            <div class="relative">
                                <div class="absolute -inset-3 bg-blue-500/10 rounded-2xl blur-xl pointer-events-none"></div>
                                <div class="relative px-16 py-2.5 rounded-xl bg-white/5 border border-white/10">
                                    <p class="text-[11px] font-bold text-(--color-muted) uppercase tracking-[0.2em]">Stage</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            @foreach($seats as $row => $rowSeats)
                                <div class="flex items-center gap-3">
                                    <span class="text-xs font-bold text-(--color-muted-2) w-5 text-right flex-shrink-0">
                                        {{ $row }}
                                    </span>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($rowSeats as $seat)
                                            @if($seat->is_reserved)
                                                <div class="seat seat-taken">
                                                    {{ substr($seat->seat_number, 1) }}
                                                </div>
                                            @else
                                                <button type="button"
                                                        @click="toggle({{ $seat->id }}, '{{ $seat->seat_number }}')"
                                                        :class="isSelected({{ $seat->id }}) ? 'seat-selected' : 'seat-available'"
                                                        class="seat">
                                                    {{ substr($seat->seat_number, 1) }}
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-center gap-8 mt-10 pt-6 border-t border-white/5">
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-md bg-white/5 border border-white/10"></div>
                                <span class="text-xs text-(--color-muted)">Available</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-md bg-blue-500 border border-blue-400"></div>
                                <span class="text-xs text-(--color-muted)">Selected</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-5 h-5 rounded-md bg-white/5 border border-white/5 opacity-40"></div>
                                <span class="text-xs text-(--color-muted)">Taken</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-(--color-muted-2) text-center">
                        Max <span class="text-(--color-muted)">4 seats</span> per order
                    </p>
                </div>

                <div class="space-y-5">

                    <div class="bg-(--color-surface-3) border border-white/5 border-t-2 border-t-blue-500/60
                                rounded-3xl p-6 shadow-xl">
                        <h3 class="text-base font-bold text-white mb-5">Order Summary</h3>

                        <div class="min-h-[80px] mb-5">
                            <template x-if="selected.length === 0">
                                <p class="text-sm text-(--color-muted-2)">No seats selected yet</p>
                            </template>
                            <div class="space-y-2">
                                <template x-for="seat in selected" :key="seat.id">
                                    <div class="flex items-center justify-between py-2 border-b border-white/5">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-lg bg-blue-500/10 border border-blue-500/20
                                                        flex items-center justify-center">
                                                <span class="text-[10px] font-black text-blue-400" x-text="seat.number"></span>
                                            </div>
                                            <span class="text-sm text-(--color-foreground)" x-text="'Seat ' + seat.number"></span>
                                        </div>
                                        <span class="text-sm font-bold text-white">
                                            €{{ number_format($event->calculatePrice(), 2) }}
                                        </span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="flex items-center justify-between py-4 border-t border-white/5 mb-5">
                            <span class="text-sm text-(--color-muted)">Total</span>
                            <span class="text-2xl font-black text-blue-400">
                                €<span x-text="totalPrice()"></span>
                            </span>
                        </div>

                        <form action="{{ route('audience.checkout.seats', $event) }}" method="POST">
                            @csrf
                            <template x-for="seat in selected" :key="seat.id">
                                <input type="hidden" name="seat_ids[]" :value="seat.id">
                            </template>
                            <button type="submit"
                                    :disabled="selected.length === 0"
                                    class="w-full py-3.5 rounded-2xl text-white font-bold text-sm bg-gradient-to-r from-blue-600 to-blue-500
                                           hover:from-blue-500 hover:to-blue-400 shadow-lg shadow-blue-500/20 transition-all
                                           disabled:opacity-40 disabled:cursor-not-allowed">
                                Purchase Tickets
                            </button>
                        </form>
                    </div>

                    <div class="bg-(--color-surface-3) border border-white/5 rounded-3xl p-6 shadow-xl">
                        <h3 class="text-sm font-bold text-white mb-4">Event Info</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-(--color-muted)">Event</span>
                                <span class="text-xs font-semibold text-white">{{ $event->name }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-(--color-muted)">Date</span>
                                <span class="text-xs font-semibold text-white">
                                    {{ $event->start_date->format('M d, Y') }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-(--color-muted)">Available</span>
                                <span class="text-xs font-semibold text-emerald-400">
                                    {{ $event->availableSeats() }} seats left
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-(--color-muted)">Price per seat</span>
                                <span class="text-xs font-bold text-(--color-artist)">
                                    €{{ number_format($event->calculatePrice(), 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
