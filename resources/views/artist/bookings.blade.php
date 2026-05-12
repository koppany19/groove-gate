<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1400px] mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-black text-white tracking-tight">Booking Requests</h1>
                <p class="text-sm text-gray-400 mt-1">{{ $counts['all'] }} requests total</p>
            </div>

            <div class="flex items-center gap-2 mb-6">
                @foreach([
                    'all'      => 'All',
                    'pending'  => 'Pending',
                    'accepted' => 'Accepted',
                    'declined' => 'Declined',
                ] as $key => $label)
                    <a href="{{ $key === 'all' ? route('artist.bookings') : route('artist.bookings', ['status' => $key]) }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium
                              transition-all border
                              {{ request('status', 'all') === $key
                                  ? 'bg-blue-500 border-blue-500 text-white'
                                  : 'bg-white/5 border-white/10 text-gray-400 hover:border-white/20 hover:text-white' }}">
                        {{ $label }}
                        <span class="text-xs px-1.5 py-0.5 rounded-full
                                     {{ request('status', 'all') === $key
                                         ? 'bg-white/20 text-white'
                                         : 'bg-white/10 text-gray-500' }}">
                            {{ $counts[$key] }}
                        </span>
                    </a>
                @endforeach
            </div>

            @if($bookings->isEmpty())
                <div class="flex flex-col items-center justify-center py-24">
                    <div class="w-20 h-20 rounded-full bg-white/5 flex items-center justify-center mb-6">
                        <x-icon name="phone" size="36" stroke-width="1.5" class="text-gray-600" />
                    </div>
                    <h2 class="text-xl font-bold text-white mb-2">No requests found</h2>
                    <p class="text-gray-500 text-sm">
                        {{ request('status') ? 'No ' . request('status') . ' requests.' : 'When organisers send you booking requests, they\'ll appear here.' }}
                    </p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($bookings as $booking)
                        <x-artist.bookings.booking-card :booking="$booking" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layout>
