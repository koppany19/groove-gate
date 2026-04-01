<?php

namespace Database\Factories;

use App\Models\ArtistProfile;
use App\Models\ArtistTrack;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ArtistTrack>
 */
class ArtistTrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $platforms = [
            'https://soundcloud.com/example/track-' . fake()->numberBetween(1000, 9999),
            'https://open.spotify.com/track/' . fake()->regexify('[A-Za-z0-9]{22}'),
            'https://www.youtube.com/watch?v=' . fake()->regexify('[A-Za-z0-9_-]{11}'),
        ];

        return [
            'artist_profile_id' => ArtistProfile::factory(),
            'title'             => fake()->words(fake()->numberBetween(2, 4), true),
            'url'               => fake()->randomElement($platforms),
        ];
    }
}
