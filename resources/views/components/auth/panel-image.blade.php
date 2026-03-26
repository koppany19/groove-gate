@props(['image', 'title', 'subtitle'])

<div class="relative hidden lg:flex flex-col w-full h-full overflow-hidden group bg-black">

    <img src="{{ $image }}"
         alt="GrooveGate Background"
         class="absolute inset-0 w-full h-full object-cover transition-transform duration-[20s] ease-out group-hover:scale-110 will-change-transform">

    <div class="absolute inset-0"
         style="background: linear-gradient(145deg,
            rgba(10, 10, 15, 0.95) 0%,
            rgba(10, 10, 15, 0.6) 50%,
            rgba(59, 130, 246, 0.25) 100%);">
    </div>

    <div class="absolute inset-0 shadow-[inset_0_0_150px_rgba(0,0,0,0.8)] pointer-events-none"></div>

    <div class="absolute top-[-10%] left-[-10%] w-[40rem] h-[40rem] rounded-full pointer-events-none mix-blend-screen transition-opacity duration-700 opacity-20 group-hover:opacity-30"
         style="background: radial-gradient(circle closest-side, rgba(59, 130, 246, 0.4) 0%, transparent 100%);"></div>

    <div class="absolute bottom-[-10%] right-[-10%] w-[30rem] h-[30rem] rounded-full pointer-events-none mix-blend-screen transition-opacity duration-700 opacity-15 group-hover:opacity-25"
         style="background: radial-gradient(circle closest-side, rgba(139, 92, 246, 0.4) 0%, transparent 100%);"></div>

    <div class="relative z-10 flex flex-col justify-between h-full p-12 lg:p-16">
        <div class="flex items-center gap-4 transform transition-transform duration-500 hover:translate-x-2 w-max">
            <div class="relative flex items-center justify-center"
                 style="background: rgba(255,255,255,0.05); backdrop-filter: blur(8px);">
                <img src="{{ asset('images/heroLogo.png') }}" alt="GrooveGate" class="w-8 h-8 drop-shadow-lg">
            </div>
            <span class="text-white font-extrabold text-2xl tracking-tight drop-shadow-md">GrooveGate</span>
        </div>

        <div class="max-w-xl">
            <div class="mb-10">
                <h2 class="text-5xl lg:text-6xl font-black text-white mb-6 tracking-tight leading-tight drop-shadow-xl">
                    {{ $title }}
                </h2>
                <p class="text-lg text-gray-300 font-medium leading-relaxed drop-shadow-md max-w-md">
                    {{ $subtitle }}
                </p>
            </div>

            <div>
                {{ $slot }}
            </div>
        </div>

    </div>

    <div class="absolute inset-0 opacity-20 pointer-events-none mix-blend-overlay"
         style="background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyBAMAAADsEZWCAAAAGFBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/c+9SAAAACHRSTlMAwP/A/8D/wP8/T9zAAAAAWUlEQVR42mNgwA2EBBhQghAhQQaQIFaEIBEQwIoQJAICWBEipMCAEIQKDEgBEwZIAQNGkAEhyAERZIAIYiAEeSACESiCEFSCuAJKEJdAEcQlUARxCRRBXAIAV1Yu1b2sK/4AAAAASUVORK5CYII='); background-repeat: repeat;">
    </div>

</div>
