<?php

namespace App\Models;

use App\MessageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'body',
        'type',
        'metadata',
        'read_at',
    ];

    protected $casts = [
        'type' => MessageType::class,
        'metadata' => 'array',
        'read_at' => 'datetime',
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function isBookingCard(): bool
    {
        return $this->type === MessageType::BOOKING;
    }

    public function isRead(): bool
    {
        return $this->read_at !== null;
    }
}
