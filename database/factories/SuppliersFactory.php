<?php

namespace Database\Factories;

use App\Models\Suppliers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SuppliersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suppliers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supplier_name' => $this->faker->company,
            'supplier_address' => $this->faker->address,
            'supplier_email_address' => $this->faker->unique()->safeEmail,
            'supplier_phone_number' => $this->faker->phoneNumber,
            'supplier_contact_person' => $this->faker->name,
        ];
    }
}
