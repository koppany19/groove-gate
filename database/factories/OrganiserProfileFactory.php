<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganiserProfile>
 */
class OrganiserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seed = fake()->word() . fake()->numberBetween(1, 9999);
        return [
            'user_id' => User::factory()->organiser(),
            'company_name' => fake()->company(),
            'description' => fake()->paragraph(),
            'phone' => fake()->phoneNumber(),
            'location' => fake()->city(),
            'cover_image'    => 'https://picsum.photos/seed/' . $seed . 'cover/1920/400',
        ];
    }
}
