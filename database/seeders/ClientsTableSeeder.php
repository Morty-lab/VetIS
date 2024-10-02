<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class ClientsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $hashedPassword = Hash::make('testpassword');


        foreach (range(1,10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'role' => 'staff',
                'password' => $hashedPassword,
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);

            $clientInsertID = DB::getPdo()->lastInsertId();

            DB::table('clients')->insert([
                'user_id' => $clientInsertID,
                'client_name' => $faker->firstName.' '.$faker->lastName,
                'client_address' => $faker->address,
                'client_no' => $faker->phoneNumber,
                'client_birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);
        }
    }
}
