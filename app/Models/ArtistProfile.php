<?php

namespace App\Models;

use App\ArtistTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArtistProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'stage_name',
        'bio',
        'press_text',
        'genre',
        'genre_other',
        'price_min',
        'price_max',
        'duration',
        'location',
        'profile_image',
        'artist_type',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'price_min' => 'integer',
        'price_max' => 'integer',
        'duration' => 'integer',
        'artist_type' => ArtistTypeEnum::class,
        'genre' => 'array',
    ];

    protected $attributes = [
        'artist_type' => ArtistTypeEnum::LIVE->value,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
