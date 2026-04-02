@props(['profile'])

<div class="bg-(--color-edit-background) border border-white/5 rounded-3xl p-6 shadow-xl">

    <div class="flex items-center justify-between mb-5">
        <h2 class="text-lg font-bold text-white flex items-center gap-2">
            <div class="w-1 h-5 bg-blue-500 rounded-full"></div>
            Add Track
        </h2>
        <span class="text-xs px-2.5 py-1 rounded-full font-semibold
                     {{ $profile->tracks()->count() >= 5
                         ? 'bg-red-500/10 text-red-400 border border-red-500/20'
                         : 'bg-blue-500/10 text-blue-400 border border-blue-500/20' }}">
            {{ $profile->tracks()->count() }}/5
        </span>
    </div>

    @if($profile->tracks()->count() < 5)
        <form action="{{ route('artist.tracks.store') }}" method="POST" class="space-y-4">
            @csrf

            <x-auth.form.field
                label="Track Title"
                name="title"
                placeholder="e.g. Midnight Pulse"
                :error="$errors->first('title')"
            />

            <x-auth.form.field
                label="URL"
                name="url"
                placeholder="https://soundcloud.com/..."
                :error="$errors->first('url')"
            />

            @error('tracks')
            <p class="text-red-400 text-xs">{{ $message }}</p>
            @enderror

            <button type="submit"
                    class="w-full py-3 rounded-xl text-white font-semibold text-sm
                           bg-blue-500 hover:opacity-90 transition-all
                           flex items-center justify-center gap-2">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Add Track
            </button>
        </form>
    @else
        <div class="text-center py-4">
            <p class="text-gray-500 text-sm">Maximum 5 tracks reached.</p>
            <p class="text-gray-600 text-xs mt-1">Delete a track to add a new one.</p>
        </div>
    @endif

</div>
