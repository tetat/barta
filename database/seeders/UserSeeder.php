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
                'firstName' => fake()->firstName(),
                'lastName' => fake()->lastName(),
                'username' => fake()->userName(),
                'email' => fake()->email(),
                'gender' => fake()->randomElement(['male', 'female', 'other']),
                'password' => Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
