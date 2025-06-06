<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Appointments;
use App\Models\Products;
use App\Models\Stocks;
use App\Models\Suppliers;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //    Stocks::factory()->count(10)->create();
        // Products::factory()->count(10)->create();
        //




        $this->call([UsersTableSeeder::class, ServicesTableSeeder::class, CategorySeeder::class, ProductsSeeder::class]);
        // ClientsTableSeeder::class,PetSeeder::class,NotificationSeeder::class,PetRoomSeeder::class


        // \App\Models\User::factory(10)->create();
        // Appointments::factory()->count(10)->create();



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
