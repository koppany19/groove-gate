@props(['profile'])

<div class="bg-(--color-edit-background) border border-white/5 rounded-3xl p-8 shadow-xl"
     x-data="{ otherGenre: {{ in_array('other', $profile->genre ?? []) ? 'true' : 'false' }} }">

    <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
        <div class="w-1 h-5 bg-blue-500 rounded-full"></div>
        Genres
    </h2>

    <div class="grid grid-cols-3 md:grid-cols-4 gap-3">
        @foreach(\App\GenreType::cases() as $genre)
            @if($genre !== \App\GenreType::OTHER)
                <label class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl
                              cursor-pointer transition-all border text-sm
                              {{ in_array($genre->value, old('genre', $profile->genre ?? []))
                                  ? 'border-blue-500/50 bg-blue-500/10 text-blue-400'
                                  : 'border-white/10 text-gray-400 hover:border-white/20 hover:text-white' }}">
                    <input type="checkbox"
                           name="genre[]"
                           value="{{ $genre->value }}"
                           class="accent-blue-500"
                        {{ in_array($genre->value, old('genre', $profile->genre ?? [])) ? 'checked' : '' }}>
                    {{ $genre->label() }}
                </label>
            @endif
        @endforeach

        <label class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl
                      cursor-pointer transition-all border text-sm
                      {{ in_array('other', old('genre', $profile->genre ?? []))
                          ? 'border-blue-500/50 bg-blue-500/10 text-blue-400'
                          : 'border-white/10 text-gray-400 hover:border-white/20' }}">
            <input type="checkbox"
                   name="genre[]"
                   value="other"
                   class="accent-blue-500"
                   @change="otherGenre = $event.target.checked"
                {{ in_array('other', old('genre', $profile->genre ?? [])) ? 'checked' : '' }}>
            Other
        </label>
    </div>

    <div x-show="otherGenre"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="mt-4">
        <x-auth.form.field
            name="genre_other"
            placeholder="Enter your genre..."
            :value="old('genre_other', $profile->genre_other)"
            :error="$errors->first('genre_other')"
        />
    </div>
</div>
