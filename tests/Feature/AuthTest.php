<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => 'password'
        ]);
        $response ->assertStatus(200)->assertJsonStructure(['token']);
    }


    public function test_user_connot_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@gmail.com',
            'password' => 'wrong'
        ]);
        $response ->assertStatus(401);
    }
    public function test_auth_user_can_get_me()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user,'sanctum')->getJson('/api/auth/me');

        $response ->assertStatus(200);

    }
}

