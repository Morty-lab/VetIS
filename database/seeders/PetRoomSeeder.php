<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PetRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('pet_lodge_rooms')->insert([
                'status' => $faker->randomElement([0,  2]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

