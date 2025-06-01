<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UnitFactory extends Factory
{
    protected $model = Unit::class;

    public function definition()
    {
        $units = [
            "Bottles",
            "Boxes",
            "Capsules",
            "Chews",
            "Kilograms",
            "Liters",
            "Milliliters",
            "Packs",
            "Pieces",
            "Tablets"
        ];

        $key = array_rand($units);
        return [
            'unit_name' => $units[$key],
        ];
    }
}
