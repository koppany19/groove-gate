<?php

namespace App;

enum BookingStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case DECLINED = 'declined';

        public function label(): string
        {
            return match ($this) {
                self::PENDING => 'Pending',
                self::ACCEPTED => 'Accepted',
                self::DECLINED => 'Declined',
            };
        }

        public function color(): string
        {
            return match($this) {
                self::PENDING => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20',
                self::ACCEPTED => 'bg-green-500/10 text-green-500 border-green-500/20',
                self::DECLINED => 'bg-red-500/10 text-red-500 border-red-500/20',
            };
        }
}
