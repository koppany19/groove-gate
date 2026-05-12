<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8
                flex items-center justify-center p-6">

        <div class="max-w-md w-full">

            <div class="absolute left-1/2 -translate-x-1/2 w-80 h-40
                        bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative bg-white/5 border border-white/10 rounded-3xl p-8 text-center backdrop-blur-sm">

                <div class="w-20 h-20 rounded-full bg-emerald-500/15 border border-emerald-500/25
                            flex items-center justify-center mx-auto mb-6">
                    <x-icon name="check" size="36" stroke="#10b981" stroke-width="2.5" />
                </div>

                <h1 class="text-3xl font-black text-white mb-2">You're going!</h1>
                <p class="text-emerald-400 font-medium text-sm mb-3">Payment confirmed</p>
                <p class="text-gray-400 text-sm leading-relaxed mb-8">
                    Your ticket is secured. Check your dashboard to see it —
                    we'll see you at the event!
                </p>

                <div class="flex flex-col gap-3">
                    <a href="{{ route('audience.dashboard') }}"
                       class="w-full py-3.5 rounded-2xl text-white font-bold text-sm
                              bg-gradient-to-r from-emerald-600 to-emerald-500
                              hover:from-emerald-500 hover:to-emerald-400
                              shadow-lg shadow-emerald-500/20 transition-all">
                        View My Ticket
                    </a>
                    <a href="{{ route('audience.events.index') }}"
                       class="w-full py-3.5 rounded-2xl text-gray-400 font-medium text-sm
                              border border-white/10 hover:border-white/20
                              hover:text-white transition-all">
                        Browse More Events
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
