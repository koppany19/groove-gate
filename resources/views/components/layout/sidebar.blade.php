@php
    use Illuminate\Support\Facades\Storage;
    $user = auth()->user();
@endphp

<aside class="w-56 flex-shrink-0 flex flex-col sticky top-0 h-screen bg-(--color-surface) border-r border-(--color-border)">

    <div class="flex items-center gap-3 px-5 py-5 border-b border-(--color-border)">
        <img src="{{ asset('images/heroLogo.png') }}"
             alt="GrooveGate" class="w-9 h-9">
        <div>
            <p class="text-white font-bold text-base leading-none">GrooveGate</p>
            <p class="text-xs font-semibold uppercase tracking-widest mt-0.5
                      {{ $user->isArtist()     ? 'text-(--color-artist)'    :
                         ($user->isOrganiser() ? 'text-(--color-organiser)' :
                                                  'text-(--color-audience)') }}">
                {{ $user->role->value }}
            </p>
        </div>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-1">

        @if($user->isArtist())
            <x-layout.nav-item route="artist.dashboard" icon="dashboard" label="Dashboard" />
            <x-layout.nav-item route="artist.profile.show" icon="user" label="Profile" />
            <x-layout.nav-item route="artist.bookings" icon="bookings" label="Bookings" />
            <x-layout.nav-item route="artist.inbox" icon="inbox" label="Inbox">
                @if($user->unreadNotifications->count() > 0)
                    <span class="ml-auto text-xs font-bold px-2 py-0.5 rounded-full bg-blue-500 text-white">
                        {{ $user->unreadNotifications->count() }}
                    </span>
                @endif
            </x-layout.nav-item>

        @elseif($user->isOrganiser())
            <x-layout.nav-item route="organiser.dashboard" icon="dashboard" label="Dashboard" />
            <x-layout.nav-item route="organiser.events.index" icon="events" label="Events" />
            <x-layout.nav-item route="organiser.artists.index" icon="user" label="Artists" />
            <x-layout.nav-item route="organiser.inbox" icon="inbox" label="Inbox">
                @if($user->unreadNotifications->count() > 0)
                    <span class="ml-auto text-xs font-bold px-2 py-0.5 rounded-full bg-blue-500 text-white">
                        {{ $user->unreadNotifications->count() }}
                    </span>
                @endif
            </x-layout.nav-item>
            <x-layout.nav-item route="organiser.profile" icon="settings" label="Profile" />

        @else
            <x-layout.nav-item route="audience.dashboard" icon="dashboard" label="Dashboard" />
            <x-layout.nav-item route="audience.events.index" icon="events" label="Events" />
        @endif

    </nav>

    <div class="px-4 py-4 border-t border-(--color-border)">
        <div class="flex items-center gap-3">
            @if($user->avatar)
                <img src="{{ str_starts_with($user->avatar, 'http')
                    ? $user->avatar
                    : Storage::url($user->avatar) }}"
                     alt="{{ $user->name }}"
                     class="w-8 h-8 rounded-full object-cover flex-shrink-0
                ring-2 ring-(--color-primary)">
            @else
                <div class="w-8 h-8 rounded-full flex items-center justify-center
                text-xs font-bold flex-shrink-0
                bg-blue-500/15 ring-2 ring-(--color-primary)
                text-(--color-primary)">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            <div class="flex-1 min-w-0">
                <p class="text-white text-xs font-semibold truncate">
                    {{ $user->name }}
                </p>
                <p class="text-xs text-(--color-muted-2) truncate">
                    {{ ucfirst($user->role->value) }}
                </p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        title="Logout"
                        class="text-(--color-muted) hover:text-white transition-colors">
                    <svg width="15" height="15" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>
