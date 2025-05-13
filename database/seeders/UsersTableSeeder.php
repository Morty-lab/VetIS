<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hash the password
        $hashedPassword = Hash::make('testpassword');

        // Insert users
        DB::table('users')->insert(
            ['name' => 'Admin', 'email' => 'cabahuganiejoseph@gmail.com', 'role' => 'admin', 'password' => $hashedPassword],

        );

        $adminLastInsertID = DB::getPdo()->lastInsertId();


        DB::table('admins')->insert([
            'user_id' => $adminLastInsertID,
            'firstname' => 'Anie Joseph',
            'lastname' => 'Cabahug',
            'address' => 'Dummy Address',
            'phone_number' => 'Dummy Number',
            'birthday' => '2002-08-11',
            'position' => "admin",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert(
            ['name' => 'User', 'email' => 'aniejosephcabahug@gmail.com', 'role' => 'client', 'password' => $hashedPassword],
        );

        $userLastInsertID = DB::getPdo()->lastInsertId();
        DB::table('clients')->insert([
            'user_id' => $userLastInsertID, // Ensure this user_id exists in the users table
            'client_name' => 'Anie Joseph Cabahug',
            'client_no' => '1234567890',
            'client_address' => 'Dummy Address',
            'client_birthday' => '2002-08-11',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        //        DB::table('users')->insert(['name' => 'Anie Joseph Cabahug', 'email' => 'aniejoseph@gmail.com','role' => 'client', 'password' => $hashedPassword]);
//
//        $userLastInsertID = DB::getPdo()->lastInsertId();
//        DB::table('clients')->insert([
//            'user_id' => $userLastInsertID, // Ensure this user_id exists in the users table
//            'client_name' => 'Anie Joseph Cabahug',
//            'client_no' => '1234567890',
//            'client_address' => '123 Main Street, Anytown, USA',
//            'client_birthday' => '1990-05-15', // Format: YYYY-MM-DD
//            'client_profile_picture' => 'profile_pictures/jane_doe.jpg', // Optional
//            'status' => true, // Defaults to true; can be omitted if you want the default
//            'created_at' => now(), // Add timestamps manually
//            'updated_at' => now(),
//        ]);
//
//        $pet = DB::getPdo()->lastInsertId();
//
//
//        DB::table('pets')->insert([
//            'owner_ID' => $pet, // Ensure this owner_ID exists in the clients table
//            'pet_name' => 'Buddy',
//            'pet_breed' => 'Golden Retriever',
//            'pet_type' => 'Dog',
//            'pet_gender' => 'Male',
//            'pet_birthdate' => '2021-03-15', // Format: YYYY-MM-DD
//            'pet_color' => 'Golden',
//            'pet_weight' => 25.0, // Weight in kilograms
//            'status' => false, // Optional since it defaults to false
//            'created_at' => now(), // Add timestamps manually
//            'updated_at' => now(),
//        ]);
//
//        DB::table('users')->insert(['name' => 'Veterinarian Cabahug', 'email' => 'aniecabahug69@gmail.com','role' => 'veterinarian', 'password' => $hashedPassword]);
//
//        $veterinarianLastInsertID = DB::getPdo()->lastInsertId();
//
//        DB::table('doctors')->insert([
//            'user_id' => $veterinarianLastInsertID, // assuming there's a user with ID 1
//            'firstname' => 'Veterinarian',
//            'lastname' => 'Cabahug',
//            'address' => '123 Main St, City, Country',
//            'phone_number' => '123-456-7890',
//            'birthday' => '1985-10-15',
//            'position' => 'General Practitioner',
//            'profile_picture' => 'profile_pic.jpg',
//            'license_number' => 'AB1234567',
//            'status' => true,
//            'created_at' => now(),
//            'updated_at' => now(),
//        ]);


        $faker = Factory::create();

        while (DB::table('admins')->count() < 10) {
            $adminPositions = [
                "Practice Manager",
                "Office Manager",
                "Receptionist",
                "Client Services Coordinator",
                "Scheduling Coordinator",
                "Medical Records Clerk",
                "Billing Specialist",
                "Insurance Coordinator",
                "Human Resources Manager",
                "Marketing Manager",
                "IT Support Specialist",
                "Facilities Manager",
                "Supply Chain Manager",
                "Financial Controller",
                "Compliance Officer",
                "Risk Management Specialist"
            ];
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'role' => 'admin',
                'password' => $hashedPassword,
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);

            $adminLastInsertID = DB::getPdo()->lastInsertId();


            DB::table('admins')->insert([
                'user_id' => $adminLastInsertID,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'position' => $adminPositions[random_int(0, 6)],
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),


            ]);

        }

        while (DB::table('doctors')->count() < 10) {
            $position = [
                'Veterinarian',
                'Veterinary Technician/Technologist',
                'Veterinary Assistant',
                'Laboratory Technician',
                'Kennel Worker',
                'Receptionist',
                'Practice Manager'
            ];
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'role' => 'veterinarian',
                'password' => $hashedPassword,
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);

            $VetlastInsertedId = DB::getPdo()->lastInsertId();


            DB::table('doctors')->insert([
                'user_id' => $VetlastInsertedId,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'position' => $position[random_int(0, 6)],
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);
        }

        while (DB::table('staffs')->count() < 10) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'role' => 'staff',
                'password' => $hashedPassword,
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);

            $stafflastInsertedId = DB::getPdo()->lastInsertId();

            DB::table('staffs')->insert([
                'user_id' => $stafflastInsertedId,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'position' => $position[random_int(0, 6)],
                'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);


        }


    }
}
