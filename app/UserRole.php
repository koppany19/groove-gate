<?php

namespace App;

enum UserRole: string
{
    case ORGANISER = 'organiser';
    case ARTIST = 'artist';
    case AUDIENCE = 'audience';

    public function label(): string
    {
        return match($this) {
            self::ORGANISER => 'Organiser',
            self::ARTIST => 'Artist',
            self::AUDIENCE => 'Audience',
        };
    }
}

