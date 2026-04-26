<?php

namespace Database\Factories;

use App\BookingStatus;
use App\Models\ArtistProfile;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'artist_profile_id' => ArtistProfile::factory(),
            'status' => BookingStatus::PENDING,
            'fee' => $this->faker->randomFloat(2, 100, 5000),
            'message' => $this->faker->optional(0.7)->paragraph(),
            'performance_date' => $this->faker->date(),
            'duration' => $this->faker->randomFloat(2, 30, 120),
        ];
    }

    public function accepted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => BookingStatus::ACCEPTED,
        ]);
    }

    public function declined(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => BookingStatus::DECLINED,
        ]);
    }
}
