<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [
                'client_name' => 'Client 1',
                'client_no' => '12345',
                'client_address' => '123 Main St',
                'client_email_address' => 'client1@example.com',
            ],
            [
                'client_name' => 'Client 2',
                'client_no' => '67890',
                'client_address' => '456 Elm St',
                'client_email_address' => 'client2@example.com',
            ],
            [
                'client_name' => 'Client 3',
                'client_no' => '11223',
                'client_address' => '789 Pine St',
                'client_email_address' => 'client3@example.com',
            ],
            [
                'client_name' => 'Client 4',
                'client_no' => '44556',
                'client_address' => '321 Oak St',
                'client_email_address' => 'client4@example.com',
            ],
            [
                'client_name' => 'Client 5',
                'client_no' => '77889',
                'client_address' => '654 Maple St',
                'client_email_address' => 'client5@example.com',
            ],
        ]);
    }
}
