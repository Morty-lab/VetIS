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
            ['service_name' => 'Complete Blood Count', 'service_price' => 500.00],
            ['service_name' => 'Grooming', 'service_price' => 500.00],
            ['service_name' => 'Grooming Add On - Sedate', 'service_price' => 400.00],
            ['service_name' => 'Grooming Add On - Aggressive', 'service_price' => 500.00],
            ['service_name' => 'Nail Cut', 'service_price' => 100.00],
            ['service_name' => 'Ear Cleaning', 'service_price' => 350.00],
            ['service_name' => 'Home Service (Dologon & Musuan)', 'service_price' => 400.00],
            ['service_name' => 'Home Service (Beyond D & M)', 'service_price' => 500.00],
            ['service_name' => 'Skin Scrapping', 'service_price' => 500.00],
            ['service_name' => 'Kapon Dog (10 kg)', 'service_price' => 5000.00],
            // ['service_name' => 'Kapon Dog (add on)', 'service_price' => 500.00],
            ['service_name' => 'Kapon Cat (2kgs)', 'service_price' => 3500.00],
            // ['service_name' => 'Kapon Cat (add on)', 'service_price' => 500.00],
            ['service_name' => 'Cesarian Section', 'service_price' => 15000.00],
            ['service_name' => 'Necropsy', 'service_price' => 1500.00],
            ['service_name' => 'Ligation', 'service_price' => 1500.00],
            ['service_name' => 'Pet Lodge', 'service_price' => 500.00],
            ['service_name' => 'Deworming', 'service_price' => 150.00],
            ['service_name' => 'IV fluids', 'service_price' => 850.00],
            ['service_name' => 'Line + Infussion', 'service_price' => 350.00],

        ];

        $fees = [
            ['fee_name' => 'Checkout/Consultation Fee', 'fee_price' => 350.00],
            ['fee_name' => 'Admission Fee', 'fee_price' => 800.00],
            ['fee_name' => 'Hospitalization + PF', 'fee_price' => 850.00],
            ['fee_name' => 'Miscellaneous Fee', 'fee_price' => 500.00],
            ['fee_name' => 'Emergency Fee', 'fee_price' => 1000.00],
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
            DB::table('services')->insert([
                'service_name' => $service['service_name'],
                'service_price' => $service['service_price'],
                'service_type' => 'services',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        foreach ($fees as $fee) {
            DB::table('services')->insert([
                'service_name' => $fee['fee_name'],
                'service_price' => $fee['fee_price'],
                'service_type' => 'fees',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
