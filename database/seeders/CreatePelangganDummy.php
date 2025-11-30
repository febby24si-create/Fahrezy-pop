<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pelanggan;

class CreatePelangganDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // HAPUS DATA PELANGGAN EXISTING SEBELUM SEEDING
        DB::table('pelanggan')->truncate();

        $faker = \Faker\Factory::create();

        foreach (range(1, 100) as $index) {
            // GUNAKAN FIRST OR CREATE UNTUK KEAMANAN
            Pelanggan::firstOrCreate(
                ['email' => $faker->unique()->safeEmail],
                [
                    'first_name' => $faker->firstName,
                    'last_name'  => $faker->lastName,
                    'birthday'   => $faker->date('Y-m-d', '2005-12-31'),
                    'gender'     => $faker->randomElement(['Male', 'Female', 'Other']),
                    'phone'      => $faker->phoneNumber,
                ]
            );
        }
    }
}
