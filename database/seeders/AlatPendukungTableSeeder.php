<?php

namespace Database\Seeders;

use App\Models\AlatPendukung;
use Illuminate\Database\Seeder;

class AlatPendukungTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alat = [
            [
                'nama_alat' => 'Proyektor',
            ],
            [
                'nama_alat' => 'Microphone',
            ],
        ];

        AlatPendukung::insert($alat);
    }
}
