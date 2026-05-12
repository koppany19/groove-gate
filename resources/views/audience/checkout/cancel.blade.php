<x-layout>
    <div class="min-h-screen bg-(--color-artist-bg) text-white -m-8
                flex items-center justify-center p-6">

        <div class="max-w-md w-full">

            <div class="absolute left-1/2 -translate-x-1/2 w-80 h-40
                        bg-red-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative bg-white/5 border border-white/10 rounded-3xl p-8 text-center backdrop-blur-sm">

                <div class="w-20 h-20 rounded-full bg-red-500/15 border border-red-500/25
                            flex items-center justify-center mx-auto mb-6">
                    <x-icon name="x" size="36" stroke="#ef4444" stroke-width="2.5" />
                </div>

                <h1 class="text-3xl font-black text-white mb-2">Maybe next time</h1>
                <p class="text-red-400 font-medium text-sm mb-3">Payment cancelled</p>
                <p class="text-gray-400 text-sm leading-relaxed mb-8">
                    No worries — you haven't been charged.
                    The event is still waiting for you whenever you're ready.
                </p>

                <a href="{{ route('audience.events.index') }}"
                   class="w-full py-3.5 rounded-2xl text-white font-bold text-sm
                          bg-gradient-to-r from-blue-600 to-blue-500
                          hover:from-blue-500 hover:to-blue-400
                          shadow-lg shadow-blue-500/20 transition-all inline-block">
                    Back to Events
                </a>
            </div>
        </div>
    </div>
</x-layout>
