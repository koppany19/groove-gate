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

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DataSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
