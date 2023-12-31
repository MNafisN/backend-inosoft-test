<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $strings = array(
            'mobil',
            'motor',
        );
        $key = array_rand($strings);
        if ($strings[$key] == 'motor') {
            return [
                'nama_kendaraan' => $this->faker->unique()->firstNameMale(),
                'tahun_keluaran' => $this->faker->year($max = 'now'),
                'warna' => $this->faker->colorName(),
                'harga' => $this->faker->numberBetween($min = 1000000, $max = 1000000000),
                'stok' => $this->faker->numberBetween($min = 1000, $max = 10000),
                'terjual' => $this->faker->numberBetween($min = 20, $max = 500),
                'tipe_kendaraan' => $strings[$key],
                'mesin' => $this->faker->domainWord(),
                'tipe_suspensi' => $this->faker->company(),
                'tipe_transmisi' => $this->faker->citySuffix(),
            ];
        } else {
            return [
                'nama_kendaraan' => $this->faker->unique()->firstNameMale(),
                'tahun_keluaran' => $this->faker->year($max = 'now'),
                'warna' => $this->faker->colorName(),
                'harga' => $this->faker->numberBetween($min = 1000000, $max = 1000000000),
                'stok' => $this->faker->numberBetween($min = 1000, $max = 10000),
                'terjual' => $this->faker->numberBetween($min = 20, $max = 500),
                'tipe_kendaraan' => $strings[$key],
                'mesin' => $this->faker->domainWord(),
                'kapasitas_penumpang' => $this->faker->numberBetween($min = 1, $max = 8),
                'tipe' => $this->faker->citySuffix(),
            ];
        }
    }
}
