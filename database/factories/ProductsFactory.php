<?php

namespace Database\Factories;

use App\Models\Products;
use App\Models\Suppliers;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supplier_id' => Suppliers::factory(),
            'product_name' => $this->faker->words(3, true),
            'product_category' => $this->faker->randomElement(['Electronics', 'Books', 'Clothing']),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'unit' => $this->faker->randomElement(['pcs', 'kg', 'ltr']),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
