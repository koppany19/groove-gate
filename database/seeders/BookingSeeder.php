<?php

namespace Database\Seeders;

use App\Models\ArtistProfile;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = Event::all();
        $artists = ArtistProfile::all();

        if ($events->isEmpty() || $artists->isEmpty()) {
            return;
        }

        foreach ($events as $event) {
            $takeCount = min(rand(1, 3), $artists->count());
            $randomArtists = $artists->random($takeCount);

            foreach ($randomArtists as $artist) {
                $status = fake()->randomElement(['pending', 'accepted', 'declined']);

                Booking::factory()->create([
                    'event_id'          => $event->id,
                    'artist_profile_id' => $artist->id,
                    'status'            => $status,
                ]);
            }
        }
    }
}
