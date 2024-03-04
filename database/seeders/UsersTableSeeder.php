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
        ]);
    }
}
