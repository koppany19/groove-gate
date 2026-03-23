@php use App\GenreType; @endphp
<x-layout>
    <x-form title="Create an account" description="Join GrooveGate today.">
        <form action="/register" method="POST" class="mt-10 space-y-5"
              x-data="{ role: '', otherGenre: false }">
            @csrf

            {{-- Alap mezők --}}
            <x-form.field name="name" label="Name"/>
            <x-form.field name="email" label="Email" type="email"/>
            <x-form.field name="password" label="Password" type="password"/>
            <x-form.field name="password_confirmation" label="Confirm Password" type="password"/>

            {{-- Role választó --}}
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-300">I am a...</label>
                <div class="grid grid-cols-3 gap-3">
                    <button type="button" @click="role = 'audience'"
                            :class="role === 'audience'
                                ? 'border-white bg-white/10 text-white'
                                : 'border-gray-700 text-gray-400 hover:border-gray-500'"
                            class="border rounded-lg px-4 py-3 text-sm font-medium transition-all duration-150">
                        🎟️ Audience
                    </button>
                    <button type="button" @click="role = 'artist'"
                            :class="role === 'artist'
                                ? 'border-white bg-white/10 text-white'
                                : 'border-gray-700 text-gray-400 hover:border-gray-500'"
                            class="border rounded-lg px-4 py-3 text-sm font-medium transition-all duration-150">
                        🎵 Artist
                    </button>
                    <button type="button" @click="role = 'organiser'"
                            :class="role === 'organiser'
                                ? 'border-white bg-white/10 text-white'
                                : 'border-gray-700 text-gray-400 hover:border-gray-500'"
                            class="border rounded-lg px-4 py-3 text-sm font-medium transition-all duration-150">
                        🎪 Organiser
                    </button>
                </div>
                <input type="hidden" name="role" :value="role">
                @error('role')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Artist mezők --}}
            <div x-show="role === 'artist'"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="space-y-5 border border-gray-800 rounded-xl p-5 bg-white/5">

                <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest">
                    Artist Details
                </p>

                <x-form.field name="stage_name" label="Stage Name"/>

                {{-- Artist Type --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300">Artist Type</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label
                            class="flex items-center gap-3 border border-gray-700 rounded-lg px-4 py-3 cursor-pointer hover:border-gray-500 transition-all">
                            <input type="radio" name="artist_type" value="live" class="accent-white">
                            <span class="text-sm text-gray-300">🎸 Live</span>
                        </label>
                        <label
                            class="flex items-center gap-3 border border-gray-700 rounded-lg px-4 py-3 cursor-pointer hover:border-gray-500 transition-all">
                            <input type="radio" name="artist_type" value="dj" class="accent-white">
                            <span class="text-sm text-gray-300">🎧 DJ</span>
                        </label>
                    </div>
                    @error('artist_type')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Genres --}}
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300">Genres</label>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach(GenreType::cases() as $genre)
                            @if($genre !== GenreType::OTHER)
                                <label
                                    class="flex items-center gap-2 text-sm text-gray-400 cursor-pointer hover:text-white transition-colors">
                                    <input type="checkbox"
                                           name="genre[]"
                                           value="{{ $genre->value }}"
                                           class="accent-white rounded">
                                    {{ $genre->label() }}
                                </label>
                            @endif
                        @endforeach

                        {{-- Other --}}
                        <label
                            class="flex items-center gap-2 text-sm text-gray-400 cursor-pointer hover:text-white transition-colors">
                            <input type="checkbox"
                                   name="genre[]"
                                   value="other"
                                   class="accent-white rounded"
                                   @change="otherGenre = $event.target.checked">
                            Other
                        </label>
                    </div>

                    {{-- Custom genre input --}}
                    <div x-show="otherGenre" x-transition class="mt-2">
                        <input type="text"
                               name="genre_other"
                               class="input w-full"
                               placeholder="Enter your genre...">
                    </div>

                    @error('genre')
                    <p class="text-red-400 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Price --}}
                <div class="grid grid-cols-2 gap-3">
                    <x-form.field name="price_min" label="Price Min (€)" type="number"/>
                    <x-form.field name="price_max" label="Price Max (€)" type="number"/>
                </div>

                <x-form.field name="duration" label="Duration (minutes)" type="number"/>
                <x-form.field name="location" label="Location"/>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300">Bio</label>
                    <textarea name="bio"
                              class="input w-full h-24 resize-none"
                              placeholder="Tell us about yourself..."></textarea>
                </div>
            </div>

            {{-- Organiser mezők --}}
            <div x-show="role === 'organiser'"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="space-y-5 border border-gray-800 rounded-xl p-5 bg-white/5">

                <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest">
                    Organiser Details
                </p>

                <x-form.field name="company_name" label="Company Name"/>
                <x-form.field name="phone" label="Phone"/>
                <x-form.field name="location" label="Location"/>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300">Description</label>
                    <textarea name="description"
                              class="input w-full h-24 resize-none"
                              placeholder="Tell us about your organisation..."></textarea>
                </div>
            </div>


            <button type="submit"
                    class="w-full h-11 bg-white text-black font-semibold rounded-lg text-sm
                           hover:bg-gray-100 transition-colors duration-150 mt-2">
                Create Account
            </button>

            <p class="text-center text-sm text-gray-500">
                Already have an account?
                <a href="/login" class="text-white hover:underline">Login</a>
            </p>
        </form>

        <div class="flex items-center gap-4 my-6">
            <div class="flex-1 h-px" style="background: var(--color-border);"></div>
            <span class="text-gray-500 text-xs">or continue with</span>
            <div class="flex-1 h-px" style="background: var(--color-border);"></div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('auth.google') }}"
               class="flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-medium
              text-gray-300 hover:text-white transition-all duration-200"
               style="background: var(--color-surface); border: 0.5px solid var(--color-border);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Google
            </a>
            <button disabled
                    class="flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-medium
                   text-gray-500 cursor-not-allowed opacity-50"
                    style="background: var(--color-surface); border: 0.5px solid var(--color-border);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Facebook
            </button>
        </div>
    </x-form>
</x-layout>
