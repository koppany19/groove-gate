<?php

namespace App\Models;

use App\BookingStatus;
use App\EventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
      'organiser_profile_id',
      'name',
      'description',
      'location',
      'start_date',
      'end_date',
      'cover_image',
      'capacity',
      'has_seats',
      'status',
      'base_price',
      'is_dynamic_price',
      'sale_end_at',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'sale_end_at' => 'datetime',
        'capacity' => 'integer',
        'base_price' => 'float',
        'has_seats' => 'boolean',
        'is_dynamic_price' => 'boolean',
        'status' => EventStatus::class,
    ];

    public function organiserProfile(): BelongsTo
    {
        return $this->belongsTo(OrganiserProfile::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function confirmedBookings(): HasMany
    {
        return $this->hasMany(Booking::class)->where('status', '=', BookingStatus::ACCEPTED->value);
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }

    public function ticketTypes(): HasMany
    {
        return $this->hasMany(TicketType::class);
    }

    public function tickets(): HasManyThrough
    {
        return $this->hasManyThrough(Ticket::class, TicketType::class, 'event_id', 'ticket_type_id', 'id', 'id');
    }

    public function lineup(): HasMany
    {
        return $this->HasMany(EventLineup::class);
    }

    public function calculatePrice(): float
    {
        if (!$this->is_dynamic_price) {
            return (float) $this->base_price;
        }

        $daysUntil = now()->diffInDays($this->start_date, false);

        if ($daysUntil < 0) {
            return (float) $this->base_price;
        }

        $totalTickets = $this->ticketTypes()->sum('quantity');
        $soldTickets  = $this->tickets()->count();
        $occupancy = $totalTickets > 0 ? $soldTickets / $totalTickets : 0;
        $daysFactor      = 1 - (1 / ($daysUntil + 1));
        $occupancyFactor = $occupancy;
        $multiplier = 1 + (0.5 * (1 - $daysFactor)) + (0.5 * $occupancyFactor);
        $price = $this->base_price * $multiplier;

        return round(max($price, $this->base_price), 2);
    }
    public function isSoldOut(): bool
    {
        $totalTickets = $this->ticketTypes()->sum('quantity');
        $soldTickets  = $this->tickets()->count();

        if($totalTickets === 0 ) return false;

        return $soldTickets >= $totalTickets;
    }

    public function availableSeats(): int
    {
        $totalTickets = $this->ticketTypes()->sum('quantity');

        if ($totalTickets === 0) {
            return $this->capacity ?? 0;
        }

        return max(0, $totalTickets - $this->tickets()->count());
    }

    public function isOnSale(): bool
    {
        if (!$this->sale_end_at) {
            return true;
        }

        return now()->lt($this->sale_end_at);
    }

    public function generateSeats(): void
    {
        if($this->seats()->count() > 0) {
            return;
        }

        $rows = range('A', 'Z');
        $seatsPerRow = 10;
        $totalRows = (int) ceil($this->capacity / $seatsPerRow);

        for ($i = 0; $i < $totalRows; $i++) {
            $row = $rows[$i];
            $thisRow = min($seatsPerRow, $this->capacity - ($i * $seatsPerRow));

            for ($j = 1; $j <= $thisRow; $j++) {
                $this->seats()->create([
                    'seat_number' => $row . $j,
                    'is_reserved' => false,
                ]);
            }
        }
    }

}
