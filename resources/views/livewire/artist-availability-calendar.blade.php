<div>
    <div class="flex items-center justify-between mb-4">
        <button wire:click="previousMonth"
                class="text-zinc-400 hover:text-white transition-colors p-2 rounded-lg hover:bg-zinc-800">
            ←
        </button>

        <h2 class="text-white font-semibold">
            {{ $monthName }}
        </h2>

        <button wire:click="nextMonth"
                class="text-zinc-400 hover:text-white transition-colors p-2 rounded-lg hover:bg-zinc-800">
            →
        </button>
    </div>

    <div class="grid grid-cols-7 mb-2">
        @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
            <div class="text-center text-xs text-zinc-500 font-medium py-2">
                {{ $day }}
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-7 gap-1">
        @for($i = 0; $i < $startDay; $i++)
            <div wire:key="padding-{{ $i }}"></div>
        @endfor

        @foreach($days as $dayData)
            <button
                wire:key="day-{{ $dayData['date'] }}"
                wire:click="toggleDate('{{ $dayData['date'] }}')"
                @disabled($dayData['isPast'])
                class="
                    aspect-square rounded-lg text-sm font-medium transition-all duration-150
                    flex items-center justify-center
                    {{ $dayData['isPast']
                        ? 'text-zinc-700 cursor-not-allowed'
                        : ($dayData['isUnavailable']
                            ? 'bg-red-500/20 text-red-400 border border-red-500/30 hover:bg-red-500/30'
                            : 'text-zinc-300 hover:bg-zinc-800 hover:text-white')
                    }}
                    {{ $dayData['isToday'] ? 'ring-1 ring-white/30' : '' }}
                ">
                {{ $dayData['number'] }}
            </button>
        @endforeach
    </div>

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
