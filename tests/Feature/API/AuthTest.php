<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\post;
use function Pest\Laravel\postJson;

beforeEach(function () {
    // Set up a user for testing
    $this->user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
    ]);
});

// Login Tests
describe('login', function() {
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

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });

    it('requires valid json payload', function() {
        $response = post('/api/auth/login', ['invalid-json'], [
            // 'Content-Type' => 'application/json',
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'message' => 'Invalid payload. JSON expected.',
            ]);
    });

    it('validates required fields', function() {
        $response = postJson('/api/auth/login', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    });

    it('validates email format', function() {
        $response = postJson('/api/auth/login', [
            'email' => 'invalid-email',
            'password' => 'password'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });
});

// Authenticated Endpoints Tests
describe('authenticated endpoints', function() {
    it('can get authenticated user details', function () {
        $token = auth("api")->attempt(['email' => 'test@example.com', 'password' => 'password']);

        $response = postJson('/api/auth/me', [], [
            'Authorization' => "Bearer $token",
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'email' => 'test@example.com',
            ])
            ->assertJsonStructure([
                'id',                
                'name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at'
            ]);
    });

    it('cannot access protected routes without token', function() {
        $response = postJson('/api/auth/me');
        $response->assertStatus(401);
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

        // Verify token is invalidated
        $secondResponse = postJson('/api/auth/me', [], [
            'Authorization' => "Bearer $token",
        ]);
        $secondResponse->assertStatus(401);
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

        // Verify new token works
        $newToken = $response->json('access_token');
        $verifyResponse = postJson('/api/auth/me', [], [
            'Authorization' => "Bearer $newToken",
        ]);
        $verifyResponse->assertStatus(200);
    });
});
