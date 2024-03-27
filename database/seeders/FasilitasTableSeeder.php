<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fasilitas = [
            [
                'nama_fasilitas' => 'Multimedia',
            ],
            [
                'nama_fasilitas' => 'Aula'
            ],
            [
                'nama_fasilitas' => 'Ruang Rapat'
            ]
        ];

        Fasilitas::insert($fasilitas);
    }
}
