<section id="events" class="w-full bg-(--color-background) py-24">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-bold text-white">Trending Events</h2>
            <a href="{{ route('login') }}"
               class="text-sm text-(--color-link) hover:underline transition-all">
                View All →
            </a>
        </div>

        <div class="grid grid-cols-3 gap-6">
            @php
                $events = [
                    [
                        'image' => 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?w=600',
                        'month' => 'SEP',
                        'day'   => '12',
                        'title' => 'Tomorrowland 2024',
                        'location' => 'Romania, Covasna',
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?w=600',
                        'month' => 'AUG',
                        'day'   => '10',
                        'title' => 'Tomorrowland 2024',
                        'location' => 'Romania, Covasna',
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=600',
                        'month' => 'JUN',
                        'day'   => '27',
                        'title' => 'Tomorrowland 2024',
                        'location' => 'Romania, Covasna',
                    ],
                ];
            @endphp

            @foreach($events as $event)
                <div class="rounded-2xl overflow-hidden border border-(--color-border) bg-(--color-surface)
                            hover:border-blue-500 hover:-translate-y-2 hover:shadow-lg hover:shadow-blue-500/10
                            transition-all duration-300 cursor-pointer">

                    <div class="relative">
                        <img src="{{ $event['image'] }}"
                             alt="{{ $event['title'] }}"
                             class="w-full h-48 object-cover">

                        <div class="absolute top-3 left-3 bg-(--color-primary) text-white text-center px-3 py-1.5 rounded-lg">
                            <div class="text-xs font-semibold">{{ $event['month'] }}</div>
                            <div class="text-lg font-black leading-none">{{ $event['day'] }}</div>
                        </div>
                    </div>

                    <div class="p-5">
                        <h4 class="text-white font-bold text-lg mb-1">{{ $event['title'] }}</h4>
                        <p class="text-gray-400 text-sm flex items-center gap-1 mb-4">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            {{ $event['location'] }}
                        </p>

                        <a href="{{ route('login') }}"
                           class="w-full block text-center py-2.5 rounded-xl border border-(--color-border)
                                  text-white text-sm font-semibold hover:bg-(--color-primary) hover:border-transparent
                                  transition-all duration-200">
                            Get Tickets
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</section>
