<?php

use App\Models\User;

test('models can be instantiated', function () {
    $user = User::factory()->create();

    $this->expectsDatabaseQueryCount(2);
    $this->assertModelExists($user);
    $this->assertDatabaseCount('users', 1);

});
