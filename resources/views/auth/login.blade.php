<x-auth.layout title="Login" bodyClass="overflow-hidden">

    <x-slot:panel>
        <div class="rounded-2xl p-6 transition-all duration-300 hover:bg-white/10"
             style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(12px);">
            <p class="text-gray-300 text-sm italic leading-relaxed mb-4">
                "GrooveGate completely transformed how we book artists for our festivals. Incredible platform!"
            </p>
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold shadow-lg"
                     style="background: linear-gradient(135deg, var(--color-primary), #60a5fa);">P</div>
                <div>
                    <p class="text-white text-sm font-semibold tracking-wide">Peter Kovacs</p>
                    <p class="text-gray-400 text-xs uppercase tracking-wider mt-0.5">Festival Organiser</p>
                </div>
            </div>
        </div>
    </x-slot:panel>

    <div class="mb-10 text-center lg:text-left">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold tracking-wide uppercase mb-6 shadow-sm"
             style="background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2); color: #93c5fd;">
            Welcome back
        </div>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-3 tracking-tight leading-tight">
            Sign in to<br>your account
        </h1>
        <p class="text-gray-400 text-sm">
            Don't have an account?
            <a href="{{ route('register') }}"
               class="font-semibold hover:text-white transition-colors duration-200 ml-1"
               style="color: var(--color-primary);">
                Sign up for free
            </a>
        </p>
    </div>

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        <x-auth.form.field
            label="Email address"
            name="email"
            type="email"
            placeholder="your@email.com"
            :error="$errors->first('email')"
        />

        <div class="space-y-2">
            <div class="flex items-center justify-between">
                <label class="text-sm font-semibold text-gray-300">Password</label>
                <a href="{{ route('password.request') }}"
                   class="text-xs font-medium hover:text-white transition-colors duration-200"
                   style="color: var(--color-primary);">
                    Forgot password?
                </a>
            </div>
            <input type="password"
                   name="password"
                   placeholder="••••••••"
                   class="w-full px-5 py-3.5 rounded-xl text-white text-sm outline-none
                          transition-all duration-200 placeholder-gray-600 focus:-translate-y-0.5 shadow-sm
                          {{ $errors->first('password') ? 'ring-2 ring-red-500/50' : 'focus:ring-2 focus:ring-blue-500/50' }}"
                   style="background: rgba(0,0,0,0.2); border: 1px solid var(--color-border);">
            @error('password')
                <p class="text-red-400 text-xs flex items-center gap-1.5 mt-2 font-medium">
                    <x-icon name="info" size="14" />
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button type="submit"
                class="w-full py-4 rounded-xl text-white font-bold text-sm tracking-wide
                       hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/20
                       transition-all duration-300 ease-out flex items-center justify-center gap-2 mt-4"
                style="background: linear-gradient(to right, var(--color-primary), #3b82f6);">
            Sign in
            <x-icon name="arrow-right" size="18" stroke-width="2.5" />
        </button>
    </form>

    <x-auth.social-auth />

</x-auth.layout>
