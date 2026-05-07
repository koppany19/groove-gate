<x-layout>
    <div class="min-h-screen bg-(--color-background) text-(--color-foreground) -m-8 p-6 md:p-10">
        <div class="max-w-lg mx-auto">
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('audience.dashboard') }}"
                   class="p-2 rounded-xl bg-white/5 hover:bg-white/10 border border-(--color-border) transition-all">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-black tracking-tight">Jegyem</h1>
                    <p class="text-sm text-(--color-muted) mt-0.5">{{ $ticket->event->name }}</p>
                </div>
            </div>

            <div class="bg-(--color-surface-3) border border-(--color-border) rounded-3xl overflow-hidden shadow-2xl">

                <div class="h-44 overflow-hidden relative">
                    @if($ticket->event->cover_image)
                        <img src="{{ str_starts_with($ticket->event->cover_image, 'http') ? $ticket->event->cover_image : Storage::url($ticket->event->cover_image) }}"
                             alt="{{ $ticket->event->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full"
                             style="background: linear-gradient(135deg, #064e3b 0%, #0f172a 100%)"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>

                    <div class="absolute top-4 right-4 flex items-center gap-1.5 px-3 py-1.5
                                bg-(--color-success-subtle) border border-(--color-audience)/30
                                rounded-full backdrop-blur-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-(--color-audience) animate-pulse"></span>
                        <span class="text-xs font-semibold text-(--color-audience)">Érvényes</span>
                    </div>
                </div>

                <div class="p-6">
                    <h2 class="text-xl font-black text-(--color-foreground) mb-1">{{ $ticket->event->name }}</h2>
                    <p class="text-(--color-muted) text-sm mb-6">
                        {{ $ticket->event->location }} &middot; {{ $ticket->event->start_date->format('Y. M d. · H:i') }}
                    </p>

                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <div class="bg-(--color-surface) rounded-2xl p-4 border border-(--color-border)">
                            <p class="text-xs text-(--color-muted) mb-1">Jegy típus</p>
                            <p class="text-sm font-bold text-(--color-foreground)">{{ $ticket->ticketType->name }}</p>
                        </div>

                        <div class="bg-(--color-surface) rounded-2xl p-4 border border-(--color-border)">
                            <p class="text-xs text-(--color-muted) mb-1">Fizetett ár</p>
                            <p class="text-sm font-bold text-(--color-audience)">€{{ number_format($ticket->price, 2) }}</p>
                        </div>

                        @if($ticket->seat)
                        <div class="bg-(--color-surface) rounded-2xl p-4 border border-(--color-border)">
                            <p class="text-xs text-(--color-muted) mb-1">Ülőhely</p>
                            <p class="text-sm font-bold text-(--color-foreground)">{{ $ticket->seat->seat_number }}</p>
                        </div>
                        @endif

                        <div class="bg-(--color-surface) rounded-2xl p-4 border border-(--color-border) {{ $ticket->seat ? '' : 'col-span-2' }}">
                            <p class="text-xs text-(--color-muted) mb-1">Vonalkód</p>
                            <p class="text-xs font-mono font-bold text-(--color-foreground) tracking-widest truncate">{{ $ticket->barcode }}</p>
                        </div>
                    </div>


                    <div class="relative my-6">
                        <div class="absolute -left-6 top-1/2 -translate-y-1/2 w-5 h-5
                                    rounded-full bg-(--color-background)"></div>
                        <div class="border-t border-dashed border-(--color-border)"></div>
                        <div class="absolute -right-6 top-1/2 -translate-y-1/2 w-5 h-5
                                    rounded-full bg-(--color-background)"></div>
                    </div>

                    <div class="flex flex-col items-center gap-4">
                        <div class="bg-white p-5 rounded-2xl shadow-lg" id="qr-code">
                            {!! $qrCode !!}
                        </div>
                        <p class="text-xs text-(--color-muted-2) text-center">
                            Mutasd be ezt a kódot a beléptetőnek
                        </p>
                        <a href="data:image/svg+xml;charset=utf-8,{{ rawurlencode($qrCode) }}"
                           download="ticket-{{ $ticket->barcode }}.svg"
                           class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium text-gray-400 border border-white/10 hover:border-white/20 hover:text-white transition-all">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                            Download QR Code
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
