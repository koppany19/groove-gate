<?php

namespace Database\Factories;

use App\EventStatus;
use App\Models\Event;
use App\Models\OrganiserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('now', '+6 months');
        $endDate = fake()->dateTimeBetween($startDate, (clone $startDate)->modify('+1 day'));
        $saleEndAt = fake()->dateTimeBetween('now', $startDate);

        return [
            'organiser_profile_id' => OrganiserProfile::factory(),
            'name' => fake()->words(3, true) . ' Festival',
            'description' => fake()->paragraphs(2, true),
            'location' => fake()->city() . ', ' . fake()->country(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'cover_image' => 'https://picsum.photos/seed/' . fake()->word() . '/1920/400',
            'capacity' => fake()->randomElement([100, 200, 500, 1000, 5000]),
            'has_seats' => fake()->boolean(30),
            'status' => fake()->randomElement([EventStatus::DRAFT, EventStatus::PUBLISHED]),
            'base_price' => fake()->randomElement([10, 20, 50, 100]),
            'is_dynamic_price' => fake()->boolean(20),
            'sale_end_at' => $saleEndAt,
        ];
    }

}
