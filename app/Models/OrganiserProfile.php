<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class OrganiserProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'full_name',
        'company_name',
        'description',
        'phone',
        'location',
        'cover_image',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function bookings(): HasManyThrough
    {
        return $this->hasManyThrough(Booking::class, Event::class, 'organiser_profile_id',  'event_id', 'id', 'id');
    }
}
