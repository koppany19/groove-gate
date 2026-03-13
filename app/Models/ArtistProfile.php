<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtistProfile extends Model
{
    protected $fillable = [
        'user_id',
        'stage_name',
        'bio',
        'press_text',
        'genre',
        'price_min',
        'price_max',
        'duration',
        'location',
        'profile_image',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price_min' => 'integer',
        'price_max' => 'integer',
        'duration' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
