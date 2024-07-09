<?php


use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\postJson;

beforeEach(function () {
    // Set up a user for testing
    $this->user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password'), // Ensure password hashing matches
    ]);
});


it('can login with valid credentials', function () {
    $response = postJson('/api/auth/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);
});



it('cannot login with invalid credentials', function () {
    $response = postJson('/api/auth/login', [
        'email' => 'test@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(401)
        ->assertJson([
            'error' => 'Unauthorized',
        ]);
});

it('can get authenticated user details', function () {
    $token = auth("api")->attempt(['email' => 'test@example.com', 'password' => 'password']);

    $response = postJson('/api/auth/me', [], [
        'Authorization' => "Bearer $token",
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'email' => 'test@example.com',
        ]);
});

it('can logout successfully', function () {
    $token = auth("api")->attempt(['email' => 'test@example.com', 'password' => 'password']);

    $response = postJson('/api/auth/logout', [], [
        'Authorization' => "Bearer $token",
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'Successfully logged out',
        ]);
});

it('can refresh a token', function () {
    $token = auth("api")->attempt(['email' => 'test@example.com', 'password' => 'password']);

    $response = postJson('/api/auth/refresh', [], [
        'Authorization' => "Bearer $token",
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in',
        ]);
});
