<?php

namespace App\Models;

use App\ArtistTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArtistProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'stage_name',
        'bio',
        'genre',
        'genre_other',
        'price_min',
        'price_max',
        'duration',
        'location',
        'cover_image',
        'artist_type',
        'is_available',
        'spotify_url',
        'soundcloud_url',
        'youtube_url',
        'instagram_url',
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

    public function tracks(): HasMany
    {
        return $this->hasMany(ArtistTrack::class);
    }

    public function availability(): HasMany
    {
        return $this->hasMany(ArtistAvailability::class);
    }

    public function profileCompleteness(): int
    {
        $fields = [
            $this->stage_name,
            $this->bio,
            $this->press_text,
            $this->genre,
            $this->price_min,
            $this->location,
            $this->cover_image,
        ];

        $filled = collect($fields)->filter()->count();
        $total = count($fields);

        $hasTracks = $this->tracks()->exists();
        if ($hasTracks) $filled++;
        $total++;

        return (int) ($filled / $total * 100);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
