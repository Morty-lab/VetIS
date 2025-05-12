<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Products;
use App\Models\Unit;
use Faker\Factory as Faker;



class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            "Cat Food",
            "Dog Snacks",
            "Pet Accessories",
            "Pet Grooming",
            "Cat Litter",
            "Pet Housing",
            "Pet Carriers",
            "Pet Collars",
            "Pet Muzzles"
        ];

        foreach ($categories as $categoryName) {
            if (!Category::where('category_name', $categoryName)->exists()) {
                Category::create(['category_name' => $categoryName]);
            }
        }

        $products = [
            ['product_name' => 'Best Cat (diff. flavors)', 'product_category' => 'Cat Food', 'brand' => 'Best Cat', 'unit' => 'sack'],
            ['product_name' => 'Dentastix (10 – 25 kg.)', 'product_category' => 'Dog Snacks', 'brand' => 'Dentastix', 'unit' => 'sack'],
            ['product_name' => 'Dentastix (5 – 10 kg.)', 'product_category' => 'Dog Snacks', 'brand' => 'Dentastix', 'unit' => 'sack'],
            ['product_name' => 'Sleeky (chewy snack)', 'product_category' => 'Dog Snacks', 'brand' => 'Unknown', 'unit' => 'pack'],
            ['product_name' => 'Pet Bottles', 'product_category' => 'Pet Accessories', 'brand' => 'Unknown', 'unit' => 'bottle'],
            ['product_name' => 'Pet Brush', 'product_category' => 'Pet Accessories', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Cat Shower Bag', 'product_category' => 'Pet Accessories', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Cat nuzzle (s)', 'product_category' => 'Pet Accessories', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Cat nuzzle (m)', 'product_category' => 'Pet Accessories', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Nutrichuncks (A)', 'product_category' => 'Cat Food', 'brand' => 'Nutrichuncks', 'unit' => 'sack'],
            ['product_name' => 'Nutrichunks (Pu)', 'product_category' => 'Cat Food', 'brand' => 'Nutrichuncks', 'unit' => 'sack'],
            ['product_name' => 'Majessty Cat', 'product_category' => 'Cat Food', 'brand' => 'Majessty', 'unit' => 'sack'],
            ['product_name' => 'Duchess Cat', 'product_category' => 'Cat Food', 'brand' => 'Duchess', 'unit' => 'sack'],
            ['product_name' => 'Royal Tail shampoo (200 ml.)', 'product_category' => 'Pet Grooming', 'brand' => 'Royal Tail', 'unit' => 'bottle'],
            ['product_name' => 'Royal Tail Perfume', 'product_category' => 'Pet Grooming', 'brand' => 'Royal Tail', 'unit' => 'bottle'],
            ['product_name' => 'Royal Tail Bar Soap (150 g.)', 'product_category' => 'Pet Grooming', 'brand' => 'Royal Tail', 'unit' => 'bar'],
            ['product_name' => 'Hair Grower Herbal Soap (115 g.)', 'product_category' => 'Pet Grooming', 'brand' => 'Unknown', 'unit' => 'bar'],
            ['product_name' => 'Kleen (Clumping Cat lifter sand)(10L)', 'product_category' => 'Cat Litter', 'brand' => 'Unknown', 'unit' => 'sack'],
            ['product_name' => 'Hinoki (Clumping Cat Litter) (7L)', 'product_category' => 'Cat Litter', 'brand' => 'Unknown', 'unit' => 'sack'],
            ['product_name' => 'Pyramid Hill (L)', 'product_category' => 'Pet Housing', 'brand' => 'Pyramid', 'unit' => 'piece'],
            ['product_name' => 'Pyramid Hill (B)', 'product_category' => 'Pet Housing', 'brand' => 'Pyramid', 'unit' => 'piece'],
            ['product_name' => 'Cages (Petto ai)(47x31x38)', 'product_category' => 'Pet Housing', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Cages (Pethouse) (L)', 'product_category' => 'Pet Housing', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Pet Bag or Carnier Bag', 'product_category' => 'Pet Carriers', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'E.collar- #6 (2-3 kg)', 'product_category' => 'Pet Collars', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'E.collar- #5 (3-5 kg)', 'product_category' => 'Pet Collars', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'E.collar- #4 (5-7 kg)', 'product_category' => 'Pet Collars', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'E.collar- #3 (7.5 – 9 kg)', 'product_category' => 'Pet Collars', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'E.collar- #4 (9 – 11 kg)', 'product_category' => 'Pet Collars', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'E.collar- #2F (11-15 kg)', 'product_category' => 'Pet Collars', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'E.collar- #I (15-22 kg)', 'product_category' => 'Pet Collars', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'E.collar- #EL (22.5 -41 kg)', 'product_category' => 'Pet Collars', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Muzzle - #1 (3kg)', 'product_category' => 'Pet Muzzles', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Muzzle - #2 (5kg)', 'product_category' => 'Pet Muzzles', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Muzzle - #3 (10kg)', 'product_category' => 'Pet Muzzles', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Muzzle - #4 (15kg)', 'product_category' => 'Pet Muzzles', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Muzzle - #5 (20kg)', 'product_category' => 'Pet Muzzles', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Muzzle - #6 (25kg)', 'product_category' => 'Pet Muzzles', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => 'Muzzle - #7 (30kg)', 'product_category' => 'Pet Muzzles', 'brand' => 'Unknown', 'unit' => 'piece'],
            ['product_name' => '5 in 1 Vaccine', 'product_category' => 'Vaccines', 'unit' => 'vial', 'brand' => 'Unknown'],
            ['product_name' => 'Kennel Cough Vaccine', 'product_category' => 'Vaccines', 'unit' => 'vial', 'brand' => 'Unknown'],
            ['product_name' => '6 in 1 Vaccine', 'product_category' => 'Vaccines', 'unit' => 'vial', 'brand' => 'Unknown'],
            ['product_name' => '8 in 1 Vaccine', 'product_category' => 'Vaccines', 'unit' => 'vial', 'brand' => 'Unknown'],
            ['product_name' => 'Anti-rabies Vaccine', 'product_category' => 'Vaccines', 'unit' => 'vial', 'brand' => 'Unknown'],
            ['product_name' => 'Singen Recovery Gel for Feline', 'product_category' => 'Medications', 'brand' => 'Singen', 'unit' => 'tube'],
            ['product_name' => 'NexGard Spectra', 'product_category' => 'Medications', 'brand' => 'NexGard', 'unit' => 'tablet'],
            ['product_name' => 'NexGard Combo Praziquante', 'product_category' => 'Medications', 'brand' => 'NexGard', 'unit' => 'piece'],
            ['product_name' => 'Arvore Wound Spray', 'product_category' => 'Medications', 'brand' => 'Arvore', 'unit' => 'bottle'],
            ['product_name' => 'Deltacal', 'product_category' => 'Medications', 'brand' => 'Deltacal', 'unit' => 'bottle'],
            ['product_name' => 'Singen Liquid Recovery Diet', 'product_category' => 'Medications', 'brand' => 'Singen', 'unit' => 'can'],
            ['product_name' => 'Nutrichunks wormshot', 'product_category' => 'Medications', 'brand' => 'Nutrichunks', 'unit' => 'tablet'],
            ['product_name' => 'Pyrantel', 'product_category' => 'Medications', 'brand' => 'Pyrantel', 'unit' => 'tablet'],
            ['product_name' => 'Thrombo Pro', 'product_category' => 'Medications', 'brand' => 'Thrombo Pro', 'unit' => 'boxes'],
            ['product_name' => 'Nova Folha', 'product_category' => 'Medications', 'brand' => 'Nova Folha', 'unit' => 'boxes'],
            ['product_name' => 'Supreme Pro Plus', 'product_category' => 'Medications', 'brand' => 'Supreme Pro', 'unit' => 'boxes'],
            ['product_name' => 'Nutriblend Gel', 'product_category' => 'Medications', 'brand' => 'Nutriblend', 'unit' => 'boxes'],
            ['product_name' => 'Le-VIT Plus', 'product_category' => 'Medications', 'brand' => 'Le-VIT', 'unit' => 'boxes'],
            ['product_name' => 'Nutrichunks Multi-V Yum', 'product_category' => 'Medications', 'brand' => 'Nutrichunks', 'unit' => 'boxes'],
            ['product_name' => 'LC-Dox', 'product_category' => 'Medications', 'brand' => 'LC-Dox', 'unit' => 'boxes'],
            ['product_name' => 'NexGard Combo', 'product_category' => 'Medications', 'brand' => 'NexGard', 'unit' => 'boxes'],
            ['product_name' => 'NexGard Combo', 'product_category' => 'Medications', 'brand' => 'NexGard', 'unit' => 'boxes'],
            ['product_name' => 'NexGard Combo', 'product_category' => 'Medications', 'brand' => 'NexGard', 'unit' => 'boxes'],
            ['product_name' => 'NexGard Spectra', 'product_category' => 'Medications', 'brand' => 'NexGard', 'unit' => 'boxes'],
            ['product_name' => 'NexGard Spectra', 'product_category' => 'Medications', 'brand' => 'NexGard', 'unit' => 'boxes'],

        ];

        foreach ($products as $product) {
            $category = Category::where('category_name', $product['product_category'])->first();
            $unit = Unit::where('unit_name', $product['unit'])->first();
            if (!$unit) {
                $unit = Unit::create(['unit_name' => $product['unit']]);
            }
            if ($category) {
                Products::create([
                    'product_name' => $product['product_name'],
                    'product_category' => $category->id,
                    'brand' => $product['brand'],
                    'unit' => $unit->id,
                    'status' => 0,
                    'SKU' => Faker::create()->numberBetween(100000000000, 999999999999),
                ]);
            }
        }

    }
}
