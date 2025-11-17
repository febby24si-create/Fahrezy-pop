<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1000; $i++) {
            User::create([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password123'),
            ]);
        }
    }
}
