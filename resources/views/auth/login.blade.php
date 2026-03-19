<x-layout>
    <x-form title="Welcome back" description="Login to your GrooveGate account.">
        <form action="/login" method="POST" class="mt-10 space-y-5">
            @csrf

            <x-form.field name="email" label="Email" type="email" />
            <x-form.field name="password" label="Password" type="password" />

            @error('email')
            <div class="bg-red-500/10 border border-red-500/30 rounded-lg px-4 py-3">
                <p class="text-red-400 text-sm">{{ $message }}</p>
            </div>
            @enderror

            <button type="submit"
                    class="w-full h-11 bg-white text-black font-semibold rounded-lg text-sm
                           hover:bg-gray-100 transition-colors duration-150 mt-2">
                Login
            </button>

            <p class="text-center text-sm text-gray-500">
                Don't have an account?
                <a href="/register" class="text-white hover:underline">Register</a>
            </p>

        </form>
    </x-form>
</x-layout>
