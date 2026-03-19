<?php

namespace App;

enum ArtistTypeEnum: string
{
    case LIVE = 'live';
    case DJ = 'dj';

    public function label(): string
    {
        return match($this) {
            self::LIVE => 'Live',
            self::DJ => 'DJ',
        };
    }
}
