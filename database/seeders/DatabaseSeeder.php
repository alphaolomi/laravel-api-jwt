<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $count = 0;
        // User::factory()->count(100_0_000)->create();
        while ($count <= 100_000_000) {
            $data = [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => [now(), null][random_int(0, 1)],
                'password' =>  Hash::make('password'),
                'remember_token' => [Str::random(10), null][random_int(0, 1)],
                'welcome_valid_until' => null,
            ];

            DB::table('users')->insert($data);
            $count++;

            echo ".";
            if (($count % 2500) == 0) echo "\n";
        }

        try {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
