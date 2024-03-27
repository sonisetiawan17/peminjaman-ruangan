<?php

namespace Database\Seeders;

use App\Models\BidangKegiatan;
use Illuminate\Database\Seeder;

class BidangKegiatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bidang = [
            [
                'nama_bidang' => 'Bidang Penanaman Modal'
            ],
            [
                'nama_bidang' => 'Bidang Pembangunan'
            ],
            [
                'nama_bidang' => 'Bidang Perekonomian'
            ]
        ];

        BidangKegiatan::insert($bidang);
    }
}
