<nav class="border-b border-border px-5">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <div>
            <a href="">
                <img src="/images/heroLogo.png" alt="" width="50">
            </a>
        </div>

        <div class="flex gap-x-5 items-center">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-foreground/80 hover:text-foreground transition-colors">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="/register" >Register</a>
            @endguest
        </div>
    </div>
</nav>
