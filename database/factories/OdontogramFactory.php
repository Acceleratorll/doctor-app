<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OdontogramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'medical_record_id' => \App\Models\MedicalRecord::factory(),
            'teeth_id' => \App\Models\Teeth::factory(),
            'diastema' => $this->faker->sentence(),
            'anomali' => $this->faker->sentence(),
            'others' => $this->faker->sentence(),
        ];
    }
}
