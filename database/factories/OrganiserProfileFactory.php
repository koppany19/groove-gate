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
    use HasFactory;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->organiser(),
            'company_name' => fake()->company(),
            'description' => fake()->paragraph(),
            'phone' => fake()->phoneNumber(),
            'location' => fake()->city()
        ];
    }
}
