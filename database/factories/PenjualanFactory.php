<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PenjualanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_kendaraan' => $this->faker->firstNameMale(),
            'nama_pembeli' => $this->faker->name(),
            'jumlah_beli' => $this->faker->numberBetween($min = 1, $max = 10),
        ];
    }
}
