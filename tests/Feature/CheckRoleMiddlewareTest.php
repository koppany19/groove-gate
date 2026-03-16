<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckRoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_organiser_can_access_organiser_routes(): void
    {
        $organiser = User::factory()->organiser()->create();

        $response = $this->actingAs($organiser)->get('/organiser/dashboard');

        $response->assertStatus(200);
    }

    public function test_artist_cannot_access_organiser_routes(): void
    {
        $artist = User::factory()->artist()->create();

        $response = $this->actingAs($artist)->get('/organiser/dashboard');

        $response->assertStatus(403);
    }

    public function test_audience_cannot_access_organiser_routes(): void
    {
        $audience = User::factory()->audience()->create();

        $response = $this->actingAs($audience)->get('/organiser/dashboard');

        $response->assertStatus(403);
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/organiser/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_artist_can_access_artist_routes(): void
    {
        $artist = User::factory()->artist()->create();

        $response = $this->actingAs($artist)->get('/artist/dashboard');

        $response->assertStatus(200);
    }

    public function test_organiser_cannot_access_artist_routes(): void
    {
        $organiser = User::factory()->organiser()->create();

        $response = $this->actingAs($organiser)->get('/artist/dashboard');

        $response->assertStatus(403);
    }
}
