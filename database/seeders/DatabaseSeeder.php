<?php

namespace Database\Seeders;

use App\Models\ArtistProfile;
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
        $organiser = User::factory()->organiser()->create([
            'name' => 'Demo Organiser',
            'email' => 'organiser@demo.com',
            'password' => bcrypt('password')
        ]);
        OrganiserProfile::factory()->create(['user_id' => $organiser->id]);

        $artist = User::factory()->artist()->create([
            'name' => 'Demo Artist',
            'email' => 'artist@demo.com',
            'password' => bcrypt('password')
        ]);
        ArtistProfile::factory()->create(['user_id' => $artist->id]);

       User::factory()->audience()->create([
            'name' => 'Demo Audience',
            'email' => 'audience@demo.com',
            'password' => bcrypt('password')
       ]);


       User::factory()->audience()->count(20)->create();
       User::factory()->artist()->count(5)->has(ArtistProfile::factory())->create();
       User::factory()->artist()->count(2)->has(OrganiserProfile::factory())->create();
    }
}
