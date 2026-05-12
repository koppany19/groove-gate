@props([
    'title',
    'panelImage'    => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=1200',
    'panelTitle'    => 'Feel The Groove',
    'panelSubtitle' => 'Connecting fans, artists, and organizers for the ultimate festival experience.',
    'bodyClass'     => '',
])

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }} – GrooveGate</title>
        <link rel="icon" type="image/png" href="/images/heroLogo.png">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-(--color-background) text-white min-h-screen antialiased {{ $bodyClass }}">

        <div class="min-h-screen flex selection:bg-blue-500/30">

            <div class="relative hidden lg:flex flex-col w-1/2 flex-shrink-0">
                <x-auth.panel-image
                    :image="$panelImage"
                    :title="$panelTitle"
                    :subtitle="$panelSubtitle">
                    {{ $panel ?? '' }}
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

                    {{ $slot }}

                </div>
            </div>
        </div>
    </body>
</html>
