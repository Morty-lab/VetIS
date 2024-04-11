<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([
            ['name' => 'Admin', 'email' => 'admin@example.com','role' => 'admin', 'password' => $hashedPassword],
            ['name' => 'Veterinary', 'email' => 'veterinary@example.com','role' => 'veterenarian', 'password' => $hashedPassword],
            ['name' => 'Secretary', 'email' => 'secretary@example.com','role' => 'secretary', 'password' => $hashedPassword],
            ['name' => 'Staff', 'email' => 'staff@example.com','role' => 'staff', 'password' => $hashedPassword],
            ['name' => 'User', 'email' => 'user@example.com','role' => 'client', 'password' => $hashedPassword],
            ['name' => 'Yawa Ko', 'email' => 'yawasacisc@gmail.com', 'role' => 'doctor', 'password' => $hashedPassword],
        ]);

        $lastInsertedId = DB::getPdo()->lastInsertId();

        DB::table('doctors')->insert([
            [
                'user_id' => $lastInsertedId,
                'firstname' => 'Enrico',
                'lastname' => 'Nacua',
                'address' => 'Purok 18 College Park Musuan Dologon',
                'phone_number' => '09383007781',
                'birthday' => '0001-01-01',
                'position' => 'Final Boss Sa CISC',
                'created_at' => '2024-04-11 14:01:43',
                'updated_at' => '2024-04-11 14:01:43',
            ]
        ]);
    }
}
