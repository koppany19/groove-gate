<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Security-Policy"
              content="img-src 'self' https://lh3.googleusercontent.com data:;">
        <title>GrooveGate</title>
        <link rel="icon" type="image/png" href="/images/heroLogo.png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-(--color-background) text-white min-h-screen">

        <div class="flex min-h-screen">

            <x-layout.sidebar />

            <main class="flex-1 p-8 overflow-y-auto">

                @session('success')
                <div x-data="{ show: true }"
                     x-init="setTimeout(() => show = false, 3000)"
                     x-show="show"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-4"
                     class="fixed bottom-6 right-6 z-50 flex items-center gap-3
                                bg-zinc-900 border border-zinc-700 text-white
                                px-5 py-3 rounded-xl shadow-xl">
                    <div class="flex items-center justify-center w-7 h-7 rounded-full bg-green-500/20">
                        <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">{{ $value }}</p>
                    <button @click="show = false"
                            class="ml-2 text-zinc-500 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endsession

                {{ $slot }}

            </main>

        </div>

        @livewireScripts
    </body>
</html>
