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
        $demoOrganiser = User::factory()->organiser()->create([
            'name'     => 'Demo Organiser',
            'email'    => 'organiser@demo.com',
            'password' => bcrypt('password'),
        ]);

        $demoOrganiserProfile = OrganiserProfile::factory()
            ->create(['user_id' => $demoOrganiser->id]);

        Event::factory()->count(3)->create([
            'organiser_profile_id' => $demoOrganiserProfile->id,
        ]);



        $demoArtist = User::factory()->artist()->create([
            'name'     => 'Demo Artist',
            'email'    => 'artist@demo.com',
            'password' => bcrypt('password'),
        ]);

        $demoArtistProfile = ArtistProfile::factory()
            ->create(['user_id' => $demoArtist->id]);

        ArtistTrack::factory(3)->create(['artist_profile_id' => $demoArtistProfile->id]);
        ArtistAvailability::factory(5)->create(['artist_profile_id' => $demoArtistProfile->id]);



        User::factory()->audience()->create([
            'name'     => 'Demo Audience',
            'email'    => 'audience@demo.com',
            'password' => bcrypt('password'),
        ]);




        User::factory()->count(2)->organiser()
            ->has(
                OrganiserProfile::factory()
                    ->has(Event::factory()->count(3))
            )
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
