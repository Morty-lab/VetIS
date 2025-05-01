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

        $services = [
            'Grooming',
            'Vaccination',
            'Deworming',
            'Dental',
            'Surgery',
            'X-Ray',
            'Lab Test',
            'Ultrasound',
            'ECG',
        ];

        $fees = [
            'Admission Fee',
            'Room Fee',
            'ICU Fee',
            'Surgery Fee',
            'Lab Test Fee',
            'Medicine Fee',
            'Diet Fee',
        ];

        $discounts = [
            [
                'discount_name' => 'Senior Citizen Discount',
                'discount_rate' => 0.20,  // 20% discount
            ],
            [
                'discount_name' => 'PWD Discount',
                'discount_rate' => 0.20,            // 20% discount
            ],
            [
                'discount_name' => 'Student Discount',
                'discount_rate' => 0.10,        // 10% discount
            ],
            [
                'discount_name' => 'Loyalty Discount',
                'discount_rate' => 0.05,        // 5% discount
            ],
        ];

        foreach ($discounts as $discount) {
            DB::table('services')->insert([
                'service_name' => $discount['discount_name'],
                'service_price' => $discount['discount_rate'],
                'service_type' => 'discounts',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        foreach ($services as $service) {
            $price = rand(50, 500);
            if ($price % 5 !== 0) {
                $price = $price + (5 - $price % 5);
            }

            DB::table('services')->insert([
                'service_name' => $service,
                'service_price' => $price,
                'service_type' => 'services',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        foreach ($fees as $fee) {
            $price = rand(100, 500);
            if ($price % 10 !== 0) {
                $price = $price + (10 - $price % 10);
            }

            DB::table('services')->insert([
                'service_name' => $fee,
                'service_price' => $price,
                'service_type' => 'fees',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
