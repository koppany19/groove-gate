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
                        <x-icon name="users" size="22" stroke="#3b82f6" />
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
                        <x-icon name="music" size="22" stroke="#3b82f6" />
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
                        <x-icon name="calendar" size="22" stroke="#3b82f6" />
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
                    <x-icon name="info" size="12" />
                    {{ $message }}
                </p>
                @enderror

                <button type="submit"
                        class="w-full py-3.5 rounded-xl text-white font-semibold text-sm
                               hover:opacity-90 transition-all duration-200 flex items-center justify-center gap-2 mt-2"
                        style="background: var(--color-primary);">
                    Continue
                    <x-icon name="arrow-right" size="16" />
                </button>
            </form>
        </div>
    </body>
</html>
