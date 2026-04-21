<?php

namespace App\Models;

use App\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $fillable = [
        'event_id',
        'artist_profile_id',
        'status',
        'fee',
        'message',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
        'status' => BookingStatus::class,
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function artistProfile(): BelongsTo
    {
        return $this->belongsTo(ArtistProfile::class);
    }
}
