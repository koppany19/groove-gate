<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganiserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'company_name',
        'description',
        'phone',
        'location',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
