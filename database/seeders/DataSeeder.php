<?php

namespace Database\Seeders;

use App\Models\ArtistAvailability;
use App\Models\ArtistProfile;
use App\Models\ArtistTrack;
use App\Models\Event;
use App\Models\OrganiserProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(2)->organiser()
            ->has(OrganiserProfile::factory()->has(Event::factory()->count(3)))
            ->create();

        User::factory()->count(10)->artist()
            ->has(
                ArtistProfile::factory()
                    ->has(ArtistTrack::factory()->count(3), 'tracks')
                    ->has(ArtistAvailability::factory()->count(5), 'availability')
            )
            ->create();

        fake()->unique(true);
        User::factory()->count(20)->audience()->create();
    }
}
