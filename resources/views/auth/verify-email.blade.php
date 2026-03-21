<x-layout>
    <x-form title="Verify your email" description="Please verify your email address to continue.">
        <div class="mt-10 space-y-5">

            <div class="bg-zinc-900 border border-zinc-700 rounded-xl p-5 text-center space-y-3">
                <div class="flex justify-center">
                    <div class="w-12 h-12 rounded-full bg-yellow-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-white font-medium">Check your inbox</p>
                <p class="text-zinc-400 text-sm">
                    We sent a verification link to
                    <span class="text-white">{{ auth()->user()->email }}</span>
                </p>
            </div>

            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full h-11 bg-white text-black font-semibold rounded-lg text-sm
                               hover:bg-gray-100 transition-colors duration-150">
                    Resend verification email
                </button>
            </form>

            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full text-center text-sm text-zinc-500 hover:text-white transition-colors">
                    Logout
                </button>
            </form>

        </div>
    </x-form>
</x-layout>
