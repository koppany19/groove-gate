<?php

namespace App\Models;

use App\EventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


}
