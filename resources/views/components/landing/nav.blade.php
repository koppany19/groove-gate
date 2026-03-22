<nav class="w-full bg-(--color-background)">
    <div class="max-w-7xl mx-auto px-8 py-4 flex items-center justify-between">
        <a href="/">
            <img src="{{ asset('images/heroLogo.png') }}" alt="GrooveGate" class="w-16 h-16">
        </a>

        <div class="flex items-center gap-3">
            <div class="flex items-center gap-10 mr-10">
                <a href="#features" class="text-base font-semibold text-white hover:text-blue-400 transition-colors">Features</a>
                <a href="#roles" class="text-base font-semibold text-white hover:text-blue-400 transition-colors">Roles</a>
                <a href="#events" class="text-base font-semibold text-white hover:text-blue-400 transition-colors">Events</a>
            </div>
            <a href="{{ route('login') }}"
               class="text-base font-semibold text-white px-6 py-2.5 rounded-full border border-white hover:bg-white hover:text-black transition-all">
                Log in
            </a>
            <a href="{{ route('register') }}"
               class="text-base font-semibold text-white px-6 py-2.5 rounded-full bg-(--color-primary) hover:bg-(--color-link) transition-all">
                Sign Up
            </a>
        </div>
    </div>
</nav>
