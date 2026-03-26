<div x-show="role === 'organiser'"
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
            Organiser Details
        </p>
    </div>

    <div class="grid grid-cols-2 gap-3">
        <x-auth.form.field
            label="Company Name"
            name="company_name"
            placeholder="Company name"
            :error="$errors->first('company_name')"
        />
        <x-auth.form.field
            label="Phone"
            name="phone"
            placeholder="+1 234 567 890"
            :error="$errors->first('phone')"
        />
    </div>

    <x-auth.form.field
        label="Location"
        name="location"
        placeholder="City, Country"
        :error="$errors->first('location')"
    />
</div>
