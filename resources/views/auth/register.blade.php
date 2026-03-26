<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register – GrooveGate</title>
    <link rel="icon" type="image/png" href="/images/heroLogo.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="bg-(--color-background) text-white min-h-screen antialiased">

<div class="min-h-screen flex selection:bg-blue-500/30" x-data="{ page: 'register' }" id="auth-wrapper">

    <div class="hidden lg:block w-1/2 flex-shrink-0 sticky top-0 h-screen"
         :class="page === 'register' ? 'order-1' : 'order-2'">

        <x-auth.panel-image
            image="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?w=1200"
            title="Join The Movement"
            subtitle="Create your account and start your journey with GrooveGate today.">

            <div class="grid grid-cols-3 gap-5">
                <div class="rounded-2xl p-5 text-center transition-transform duration-300 hover:-translate-y-1"
                     style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(12px);">
                    <div class="text-3xl font-black text-white mb-1 drop-shadow-md">500+</div>
                    <div class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Artists</div>
                </div>
                <div class="rounded-2xl p-5 text-center transition-transform duration-300 hover:-translate-y-1"
                     style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(12px);">
                    <div class="text-3xl font-black text-white mb-1 drop-shadow-md">200+</div>
                    <div class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Events</div>
                </div>
                <div class="rounded-2xl p-5 text-center transition-transform duration-300 hover:-translate-y-1"
                     style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(12px);">
                    <div class="text-3xl font-black text-white mb-1 drop-shadow-md">50+</div>
                    <div class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Venues</div>
                </div>
            </div>

        </x-auth.panel-image>

    </div>

    <div class="flex items-center justify-center w-full lg:w-1/2 px-6 py-12 min-h-screen overflow-y-auto relative bg-(--color-background)"
         :class="page === 'register' ? 'order-2' : 'order-1'"
    >

        <div class="absolute top-0 right-0 w-[30rem] h-[30rem] rounded-full opacity-20 pointer-events-none mix-blend-screen"
             style="background: radial-gradient(circle, var(--color-primary) 0%, transparent 70%); filter: blur(100px); transform: translate(30%, -30%);"></div>

        <div class="w-full max-w-md relative z-10 bg-white/[0.02] border border-white/[0.05] p-8 sm:p-10 rounded-[2rem] shadow-2xl backdrop-blur-xl my-auto">

            <div class="flex items-center justify-center gap-3 mb-10 lg:hidden">
                <img src="{{ asset('images/heroLogo.png') }}" alt="GrooveGate" class="w-10 h-10 drop-shadow-lg">
                <span class="text-white font-extrabold text-2xl tracking-tight">GrooveGate</span>
            </div>

            <div class="mb-10 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold tracking-wide uppercase mb-6 shadow-sm"
                     style="background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2); color: #93c5fd;">
                    Get started for free
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-3 tracking-tight leading-tight">
                    Create your<br>account
                </h1>
                <p class="text-gray-400 text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}"
                       class="font-semibold hover:text-white transition-colors duration-200 ml-1"
                       style="color: var(--color-primary);">
                        Sign in
                    </a>
                </p>
            </div>

            <form action="{{ route('register') }}" method="POST"
                  class="space-y-6"
                  x-data="{ role: '' }">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-auth.form.field
                        label="Name"
                        name="name"
                        placeholder="Your name"
                        :error="$errors->first('name')"
                    />
                    <x-auth.form.field
                        label="Email"
                        name="email"
                        type="email"
                        placeholder="your@email.com"
                        :error="$errors->first('email')"
                    />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-auth.form.field
                        label="Password"
                        name="password"
                        type="password"
                        placeholder="Min. 8 chars"
                        :error="$errors->first('password')"
                    />
                    <x-auth.form.field
                        label="Confirm"
                        name="password_confirmation"
                        type="password"
                        placeholder="••••••••"
                    />
                </div>

                <hr class="border-white/5">

                <x-auth.role-selector />

                <x-auth.artist-fields />

                <x-auth.organiser-fields />

                <button type="submit"
                        class="w-full py-4 rounded-xl text-white font-bold text-sm tracking-wide
                               hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/20
                               transition-all duration-300 ease-out flex items-center justify-center gap-2 mt-6"
                        style="background: linear-gradient(to right, var(--color-primary), #3b82f6);">
                    Create Account
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5">
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
