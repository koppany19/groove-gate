<?php

namespace Database\Seeders;

use App\Models\ArtistAvailability;
use App\Models\ArtistProfile;
use App\Models\ArtistTrack;
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
        User::factory()->organiser()->create([
            'name'  => 'Demo Organiser',
            'email' => 'organiser@demo.com',
            'password' => bcrypt('password'),
        ])->organiserProfile()->create(
            OrganiserProfile::factory()->definition()
        );

        User::factory()->artist()->create([
            'name'  => 'Demo Artist',
            'email' => 'artist@demo.com',
            'password' => bcrypt('password'),
        ])->artistProfile()->create(
            ArtistProfile::factory()->definition()
        )->each(function ($profile) {
            ArtistTrack::factory(3)->create(['artist_profile_id' => $profile->id]);
            ArtistAvailability::factory(5)->create(['artist_profile_id' => $profile->id]);
        });

        User::factory()->audience()->create([
            'name'  => 'Demo Audience',
            'email' => 'audience@demo.com',
            'password' => bcrypt('password'),
        ]);


        User::factory()->count(2)->organiser()
            ->has(OrganiserProfile::factory())
            ->create();

        User::factory()->count(10)->artist()
            ->has(
                ArtistProfile::factory()
                    ->has(ArtistTrack::factory()->count(3), 'tracks')
                    ->has(ArtistAvailability::factory()->count(5), 'availability')
            )
            ->create();

        User::factory()->count(20)->audience()->create();
    }
}
