<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(array $attributes = []): User
    {
        $role = Role::firstOrCreate(
            ['name' => 'RECEPTIONIST'],
            ['display_name' => 'Receptionist']
        );

        return User::factory()->create(array_merge([
            'role_id' => $role->id,
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
        ], $attributes));
    }

    public function test_user_can_login()
    {
        $this->createUser();

        $response = $this->postJson('/api/login', [
            'email' => 'test@gmail.com',
            'password' => 'password',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    public function test_user_connot_login_with_wrong_password()
    {
        $this->createUser();

        $response = $this->postJson('/api/login', [
            'email' => 'test@gmail.com',
            'password' => 'wrong',
        ]);

        $response->assertStatus(401);
    }

    public function test_auth_user_can_get_me()
    {
        $user = $this->createUser();

        $response = $this
            ->actingAs($user, 'sanctum')
            ->getJson('/api/me');

        $response->assertStatus(200);
    }
}