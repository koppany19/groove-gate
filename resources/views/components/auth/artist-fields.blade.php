<div x-show="role === 'artist'"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 -translate-y-3"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 -translate-y-3"
     class="space-y-4 rounded-xl p-4"
     style="background: var(--color-surface); border-left: 3px solid var(--color-primary);">

    <div class="flex items-center gap-2">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">
            Artist Details
        </p>
    </div>

    <div class="grid grid-cols-2 gap-3">
        <x-auth.form.field
            label="Stage Name"
            name="stage_name"
            placeholder="Your stage name"
            :error="$errors->first('stage_name')"
        />
        <x-auth.form.field
            label="Location"
            name="location"
            placeholder="City, Country"
            :error="$errors->first('location')"
        />
    </div>

    <div class="space-y-2">
        <label class="text-sm font-medium text-gray-300">Artist Type</label>
        <div class="grid grid-cols-2 gap-3">
            <label class="flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer
                          transition-all hover:border-blue-500"
                   style="background: var(--color-background); border: 0.5px solid var(--color-border);">
                <input type="radio" name="artist_type" value="live" class="accent-blue-500">
                <span class="text-sm text-gray-300 flex items-center gap-2">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <path d="M9 18V5l12-2v13"/>
                        <circle cx="6" cy="18" r="3"/>
                        <circle cx="18" cy="16" r="3"/>
                    </svg>
                    Live
                </span>
            </label>
            <label class="flex items-center gap-3 px-4 py-3 rounded-xl cursor-pointer
                          transition-all hover:border-blue-500"
                   style="background: var(--color-background); border: 0.5px solid var(--color-border);">
                <input type="radio" name="artist_type" value="dj" class="accent-blue-500">
                <span class="text-sm text-gray-300 flex items-center gap-2">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"/>
                        <path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/>
                    </svg>
                    DJ
                </span>
            </label>
        </div>
        @error('artist_type')
        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="space-y-2" x-data="{ otherGenre: false }">
        <label class="text-sm font-medium text-gray-300">Genres</label>
        <div class="grid grid-cols-3 gap-2">
            @foreach(\App\GenreType::cases() as $genre)
                @if($genre !== \App\GenreType::OTHER)
                    <label class="flex items-center gap-2 text-xs text-gray-400
                                  cursor-pointer hover:text-white transition-colors">
                        <input type="checkbox"
                               name="genre[]"
                               value="{{ $genre->value }}"
                               class="accent-blue-500 rounded">
                        {{ $genre->label() }}
                    </label>
                @endif
            @endforeach
            <label class="flex items-center gap-2 text-xs text-gray-400
                          cursor-pointer hover:text-white transition-colors">
                <input type="checkbox"
                       name="genre[]"
                       value="other"
                       class="accent-blue-500 rounded"
                       @change="otherGenre = $event.target.checked">
                Other
            </label>
        </div>

        <div x-show="otherGenre"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="mt-2">
            <x-auth.form.field
                name="genre_other"
                placeholder="Enter your genre..."
                :error="$errors->first('genre_other')"
            />
        </div>
    </div>

    <div class="grid grid-cols-3 gap-3 mt-6">
        <x-auth.form.field
            label="Min (€)"
            name="price_min"
            type="number"
            placeholder="0"
            :error="$errors->first('price_min')"
        />
        <x-auth.form.field
            label="Max (€)"
            name="price_max"
            type="number"
            placeholder="0"
            :error="$errors->first('price_max')"
        />
        <x-auth.form.field
            label="Duration(min)"
            name="duration"
            type="number"
            placeholder="90"
            :error="$errors->first('duration')"
        />
    </div>
</div>
