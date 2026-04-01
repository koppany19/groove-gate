<?php

namespace App\Livewire;

use App\Models\ArtistAvailability;
use Livewire\Component;
use Carbon\Carbon;

class ArtistAvailabilityCalendar extends Component
{
    public int $year;
    public int $month;
    public array $unavailableDates = [];

    public function mount(): void
    {
        $this->year = now()->year;
        $this->month = now()->month;
        $this->loadDates();
    }

    public function loadDates(): void
    {
        $this->unavailableDates = ArtistAvailability::where('artist_profile_id', auth()->user()->artistProfile->id)
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->where('is_available', false)
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d'))
            ->toArray();
    }

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

    public function render()
    {
        $firstDay = Carbon::create($this->year, $this->month, 1);
        $daysInMonth = $firstDay->daysInMonth;

        $startDay = $firstDay->dayOfWeek;
        $startDay = $startDay === 0 ? 6 : $startDay - 1;

        $today = now()->startOfDay();

        $days = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateObj = Carbon::create($this->year, $this->month, $day);
            $dateString = $dateObj->format('Y-m-d');

            $days[] = [
                'number'        => $day,
                'date'          => $dateString,
                'isUnavailable' => in_array($dateString, $this->unavailableDates),
                'isPast'        => $dateObj->isPast() && !$dateObj->isSameDay($today),
                'isToday'       => $dateObj->isSameDay($today),
            ];
        }

        return view('livewire.artist-availability-calendar', [
            'monthName' => $firstDay->format('F Y'),
            'startDay'  => $startDay,
            'days'      => $days,
        ]);
    }
}
