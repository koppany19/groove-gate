<?php

namespace Database\Factories;

use App\Models\ArtistAvailability;
use App\Models\ArtistProfile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ArtistAvailability>
 */
class ArtistAvailabilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artist_profile_id' => ArtistProfile::factory(),
            'date'              => Carbon::today()->addDays(fake()->unique()->numberBetween(1, 90))->format('Y-m-d'),
            'is_available'      => false,
        ];
    }
}
