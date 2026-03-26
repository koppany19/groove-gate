<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login – GrooveGate</title>
    <link rel="icon" type="image/png" href="/images/heroLogo.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-(--color-background) text-white min-h-screen overflow-hidden antialiased">

<div class="min-h-screen flex selection:bg-blue-500/30">
    <div class="relative hidden lg:flex flex-col w-1/2 flex-shrink-0">
        <x-auth.panel-image
            image="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=1200"
            title="Feel The Groove"
            subtitle="Connecting fans, artists, and organizers for the ultimate festival experience.">

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

        </x-auth.panel-image>
    </div>


    <div class="flex items-center justify-center w-full lg:w-1/2 px-6 py-12 relative bg-(--color-background)">

        <div class="absolute top-1/4 right-0 w-[30rem] h-[30rem] rounded-full opacity-20 pointer-events-none mix-blend-screen"
             style="background: radial-gradient(circle, var(--color-primary) 0%, transparent 70%); filter: blur(100px); transform: translate(30%, -30%);"></div>
        <div class="absolute bottom-1/4 left-0 w-[20rem] h-[20rem] rounded-full opacity-10 pointer-events-none mix-blend-screen"
             style="background: radial-gradient(circle, #8b5cf6 0%, transparent 70%); filter: blur(80px); transform: translate(-30%, 30%);"></div>

        <div class="w-full max-w-md relative z-10 bg-white/[0.02] border border-white/[0.05] p-8 sm:p-10 rounded-[2rem] shadow-2xl backdrop-blur-xl">
            <div class="flex items-center justify-center gap-3 mb-10 lg:hidden">
                <img src="{{ asset('images/heroLogo.png') }}" alt="GrooveGate" class="w-10 h-10 drop-shadow-lg">
                <span class="text-white font-extrabold text-2xl tracking-tight">GrooveGate</span>
            </div>

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
                        <a href="#"
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
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                        </svg>
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
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5" class="transition-transform group-hover:translate-x-1">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </button>
            </form>

            <x-auth.social-auth />

        </div>
    </div>

</div>

</body>
</html>
