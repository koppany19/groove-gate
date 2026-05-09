<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8 p-6 md:p-10">
        <div class="max-w-[1100px] mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-black text-white tracking-tight">Dashboard</h1>
                <p class="text-sm text-gray-400 mt-1">
                    Welcome back, {{ auth()->user()->artistProfile->stage_name ?? auth()->user()->name }}
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <x-stat-card label="Total Bookings" :value="$bookings->count()" color="blue" />
                <x-stat-card label="Upcoming Shows" :value="$upcomingShows->count()" color="purple" />
                <x-stat-card label="Shows Played" :value="$showsPlayed->count()" color="yellow" />
                <x-stat-card label="Total Earnings" value="€{{ number_format($totalEarnings, 2) }}" color="blue" />
            </div>

            <div class="bg-(--color-surface-3) border border-white/5 rounded-3xl overflow-hidden shadow-xl mb-6">
                <div class="px-6 pt-6 pb-4 border-b border-white/5">
                    <h3 class="text-base font-bold text-white">Earnings & Booking Requests</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Last 7 days</p>
                </div>
                <div class="chart-container">
                    <canvas id="chart"></canvas>
                </div>
                <div class="flex items-center gap-6 px-6 pb-5">
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        Earnings (€)
                    </div>
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <div class="w-3 h-3 rounded-full bg-white/20"></div>
                        Booking requests
                    </div>
                </div>
            </div>

            <div class="bg-(--color-surface-3) border border-white/5 rounded-3xl overflow-hidden shadow-xl">
                <div class="px-6 pt-6 pb-4 border-b border-white/5">
                    <h3 class="text-base font-bold text-white">Activity</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Everything that happened</p>
                </div>

                @if(empty($activity))
                    <div class="flex flex-col items-center justify-center py-16">
                        <p class="text-gray-500 text-sm">No activity yet</p>
                        <p class="text-gray-600 text-xs mt-1">Booking requests will appear here</p>
                    </div>
                @else
                    <div class="divide-y divide-white/5">
                        @foreach($activity as $item)
                            <div class="flex items-start gap-4 px-6 py-4">
                                <div class="w-8 h-8 rounded-xl bg-white/5 border border-white/10
                                            flex items-center justify-center flex-shrink-0 mt-0.5">
                                    @if($item['icon'] === 'accepted')
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                             stroke="#9ca3af" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    @elseif($item['icon'] === 'declined')
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                             stroke="#9ca3af" stroke-width="2">
                                            <line x1="18" y1="6" x2="6" y2="18"/>
                                            <line x1="6" y1="6" x2="18" y2="18"/>
                                        </svg>
                                    @elseif($item['icon'] === 'upcoming')
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                             stroke="#9ca3af" stroke-width="2">
                                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                                            <line x1="3" y1="10" x2="21" y2="10"/>
                                        </svg>
                                    @else
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                             stroke="#9ca3af" stroke-width="2">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.29 6.29l1.46-1.46a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-300 leading-relaxed">
                                        {!! $item['text'] !!}
                                    </p>
                                    <p class="text-xs text-gray-600 mt-1">
                                        {{ \Carbon\Carbon::parse($item['time'])->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('chart').getContext('2d')
        new Chart(ctx, {
            data: {
                labels: @json($chartData['labels']),
                datasets: [
                    {
                        type: 'line',
                        label: 'Earnings',
                        data: @json($chartData['revenue']),
                        borderColor: '#3b82f6',
                        backgroundColor: '#3b82f610',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#3b82f6',
                        pointRadius: 3,
                        yAxisID: 'y'
                    },
                    {
                        type: 'bar',
                        label: 'Requests',
                        data: @json($chartData['requests']),
                        backgroundColor: '#ffffff15',
                        borderColor: '#ffffff30',
                        borderWidth: 1,
                        borderRadius: 4,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: { legend: { display: false } },
                scales: {
                    x: {
                        grid: { color: '#ffffff08' },
                        ticks: { color: '#6b7280', font: { size: 11 } }
                    },
                    y: {
                        position: 'left',
                        grid: { color: '#ffffff08' },
                        ticks: {
                            color: '#6b7280',
                            font: { size: 11 },
                            callback: v => '€' + v
                        }
                    },
                    y1: {
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        ticks: { color: '#6b7280', font: { size: 11 } }
                    }
                }
            }
        })
    </script>
</x-layout>
