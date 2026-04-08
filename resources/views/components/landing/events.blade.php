<section id="events" class="w-full bg-(--color-background) py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="flex items-end justify-between mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">Trending Events</h2>
                <p class="text-gray-400 mt-2 text-sm md:text-base">Discover the most popular upcoming music events.</p>
            </div>
            <a href="{{ route('login') }}"
               class="hidden md:flex items-center gap-2 text-sm font-semibold text-gray-300 hover:text-white transition-colors duration-300">
                View All Events
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="transition-transform group-hover:translate-x-1">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $events = [
                    [
                        'image' => 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?w=800&q=80',
                        'month' => 'SEP',
                        'day'   => '12',
                        'title' => 'Tomorrowland 2024',
                        'location' => 'Romania, Covasna',
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?w=800&q=80',
                        'month' => 'AUG',
                        'day'   => '10',
                        'title' => 'Untold Festival',
                        'location' => 'Romania, Cluj-Napoca',
                    ],
                    [
                        'image' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=800&q=80',
                        'month' => 'JUN',
                        'day'   => '27',
                        'title' => 'Electric Castle',
                        'location' => 'Romania, Bontida',
                    ],
                ];
            @endphp

            @foreach($events as $event)
                <div class="group flex flex-col rounded-2xl overflow-hidden border border-(--color-border) bg-(--color-surface)
                            hover:border-gray-500/50 hover:shadow-2xl hover:shadow-black/40
                            transition-all duration-500 ease-out cursor-pointer relative">

                    <div class="relative overflow-hidden aspect-[4/3] w-full">
                        <img src="{{ $event['image'] }}"
                             alt="{{ $event['title'] }}"
                             class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">

                        <div class="absolute top-4 left-4 bg-black/40 backdrop-blur-md border border-white/10 text-white text-center px-3.5 py-2 rounded-xl shadow-lg">
                            <div class="text-xs font-medium tracking-wider text-gray-200 uppercase mb-0.5">{{ $event['month'] }}</div>
                            <div class="text-xl font-black leading-none">{{ $event['day'] }}</div>
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex-grow">
                            <h4 class="text-white font-bold text-xl mb-2 group-hover:text-blue-400 transition-colors duration-300">
                                {{ $event['title'] }}
                            </h4>
                            <p class="text-gray-400 text-sm flex items-center gap-2 mb-6">
                                <svg class="text-gray-500" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                {{ $event['location'] }}
                            </p>
                        </div>

                        <a href="{{ route('login') }}"
                           class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl
                                  bg-white/5 border border-white/10 text-white text-sm font-semibold
                                  group-hover:bg-(--color-primary) group-hover:border-(--color-primary) group-hover:shadow-lg group-hover:shadow-(--color-primary)/25
                                  transition-all duration-300">
                            View Event
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 text-center md:hidden">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-white/10 px-6 py-3 rounded-full hover:bg-white/20 transition-colors">
                View All Events
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>

    </div>
</section>
