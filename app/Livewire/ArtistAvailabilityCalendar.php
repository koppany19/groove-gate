<?php

namespace App\Livewire;

use App\Models\ArtistAvailability;
use Livewire\Component;
use Carbon\Carbon;

class ArtistAvailabilityCalendar extends Component
{
    // 1. Publikus property-k – ezeket látja a Blade template
    public int $year;
    public int $month;
    public array $unavailableDates = [];

    // 2. mount() – egyszer fut le, amikor a komponens betöltődik
    // Olyan mint egy __construct() de Livewire-ben
    public function mount(): void
    {
        $this->year  = now()->year;
        $this->month = now()->month;
        $this->loadDates();
    }

    // 3. loadDates() – betölti az adott hónap foglalt napjait
    public function loadDates(): void
    {
        $this->unavailableDates = ArtistAvailability::where('artist_profile_id',
            auth()->user()->artistProfile->id
        )
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->where('is_available', false)
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
            ->toArray();
    }

    // 4. toggleDate() – kattintáskor hívódik meg
    // Ha a nap foglalt → felszabadítja
    // Ha a nap szabad → foglalttá teszi
    public function toggleDate(string $date): void
    {
        $profile = auth()->user()->artistProfile;

        $existing = ArtistAvailability::where('artist_profile_id', $profile->id)
            ->where('date', $date)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            ArtistAvailability::create([
                'artist_profile_id' => $profile->id,
                'date'              => $date,
                'is_available'      => false,
            ]);
        }

        $this->loadDates();
    }

    // 5. previousMonth() és nextMonth() – navigáció
    public function previousMonth(): void
    {
        if ($this->month === 1) {
            $this->month = 12;
            $this->year--;
        } else {
            $this->month--;
        }
        $this->loadDates();
    }

    public function nextMonth(): void
    {
        if ($this->month === 12) {
            $this->month = 1;
            $this->year++;
        } else {
            $this->month++;
        }
        $this->loadDates();
    }

    // 6. render() – minden frissítéskor lefut
    public function render()
    {
        // Kiszámítja az adott hónap napjait
        $firstDay    = Carbon::create($this->year, $this->month, 1);
        $daysInMonth = $firstDay->daysInMonth;
        $startDay    = $firstDay->dayOfWeek; // 0=vasárnap, 1=hétfő...

        return view('livewire.artist-availability-calendar', [
            'firstDay'    => $firstDay,
            'daysInMonth' => $daysInMonth,
            'startDay'    => $startDay,
        ]);
    }
}
