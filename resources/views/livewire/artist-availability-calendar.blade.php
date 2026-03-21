<div>
    {{-- Navigáció --}}
    <div class="flex items-center justify-between mb-4">
        <button wire:click="previousMonth"
                class="text-zinc-400 hover:text-white transition-colors p-2 rounded-lg hover:bg-zinc-800">
            ←
        </button>

        <h2 class="text-white font-semibold">
            {{ Carbon\Carbon::create($year, $month, 1)->format('F Y') }}
        </h2>

        <button wire:click="nextMonth"
                class="text-zinc-400 hover:text-white transition-colors p-2 rounded-lg hover:bg-zinc-800">
            →
        </button>
    </div>

    {{-- Hét napjai --}}
    <div class="grid grid-cols-7 mb-2">
        @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
            <div class="text-center text-xs text-zinc-500 font-medium py-2">
                {{ $day }}
            </div>
        @endforeach
    </div>

    {{-- Naptár napjai --}}
    <div class="grid grid-cols-7 gap-1">

        {{-- Üres cellák a hónap kezdete előtt --}}
        @php
            $startDay = $startDay === 0 ? 6 : $startDay - 1;
        @endphp

        @for($i = 0; $i < $startDay; $i++)
            <div></div>
        @endfor

        {{-- Napok --}}
        @for($day = 1; $day <= $daysInMonth; $day++)
            @php
                $date = Carbon\Carbon::create($year, $month, $day)->format('Y-m-d');
                $isUnavailable = in_array($date, $unavailableDates);
                $isPast = Carbon\Carbon::create($year, $month, $day)->isPast();
                $isToday = Carbon\Carbon::create($year, $month, $day)->isToday();
            @endphp

            <button
                wire:click="toggleDate('{{ $date }}')"
                @disabled($isPast)
                class="
                    aspect-square rounded-lg text-sm font-medium transition-all duration-150
                    flex items-center justify-center
                    {{ $isPast
                        ? 'text-zinc-700 cursor-not-allowed'
                        : ($isUnavailable
                            ? 'bg-red-500/20 text-red-400 border border-red-500/30 hover:bg-red-500/30'
                            : 'text-zinc-300 hover:bg-zinc-800 hover:text-white')
                    }}
                    {{ $isToday ? 'ring-1 ring-white/30' : '' }}
                ">
                {{ $day }}
            </button>
        @endfor
    </div>

    {{-- Jelmagyarázat --}}
    <div class="flex items-center gap-4 mt-4 pt-4 border-t border-zinc-800">
        <div class="flex items-center gap-2 text-xs text-zinc-400">
            <div class="w-3 h-3 rounded bg-red-500/20 border border-red-500/30"></div>
            Unavailable
        </div>
        <div class="flex items-center gap-2 text-xs text-zinc-400">
            <div class="w-3 h-3 rounded bg-zinc-800"></div>
            Available
        </div>
        <div class="flex items-center gap-2 text-xs text-zinc-400">
            <div class="w-3 h-3 rounded ring-1 ring-white/30"></div>
            Today
        </div>
    </div>
</div>
