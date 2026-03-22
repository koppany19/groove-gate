<section class="w-full bg-(--color-background) py-24">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-2 gap-20 items-center"
             x-data="{
                active: 0,
                init() { setInterval(() => this.active = (this.active + 1) % 3, 4000) }
             }">
            <div>
                <p class="text-gray-400 font-semibold text-base mb-4">How GrooveGate works?</p>
                <div x-show="active === 0"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <h2 class="text-5xl font-black text-white leading-tight mb-4">Build Your<br>Dream Festival</h2>
                    <p class="text-gray-400 text-base leading-relaxed mb-8">Manage your entire line-up, set dynamic ticket prices and track revenue in real time.</p>
                    <div class="flex items-center gap-6 mb-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                            </div>
                            <span class="text-white font-semibold text-sm">Real-time stats</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </div>
                            <span class="text-white font-semibold text-sm">Smart booking</span>
                        </div>
                    </div>
                </div>

                <div x-show="active === 1"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <h2 class="text-5xl font-black text-white leading-tight mb-4">Grow Your<br>Music Career</h2>
                    <p class="text-gray-400 text-base leading-relaxed mb-8">Manage bookings seamlessly, reach new audiences globally, and grow your dedicated fanbase.</p>
                    <div class="flex items-center gap-6 mb-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                            </div>
                            <span class="text-white font-semibold text-sm">Easy booking</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <span class="text-white font-semibold text-sm">Profile management</span>
                        </div>
                    </div>
                </div>

                <div x-show="active === 2"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <h2 class="text-5xl font-black text-white leading-tight mb-4">Discover<br>Live Events</h2>
                    <p class="text-gray-400 text-base leading-relaxed mb-8">Find the best events near you, buy tickets securely and connect with music lovers.</p>
                    <div class="flex items-center gap-6 mb-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M2 9l10-7 10 7v11a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            </div>
                            <span class="text-white font-semibold text-sm">Secure tickets</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            </div>
                            <span class="text-white font-semibold text-sm">Event discovery</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button @click="active = 0"
                            :class="active === 0 ? 'w-8 h-2.5 bg-(--color-primary)' : 'w-2.5 h-2.5 bg-gray-600 hover:bg-gray-400'"
                            class="rounded-full transition-all duration-300">
                    </button>
                    <button @click="active = 1"
                            :class="active === 1 ? 'w-8 h-2.5 bg-(--color-primary)' : 'w-2.5 h-2.5 bg-gray-600 hover:bg-gray-400'"
                            class="rounded-full transition-all duration-300">
                    </button>
                    <button @click="active = 2"
                            :class="active === 2 ? 'w-8 h-2.5 bg-(--color-primary)' : 'w-2.5 h-2.5 bg-gray-600 hover:bg-gray-400'"
                            class="rounded-full transition-all duration-300">
                    </button>
                </div>
            </div>

            <div class="relative rounded-2xl overflow-hidden border border-(--color-border)">

                <div x-show="active === 0"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
                    <div class="bg-gray-900 px-4 py-3 flex items-center gap-2 border-b border-(--color-border)">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-gray-400 text-xs ml-2">GrooveGate Organiser</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800"
                         alt="Organiser Dashboard"
                         class="w-full h-80 object-cover">
                </div>

                <div x-show="active === 1"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
                    <div class="bg-gray-900 px-4 py-3 flex items-center gap-2 border-b border-(--color-border)">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-gray-400 text-xs ml-2">GrooveGate Artist</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=800"
                         alt="Artist Dashboard"
                         class="w-full h-80 object-cover">
                </div>

                <div x-show="active === 2"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">
                    <div class="bg-gray-900 px-4 py-3 flex items-center gap-2 border-b border-(--color-border)">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-gray-400 text-xs ml-2">GrooveGate Audience</span>
                    </div>
                    <img src="https://images.unsplash.com/photo-1506157786151-b8491531f063?w=800"
                         alt="Audience Dashboard"
                         class="w-full h-80 object-cover">
                </div>

            </div>

        </div>
    </div>
</section>
