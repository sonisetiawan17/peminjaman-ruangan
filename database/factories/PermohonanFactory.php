<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermohonanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'skpd' => $this->faker->randomElement(['skpd', 'non_skpd']),
            'bidang_id' => $this->faker->numberBetween(1, 3), 
            'user_id' => \App\Models\User::factory(),
            'instansi_id' => $this->faker->numberBetween(1, 3), 
            'status_instansi' => $this->faker->word,
            'bidang_instansi' => $this->faker->word,
            'id_jadwal' => $this->faker->word,
            'nama_kegiatan' => $this->faker->sentence,
            'jumlah_peserta' => $this->faker->numberBetween(1, 100),
            'narasumber' => $this->faker->name,
            'output' => $this->faker->word,
            'outcome' => $this->faker->word,
            'ringkasan' => $this->faker->paragraph,
            'surat_permohonan' => $this->faker->word,
            'rundown_acara' => $this->faker->word,
            'id_fasilitas' => $this->faker->word,
            'id_alat' => $this->faker->word,
            'status_permohonan' => $this->faker->randomElement(['Diterima', 'Ditolak', 'Menunggu']),
            'catatan' => $this->faker->sentence,
            'catatan_tolak' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
