<div>
    <div class="flex items-center gap-4 my-6">
        <div class="flex-1 h-px" style="background: var(--color-border);"></div>
        <span class="text-gray-500 text-xs">or continue with</span>
        <div class="flex-1 h-px" style="background: var(--color-border);"></div>
    </div>

    <div class="grid grid-cols-2 gap-3">
        <a href="{{ route('auth.google') }}"
           class="flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-medium text-gray-300 hover:text-white transition-all duration-200"
           style="background: var(--color-surface); border: 0.5px solid var(--color-border);">
            <x-icon name="google" size="16" />
            Google
        </a>

        <button disabled
                class="relative flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-medium text-gray-500 cursor-not-allowed opacity-50 transition-all duration-200 group"
                style="background: var(--color-surface); border: 0.5px solid var(--color-border);">
            <x-icon name="facebook" size="16" />
            Facebook
            <span class="absolute -top-2 -right-2 text-xs px-1.5 py-0.5 rounded-full font-semibold"
                  style="background: var(--color-surface-2); color: var(--color-muted); border: 0.5px solid var(--color-border);">
                Soon
            </span>
        </button>

    </div>

    <p class="text-center text-xs text-gray-500 mt-6">
        By creating an account you agree to our
        <a href="#" class="hover:underline" style="color: var(--color-primary);">Terms of Service</a>
        and
        <a href="#" class="hover:underline" style="color: var(--color-primary);">Privacy Policy</a>
    </p>
</div>
