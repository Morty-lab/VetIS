<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'service_name' => 'Grooming',
                'service_price' => 50.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_name' => 'Vaccination',
                'service_price' => 25.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_name' => 'Health Checkup',
                'service_price' => 30.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_name' => 'Boarding',
                'service_price' => 100.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
