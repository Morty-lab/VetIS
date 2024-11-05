<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('pets')->insert([
                'owner_ID' => $faker->numberBetween(1, 10),
                'pet_name' => $faker->firstName,
                'pet_breed' => $faker->randomElement(['Labrador', 'German Shepherd', 'Bulldog', 'Poodle', 'Beagle']),
                'pet_type' => $faker->randomElement(['Dog', 'Cat']),
                'pet_gender' => $faker->randomElement(['Male', 'Female']),
                'pet_birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'pet_color' => $faker->safeColorName,
                'pet_picture' => $faker->imageUrl($width = 640, $height = 480, 'cats'), // Example for cats, adjust as needed
                'pet_description' => $faker->sentence,
                'pet_weight' => $faker->randomFloat(2, 1, 100), // Random weight between 1 and 100
                'vaccinated' => $faker->boolean,
                'neutered' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
