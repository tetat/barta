<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'user_name' => fake()->userName(),
                'email' => fake()->email(),
                'bio' => fake()->realText(30),
                'gender' => fake()->randomElement(['male', 'female', 'other']),
                'password' => Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
