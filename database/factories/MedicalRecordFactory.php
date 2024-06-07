<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reservation_id' => null,
            'icd_code' => $this->faker->randomElement(['C00', 'A00']),
            'desc' => $this->faker->paragraph,
            'action' => $this->faker->sentence,
            'complaint' => $this->faker->sentence,
            'physical_exam' => $this->faker->sentence,
            'diagnosis' => $this->faker->sentence,
            'recommendation' => $this->faker->sentence,
            'recipe' => $this->faker->sentence,
            'occlusi' => $this->faker->randomElement(['normal', 'cross', 'steep']),
            'palatum' => $this->faker->randomElement(['dalam', 'sedang', 'rendah']),
            'torus_palatinus' => $this->faker->randomElement(['tidak ada', 'kecil', 'sedang', 'besar']),
            'torus_mandibularis' => $this->faker->randomElement(['tidak ada', 'sisi kiri', 'sisi kanan', 'kedua sisi']),
        ];
    }
}
