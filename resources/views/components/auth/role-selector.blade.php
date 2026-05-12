<div class="space-y-2">
    <label class="text-sm font-medium text-gray-300">I am a...</label>

    <div class="grid grid-cols-3 gap-3">

        <x-auth.form.role-card value="audience" label="Audience">
            <x-icon name="users" size="22" />
        </x-auth.form.role-card>

        <x-auth.form.role-card value="artist" label="Artist">
            <x-icon name="music" size="22" />
        </x-auth.form.role-card>

        <x-auth.form.role-card value="organiser" label="Organiser">
            <x-icon name="calendar" size="22" />
        </x-auth.form.role-card>
    </div>

    <input type="hidden" name="role" :value="role">

    @error('role')
    <p class="text-red-400 text-xs flex items-center gap-1 mt-1">
        <x-icon name="info" size="12" />
        {{ $message }}
    </p>
    @enderror
</div>
