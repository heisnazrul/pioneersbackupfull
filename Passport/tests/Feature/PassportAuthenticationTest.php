<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PassportAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_protected_api_route_requires_authentication(): void
    {
        $this->getJson('/api/user')->assertUnauthorized();
    }

    public function test_authenticated_user_can_access_protected_route(): void
    {
        $user = User::factory()->create();

        Passport::actingAs($user);

        $this->getJson('/api/user')
            ->assertOk()
            ->assertJsonPath('email', $user->email);
    }
}

