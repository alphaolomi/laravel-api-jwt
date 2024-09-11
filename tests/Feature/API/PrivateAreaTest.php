<?php


// ...

use function Pest\Laravel\getJson;

test('user cant access private area', function () {
    $response = getJson('/api/private/area');

    $response->assertUnauthorized();
});



test('user has private area with correct credentials', function () {
    auth('web')->attempt(['email' => 'test@example.com', 'password' => 'password']);

    $response = getJson('/api/private/area');

    $response->assertUnauthorized();
});
