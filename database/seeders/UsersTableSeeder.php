<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

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
        DB::table('users')->insert([
            ['name' => 'Admin', 'email' => 'admin@example.com','role' => 'admin', 'password' => $hashedPassword],
            ['name' => 'Secretary', 'email' => 'secretary@example.com','role' => 'secretary', 'password' => $hashedPassword],
            ['name' => 'User', 'email' => 'user@example.com','role' => 'client', 'password' => $hashedPassword],

        ]);


        $faker = Factory::create();

        while (DB::table('admins')->count() < 10){
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
                'role' => 'veterinary',
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
                'role' => 'veterinary',
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
