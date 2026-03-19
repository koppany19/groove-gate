<?php

namespace Database\Factories;

use App\ArtistTypeEnum;
use App\GenreType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArtistProfile>
 */
class ArtistProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => User::factory()->artist(),
            'stage_name' => fake()->name(),
            'bio' => fake()->paragraph(),
            'press_text' => fake()->paragraph(10),
            'genre' => fake()->randomElements(array_column(GenreType::cases(), 'value'), fake()->numberBetween(1, 4)),
            'genre_other' => null,
            'artist_type' => fake()->randomElement(ArtistTypeEnum::cases()),
            'price_min' => fake()->numberBetween(100, 1000),
            'price_max' => fake()->numberBetween(1000, 3000),
            'duration' => fake()->randomElement([30, 45, 60, 90, 120]),
            'location' => fake()->city(),
            'profile_image' => fake()->imageUrl(800, 800, 'band'),
            'is_available' => fake()->boolean(80),
        ];
    }
}
