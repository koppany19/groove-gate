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
    </x-form>
</x-layout>
