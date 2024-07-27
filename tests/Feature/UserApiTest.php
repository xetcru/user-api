<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class UserApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'user',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['user', 'token']);
    }

    public function test_login()
    {
        $password = 'password';
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure(['access_token', 'token_type']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }

    public function test_get_users()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
                 ->assertJsonStructure([ '*' => ['id', 'name', 'email', 'created_at', 'updated_at'] ]);
    }

    public function test_create_user()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/users', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'role' => $this->faker->word,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['id', 'name', 'email', 'created_at', 'updated_at']);
    }

    public function test_update_user()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->putJson('/api/users/' . $user->id, [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['id', 'name', 'email', 'created_at', 'updated_at']);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->deleteJson('/api/users/' . $user->id);

        $response->assertStatus(204);
    }
}
