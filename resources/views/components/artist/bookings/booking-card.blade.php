@props(['booking'])

<div class="bg-(--color-card) border border-white/5 rounded-3xl p-5 shadow-xl
            hover:border-white/10 transition-all">
    <div class="flex items-start gap-5">

        <div class="w-40 h-28 rounded-2xl overflow-hidden flex-shrink-0 bg-white/5">
            @if($booking->event->cover_image)
                <img src="{{ str_starts_with($booking->event->cover_image, 'http')
                                ? $booking->event->cover_image
                                : Storage::url($booking->event->cover_image) }}"
                     alt="{{ $booking->event->name }}"
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-blue-950 to-gray-900
                            flex items-center justify-center">
                    <x-icon name="calendar" size="22" stroke-width="1.5" class="text-gray-600" />
                </div>
            @endif
        </div>

        <div class="flex-1 min-w-0">

            <div class="flex items-start justify-between gap-3 mb-1">
                <h3 class="text-white font-bold text-base leading-tight truncate">
                    {{ $booking->event->name }}
                </h3>
                <span class="px-2.5 py-1 rounded-full text-xs font-bold border flex-shrink-0
                             {{ $booking->status->color() }}">
                    {{ $booking->status->label() }}
                </span>
            </div>

            <p class="text-gray-500 text-sm">
                {{ $booking->event->organiserProfile->company_name
                    ?? $booking->event->organiserProfile->user->name }}
            </p>

            <div class="h-px bg-white/5 my-3"></div>

            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-4 text-sm text-gray-400">
                    @if($booking->performance_date)
                        <span>{{ $booking->performance_date->format('M d, Y') }}</span>
                    @endif
                    @if($booking->fee)
                        <span class="text-gray-600">·</span>
                        <span>€{{ number_format($booking->fee, 2) }}</span>
                    @endif
                    @if($booking->duration)
                        <span class="text-gray-600">·</span>
                        <span>{{ $booking->duration }} min</span>
                    @endif
                </div>

                <a href="{{ route('artist.bookings.show', $booking) }}"
                   class="flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-medium
                          text-gray-400 border border-white/10 hover:border-white/20
                          hover:text-white hover:bg-blue-500 hover:border-blue-900 transition-all flex-shrink-0">
                    View
                    <x-icon name="arrow-right" size="13" />
                </a>
            </div>

        </div>

    </div>
</div>
