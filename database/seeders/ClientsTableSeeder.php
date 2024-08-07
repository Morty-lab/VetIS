<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
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

        foreach (range(1,10) as $index) {
            DB::table('clients')->insert([
                'client_name' => $faker->name,
                'client_no' => $faker->unique()->randomNumber(5),
                'client_address' => $faker->address,
                'client_email_address' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
