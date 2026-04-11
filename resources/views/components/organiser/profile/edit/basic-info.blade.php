@props(['profile'])

<div class="bg-(--color-card) border border-white/5 rounded-3xl p-8 shadow-xl">
    <div class="flex items-center gap-3 mb-7">
        <div class="w-9 h-9 rounded-xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center shrink-0">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f97316" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
            </svg>
        </div>
        <div>
            <h2 class="text-base font-bold text-white">Basic Information</h2>
            <p class="text-xs text-gray-500 mt-0.5">Name, company and contact details</p>
        </div>
    </div>

    <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <x-auth.form.field
                label="Company Name"
                name="company_name"
                placeholder="e.g. Event Masters Ltd."
                :value="old('company_name', $profile->company_name)"
                :error="$errors->first('company_name')"
            />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <x-auth.form.field
                label="Location"
                name="location"
                placeholder="e.g. Budapest, Hungary"
                :value="old('location', $profile->location)"
                :error="$errors->first('location')"
            />
            <x-auth.form.field
                label="Phone"
                name="phone"
                placeholder="+36 30 123 4567"
                :value="old('phone', $profile->phone)"
                :error="$errors->first('phone')"
            />
        </div>
    </div>
</div>
