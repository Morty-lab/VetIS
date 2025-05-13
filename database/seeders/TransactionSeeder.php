<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        // Insert 5 sample transactions
        for ($i = 1; $i <= 5; $i++) {
            $transactionId = DB::table('transactions')->insertGetId([
                'client_id' => rand(1, 10),
                'sub_total' => rand(100, 500),
                'total_discount' => rand(5, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insert 2-4 transaction details per transaction
            for ($j = 0; $j < rand(2, 4); $j++) {
                DB::table('transaction_details')->insert([
                    'transaction_id' => $transactionId,
                    'product_id' => rand(1, 20),
                    'quantity' => rand(1, 5),
                    'price' => rand(20, 150),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
