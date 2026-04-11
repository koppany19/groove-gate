@props(['availability'])

@php
    $year = request('year', now()->year);
    $month = request('month', now()->month);
    $firstDay = \Carbon\Carbon::create($year, $month, 1);
    $daysInMonth = $firstDay->daysInMonth;
    $startingDay = $firstDay->dayOfWeek === 0 ? 7 : $firstDay->dayOfWeek;

    $unavailableDates = $availability
        ->where('is_available', false)
        ->pluck('date')
        ->map(fn($date) => \Carbon\Carbon::parse($date)->format('Y-m-d'))
        ->toArray();
@endphp

<div class="bg-(--color-card) border border-white/5 rounded-3xl p-6 shadow-xl">
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-lg font-bold text-white">Availability</h2>
        <div class="flex items-center gap-3">
            <a href="?month={{ $month == 1 ? 12 : $month - 1 }}&year={{ $month == 1 ? $year - 1 : $year }}"
               class="p-1.5 rounded-lg hover:bg-white/10 transition-colors text-gray-400 hover:text-white">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </a>
            <span class="text-sm font-semibold text-white min-w-[100px] text-center">
                {{ $firstDay->format('F Y') }}
            </span>
            <a href="?month={{ $month == 12 ? 1 : $month + 1 }}&year={{ $month == 12 ? $year + 1 : $year }}"
               class="p-1.5 rounded-lg hover:bg-white/10 transition-colors text-gray-400 hover:text-white">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-7 mb-2">
        @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
            <div class="text-center text-xs font-semibold text-gray-600 py-1">
                {{ $day }}
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-7 gap-1">
        @for($i = 1; $i < $startingDay; $i++)
            <div></div>
        @endfor

        @for($day = 1; $day <= $daysInMonth; $day++)
            @php
                $date = \Carbon\Carbon::create($year, $month, $day)->format('Y-m-d');
                $isUnavailable = in_array($date, $unavailableDates);
                $isPast = \Carbon\Carbon::create($year, $month, $day)->isPast();
                $isToday = $date === now()->format('Y-m-d');
            @endphp

            <div class="aspect-square flex items-center justify-center rounded-xl text-xs font-medium
                        {{ $isUnavailable ? 'bg-red-500/20 text-red-400 border border-red-500/30' :
                           ($isPast ? 'text-gray-700' :
                           ($isToday ? 'ring-2 ring-blue-500 text-white' : 'text-gray-400')) }}">
                {{ $day }}
            </div>
        @endfor
    </div>

    <div class="flex items-center gap-4 mt-4 pt-4 border-t border-white/5">
        <div class="flex items-center gap-1.5">
            <div class="w-3 h-3 rounded-full bg-red-500/20 border border-red-500/30"></div>
            <span class="text-xs text-gray-500">Unavailable</span>
        </div>
        <div class="flex items-center gap-1.5">
            <div class="w-3 h-3 rounded-full ring-2 ring-blue-500"></div>
            <span class="text-xs text-gray-500">Today</span>
        </div>
    </div>
</div>
