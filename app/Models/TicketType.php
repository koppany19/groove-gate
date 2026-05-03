<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Ticket;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'quantity',
        'price',
        'sale_start_at',
        'sale_end_at',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'sale_start_at' => 'datetime',
        'sale_end_at' => 'datetime',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function soldTickets(): int
    {
        return $this->tickets()->count();
    }

    public function remainingTickets(): int
    {
        return $this->quantity - $this->soldTickets();
    }

    public function isAvailable(): bool
    {
        if($this->remainingTickets() <= 0) return false;
        if ($this->sale_start_at && now()->lt($this->sale_start_at)) return false;
        if ($this->sale_end_at && now()->gt($this->sale_end_at)) return false;
        return true;
    }
}
