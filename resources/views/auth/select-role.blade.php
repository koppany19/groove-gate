<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Choose Your Role – GrooveGate</title>
        <link rel="icon" type="image/png" href="/images/heroLogo.png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-(--color-background) text-white min-h-screen flex items-center justify-center">
        <div class="absolute top-0 left-0 right-0 w-full h-96 opacity-5"
             style="background: radial-gradient(ellipse at top, var(--color-primary), transparent);"></div>

        <div class="w-full max-w-lg px-8 relative z-10">

            <div class="text-center mb-10">
                <img src="{{ asset('images/heroLogo.png') }}"
                     class="w-14 h-14 mx-auto mb-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold mb-4"
                     style="background: rgba(59,130,246,0.1); border: 0.5px solid rgba(59,130,246,0.2); color: #60a5fa;">
                    One last step
                </div>
                <h1 class="text-3xl font-black text-white mb-2">
                    Welcome, {{ auth()->user()->name }}!
                </h1>
                <p class="text-gray-400 text-sm">How will you use GrooveGate?</p>
            </div>

            <form action="{{ route('auth.store-role') }}" method="POST" class="space-y-4" x-data="{ selected: '' }">
                @csrf

                <label @click="selected = 'audience'"
                       :class="selected === 'audience' ? 'border-blue-500 bg-blue-500/5' : 'hover:border-gray-500'"
                       class="flex items-center gap-4 rounded-2xl p-5 cursor-pointer border transition-all duration-200"
                       style="background: var(--color-surface); border-color: var(--color-border);">
                    <input type="radio" name="role" value="audience" class="hidden">

                    <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                         :class="selected === 'audience' ? 'bg-blue-500/20' : ''"
                         style="background: rgba(59,130,246,0.1);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>

                    <div class="flex-1">
                        <p class="text-white font-bold mb-0.5">Audience</p>
                        <p class="text-gray-400 text-sm">Discover events, buy tickets and connect with music lovers.</p>
                    </div>

                    <div :class="selected === 'audience' ? 'bg-blue-500 border-blue-500' : 'border-gray-600'"
                         class="w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all">
                        <div x-show="selected === 'audience'" class="w-2 h-2 rounded-full bg-white"></div>
                    </div>
                </label>

                <label @click="selected = 'artist'"
                       :class="selected === 'artist' ? 'border-blue-500 bg-blue-500/5' : 'hover:border-gray-500'"
                       class="flex items-center gap-4 rounded-2xl p-5 cursor-pointer border transition-all duration-200"
                       style="background: var(--color-surface); border-color: var(--color-border);">
                    <input type="radio" name="role" value="artist" class="hidden">

                    <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: rgba(59,130,246,0.1);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                            <path d="M9 18V5l12-2v13"/>
                            <circle cx="6" cy="18" r="3"/>
                            <circle cx="18" cy="16" r="3"/>
                        </svg>
                    </div>

                    <div class="flex-1">
                        <p class="text-white font-bold mb-0.5">Artist</p>
                        <p class="text-gray-400 text-sm">Get booked, manage your profile and grow your fanbase.</p>
                    </div>

                    <div :class="selected === 'artist' ? 'bg-blue-500 border-blue-500' : 'border-gray-600'"
                         class="w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all">
                        <div x-show="selected === 'artist'" class="w-2 h-2 rounded-full bg-white"></div>
                    </div>
                </label>

                <label @click="selected = 'organiser'"
                       :class="selected === 'organiser' ? 'border-blue-500 bg-blue-500/5' : 'hover:border-gray-500'"
                       class="flex items-center gap-4 rounded-2xl p-5 cursor-pointer border transition-all duration-200"
                       style="background: var(--color-surface); border-color: var(--color-border);">
                    <input type="radio" name="role" value="organiser" class="hidden">

                    <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: rgba(59,130,246,0.1);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>

                    <div class="flex-1">
                        <p class="text-white font-bold mb-0.5">Organiser</p>
                        <p class="text-gray-400 text-sm">Create events, book artists and sell tickets effortlessly.</p>
                    </div>

                    <div :class="selected === 'organiser' ? 'bg-blue-500 border-blue-500' : 'border-gray-600'"
                         class="w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all">
                        <div x-show="selected === 'organiser'" class="w-2 h-2 rounded-full bg-white"></div>
                    </div>
                </label>

                @error('role')
                <p class="text-red-400 text-sm flex items-center gap-1">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                    {{ $message }}
                </p>
                @enderror

                <button type="submit"
                        class="w-full py-3.5 rounded-xl text-white font-semibold text-sm
                               hover:opacity-90 transition-all duration-200 flex items-center justify-center gap-2 mt-2"
                        style="background: var(--color-primary);">
                    Continue
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </button>
            </form>
        </div>
    </body>
</html>
