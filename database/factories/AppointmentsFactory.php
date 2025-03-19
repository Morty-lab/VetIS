<?php

namespace Database\Factories;

use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointments>
 */
class AppointmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Appointments::class;
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-6months', '+3months');

        return [
            'owner_id' => $this->faker->numberBetween(1, 10),
            'pet_ID' => $this->faker->numberBetween(1, 10),
            'doctor_ID' => $this->faker->numberBetween(1, 10),
            'appointment_date' => $date,
            'appointment_time' => $this->faker->time(),
            'priority_number' => 'W-' . $this->faker->numberBetween(1, 10),
            'status' => ($date < Carbon::now()) ? 1 : 0,
            'purpose' => $this->faker->sentence(),

        ];
    }
}
