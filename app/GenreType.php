<?php

namespace App;

enum GenreType: string
{
    case ROCK = 'rock';
    case POP = 'pop';
    case JAZZ = 'jazz';
    case ELECTRONIC = 'electronic';
    case HIP_HOP = 'hip-hop';
    case CLASSICAL = 'classical';
    case FOLK = 'folk';
    case METAL = 'metal';
    case RNB = 'rnb';
    case REGGAE = 'reggae';
    case LATIN = 'latin';
    case BLUES = 'blues';
    case SOUL = 'soul';
    case FUNK = 'funk';
    case COUNTRY = 'country';
    case PUNK = 'punk';
    case INDIE = 'indie';
    case AMBIENT = 'ambient';
    case HOUSE = 'house';
    case TECHNO = 'techno';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::ROCK => 'Rock',
            self::POP => 'Pop',
            self::JAZZ => 'Jazz',
            self::ELECTRONIC => 'Electronic',
            self::HIP_HOP => 'Hip-Hop',
            self::CLASSICAL => 'Classical',
            self::FOLK => 'Folk',
            self::METAL => 'Metal',
            self::RNB => 'R&B',
            self::REGGAE => 'Reggae',
            self::LATIN => 'Latin',
            self::BLUES => 'Blues',
            self::SOUL => 'Soul',
            self::FUNK => 'Funk',
            self::COUNTRY => 'Country',
            self::PUNK => 'Punk',
            self::INDIE => 'Indie',
            self::AMBIENT => 'Ambient',
            self::HOUSE => 'House',
            self::TECHNO => 'Techno',
            self::OTHER => 'Other',
        };
    }
}
