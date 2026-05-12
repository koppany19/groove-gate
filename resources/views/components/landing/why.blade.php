<section class="w-full bg-(--color-surface-2) py-24 outline-2 outline-(--color-border)">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-2 gap-20 items-center">
            <div>
                <h2 class="text-5xl font-bold text-white leading-tight mb-4">
                    Why Choose<br>GrooveGate?
                </h2>

                <div class="w-16 h-1 bg-(--color-link) rounded-full mb-8"></div>

                <p class="text-gray-400 text-base leading-relaxed mb-4">
                    We're more than just a ticketing platform. GrooveGate is a comprehensive
                    ecosystem designed to elevate the live music experience from every angle.
                </p>

                <p class="text-gray-400 text-base leading-relaxed mb-8">
                    By eliminating friction in booking, sales, and discovery, we let the music
                    take center stage. Whether you're headlining a stadium or catching your
                    favorite indie band in a local club, we ensure the process is flawless.
                </p>

                <a href="{{ route('register') }}"
                   class="text-(--color-link) font-semibold text-sm hover:underline transition-all">
                    Read Our Story →
                </a>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-(--color-surface) border border-(--color-border) rounded-2xl p-6
                            hover:border-blue-500 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 bg-(--color-primary)/10 rounded-xl flex items-center justify-center mb-4">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <h4 class="text-white font-bold text-base mb-2">Secure Payments</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">Safe and encrypted transactions for every booking.</p>
                </div>

                <div class="bg-(--color-surface) border border-(--color-border) rounded-2xl p-6
                            hover:border-blue-500 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 bg-(--color-primary)/10 rounded-xl flex items-center justify-center mb-4">
                        <x-icon name="clock" size="20" stroke="#3b82f6" />
                    </div>
                    <h4 class="text-white font-bold text-base mb-2">Real-time Stats</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">Track your event performance live as it happens.</p>
                </div>

                <div class="bg-(--color-surface) border border-(--color-border) rounded-2xl p-6
                            hover:border-blue-500 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 bg-(--color-primary)/10 rounded-xl flex items-center justify-center mb-4">
                        <x-icon name="music" size="20" stroke="#3b82f6" />
                    </div>
                    <h4 class="text-white font-bold text-base mb-2">Smart Booking</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">Effortless artist booking with intelligent matching.</p>
                </div>

                <div class="bg-(--color-surface) border border-(--color-border) rounded-2xl p-6
                            hover:border-blue-500 hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 bg-(--color-primary)/10 rounded-xl flex items-center justify-center mb-4">
                        <x-icon name="users" size="20" stroke="#3b82f6" />
                    </div>
                    <h4 class="text-white font-bold text-base mb-2">Community</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">Connect fans, artists and organisers in one place.</p>
                </div>
            </div>
        </div>
    </div>
</section>
