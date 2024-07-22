<?php

namespace Database\Factories;

use App\Models\Products;
use App\Models\Stocks;
use Illuminate\Database\Eloquent\Factories\Factory;

class StocksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stocks::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'products_id' => Products::factory(),
            'stock' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'unit' => $this->faker->randomElement(['pcs', 'kg', 'ltr']),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
