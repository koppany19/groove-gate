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
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        $organiser = User::create([
            'name'     => 'Demo Organiser',
            'email'    => 'organiser@demo.com',
            'password' => $password,
            'role'     => 'organiser',
        ]);

        $organiserProfile = OrganiserProfile::create([
            'user_id'      => $organiser->id,
            'company_name' => 'GrooveGate Events Ltd.',
            'description'  => 'We organize the best electronic and live music events in the region.',
            'location'     => 'Budapest, Hungary',
        ]);

        Event::factory()->create([
            'organiser_profile_id' => $organiserProfile->id,
            'name'                 => 'GrooveGate Launch Party',
            'status'               => \App\EventStatus::PUBLISHED->value ?? 'published',
        ]);

        $artist = User::create([
            'name'     => 'Demo Artist',
            'email'    => 'artist@demo.com',
            'password' => $password,
            'role'     => 'artist',
        ]);

        $artistProfile = ArtistProfile::create([
            'user_id'      => $artist->id,
            'stage_name'   => 'Metro Line',
            'bio'          => 'Ha lassuk igazabol. Ez az egyuttes jou es pacek.',
            'artist_type'  => 'live',
            'price_min'    => 200,
            'price_max'    => 500,
            'duration'     => 45,
            'location'     => 'Sepiszentgyorgy',
            'is_available' => true,
        ]);

        ArtistTrack::factory(3)->create([
            'artist_profile_id' => $artistProfile->id
        ]);

        ArtistAvailability::factory(5)->create([
            'artist_profile_id' => $artistProfile->id
        ]);

        User::create([
            'name'     => 'Demo Audience',
            'email'    => 'audience@demo.com',
            'password' => $password,
            'role'     => 'audience',
        ]);
    }
}
