<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory();
            },
            'access_code' => $this->faker->numberBetween(1000, 9999),
            'height' => $this->faker->numberBetween(150, 200),
            'weight' => $this->faker->numberBetween(40, 100),
        ];
    }
}
