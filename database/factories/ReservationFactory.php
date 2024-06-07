<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => \App\Models\Patient::factory(),
            'schedule_id' => \App\Models\Schedule::factory(),
            'reservation_code' => $this->faker->ean13,
            'nomor_urut' => $this->faker->numberBetween(1, 100),
            'bukti_pembayaran' => $this->faker->imageUrl,
            'bpjs' => $this->faker->boolean,
            'ktp' => $this->faker->imageUrl,
            'surat_rujukan' => $this->faker->imageUrl,
            'bpjs_card' => $this->faker->imageUrl,
            'approve' => $this->faker->boolean,
            'status' => $this->faker->boolean,
            'reject_reason' => $this->faker->text,
        ];
    }
}
