<section class="w-full bg-(--color-background)">
    <div class="max-w-7xl mx-auto px-8 py-20 flex items-center justify-between gap-12">

        <div class="flex-1 max-w-lg">
            <h1 class="text-6xl font-black leading-tight mb-6 space-x-0.5">
                FEEL THE<br>
                <span class="text-5xl space-x-2" style="background: var(--color-primary); padding: 8px 24px; display: inline-block; transform: rotate(-2deg);">
                    GROOVE
                </span>
            </h1>
            <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                Connecting fans, artists, and organizers for the
                ultimate festival experience. Discover your next
                unforgettable moment.
            </p>

            <div class="flex items-center gap-4">
                <a href="{{ route('register') }}"
                   class="px-7 py-3 rounded-full bg-(--color-primary) text-white font-semibold text-base hover:opacity-90 transition-all">
                    Get started
                </a>
                <a href="#events"
                   class="px-7 py-3 rounded-full border border-white text-white font-semibold text-base hover:bg-white hover:text-black transition-all">
                    Explore events
                </a>
            </div>
        </div>

        <div class="flex-1 max-w-xl">
            <img src="/images/concert.jpg"
                 alt="Concert"
                 class="w-full rounded-3xl object-cover"
                 style="height: 345px;">
        </div>
    </div>
</section>
