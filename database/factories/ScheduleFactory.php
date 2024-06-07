<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => \App\Models\Employee::factory(),
            'place_id' => \App\Models\Place::factory(),
            'schedule_type_id' => \App\Models\ScheduleType::factory(),
            'schedule_date' => $this->faker->date(),
            'schedule_time' => $this->faker->time(),
            'schedule_time_end' => $this->faker->time(),
            'qty' => $this->faker->randomDigit(),
        ];
    }
}
