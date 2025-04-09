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
                'owner_ID' => $faker->numberBetween(1, 10),  // Random owner ID between 1 and 10
                'pet_name' => $faker->firstName,  // English first name for the pet
                'pet_breed' => $faker->randomElement(['Labrador', 'German Shepherd', 'Bulldog', 'Poodle', 'Beagle']), // Random English breed names
                'pet_type' => $faker->randomElement(['Dog', 'Cat']),  // English pet types (Dog or Cat)
                'pet_gender' => $faker->randomElement(['Male', 'Female']),  // English gender (Male or Female)
                'pet_birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),  // Random date of birth
                'pet_color' => $faker->safeColorName,  // English safe color name
                // 'pet_picture' => $faker->imageUrl($width = 640, $height = 480, 'cats'), // Example for cats, adjust as needed
                'pet_description' => $faker->sentence,  // Random English sentence for description
                // 'pet_weight' => $faker->randomFloat(2, 1, 100), // Random weight between 1 and 100
                'vaccinated' => $faker->boolean,  // Random boolean for vaccination status
                'neutered' => $faker->boolean,  // Random boolean for neutering status
                'vaccinated_anti_rabies' => $faker->boolean,  // Random boolean for anti-rabies vaccination
                'anti_rabies_vaccination_date' => $faker->date($format = 'Y-m-d', $max = 'now'),  // Random date for anti-rabies vaccination
                'history_of_aggression' => $faker->randomElement([
                    'This pet has shown aggression towards other dogs in the past.',
                    'No history of aggression towards other pets.',
                    'Aggression noticed only in certain situations, such as when approached while eating.',
                    'Pet has never exhibited aggression towards other animals.'
                ]),  // Meaningful English sentences for aggression history
                'food_allergies' => $faker->boolean ? $faker->randomElement(['Peanuts', 'Grains', 'Dairy', 'Chicken']) : null,  // Either a random food allergy in English or null
                'pet_food' => $faker->randomElement(['Dry food', 'Wet food', 'Homemade meals', 'Raw food']),  // Random pet food name in English
                'okay_to_give_treats' => $faker->boolean,  // Random boolean for giving treats
                'last_groom_date' => $faker->date($format = 'Y-m-d', $max = 'now'),  // Random last groom date
                'okay_to_use_photos_online' => $faker->boolean,  // Random boolean for permission to use photos online
                'pet_condition' => $faker->boolean ? $faker->randomElement([
                    'Pet has no known health issues.',
                    'Pet has mild allergies and requires occasional medication.',
                    'Pet suffers from arthritis and needs medication regularly.',
                    'Pet has a history of seizures, and the owner must monitor closely.'
                ]) : null,  // Either a random condition description or null in English
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
