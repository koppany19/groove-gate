<x-auth.layout title="Forgot Password">

    <div class="mb-10 text-center lg:text-left">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold tracking-wide uppercase mb-6"
             style="background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2); color: #93c5fd;">
            Password Reset
        </div>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-3 tracking-tight leading-tight">
            Forgot your<br>password?
        </h1>
        <p class="text-gray-400 text-sm">
            No worries! Enter your email and we'll send you a reset link.
        </p>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 px-4 py-3 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 mb-6">
            <x-icon name="check" size="16" stroke="#10b981" />
            <p class="text-emerald-400 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <x-auth.form.field
            label="Email address"
            name="email"
            type="email"
            placeholder="your@email.com"
            :error="$errors->first('email')"
        />

        <button type="submit"
                class="w-full py-4 rounded-xl text-white font-bold text-sm tracking-wide
                       hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/20
                       transition-all duration-300 flex items-center justify-center gap-2 mt-4"
                style="background: linear-gradient(to right, var(--color-primary), #3b82f6);">
            Send Reset Link
            <x-icon name="arrow-right" size="18" stroke-width="2.5" />
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}"
           class="text-sm text-gray-500 hover:text-white transition-colors flex items-center justify-center gap-2">
            <x-icon name="arrow-left" size="14" />
            Back to login
        </a>
    </div>

</x-auth.layout>
