<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6, true),
            'content' => $this->faker->paragraphs(3, true),
            'employee_id' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl(),
            'publish' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
