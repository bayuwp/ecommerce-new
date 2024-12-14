<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pelanggan>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Pelanggan::class;

    public function definition()
    {
        return [
            'nama_lengkap' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'email' => $this->faker->unique()->safeEmail(),
            'nomer_hp' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'foto_profil' => $this->faker->imageUrl(100, 100, 'people', true, 'profil'),
        ];
    }
}
