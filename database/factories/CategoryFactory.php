<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryModel>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    protected $model = Category::class;
    public function definition(): array
    {
        $categories = [
            "Food & Treats",
            "Medications",
            "Supplements",
            "Grooming Supplies",
            "Toys",
            "Bedding & Furniture",
            "Collars, Harnesses & Leashes",
            "Training Aids",
            "Travel & Outdoor",
            "Healthcare Products"
        ];


        $key = array_rand($categories);
        return [
            'category_name' =>  $categories[$key],
        ];
    }
}
