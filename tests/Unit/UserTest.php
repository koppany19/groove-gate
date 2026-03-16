<?php

namespace Tests\Unit;

use App\Models\ArtistProfile;
use App\Models\OrganiserProfile;
use App\Models\User;
use App\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_artist_has_a_profile(): void
    {
        $artist = User::factory()->artist()->has(ArtistProfile::factory())->create();

        $this->assertInstanceOf(ArtistProfile::class, $artist->artistProfile);
    }

    public function test_organiser_has_a_profile(): void
    {
        $organiser = User::factory()->organiser()->has(OrganiserProfile::factory())->create();

        $this->assertInstanceOf(OrganiserProfile::class, $organiser->organiserProfile);
    }

    public function test_user_default_role_is_audience(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->role);
        $this->assertInstanceOf(UserRole::class, $user->role);
    }

    public function test_artist_profile_belongs_to_user(): void
    {
        $artist = User::factory()->artist()->has(ArtistProfile::factory())->create();

        $this->assertEquals($artist->id, $artist->artistProfile->user->id);
    }

    public function test_organiser_profile_belongs_to_user(): void
    {
        $organiser = User::factory()->organiser()->has(OrganiserProfile::factory())->create();

        $this->assertEquals($organiser->id, $organiser->organiserProfile->user->id);
    }
}
