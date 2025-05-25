<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Medications",
            "Vaccines"

        ];

        foreach ($categories as $categoryName) {
            if (!Category::where('category_name', $categoryName)->exists()) {
                Category::factory()->create(['category_name' => $categoryName]);
            }
        }
    }
}

