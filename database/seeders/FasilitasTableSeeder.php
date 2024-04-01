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
                'nama_fasilitas' => 'Area Selasar',
                'kapasitas' => '25',
                'lokasi' => 'Lantai 1',
                'fasilitas' => 'Area kosong disusuaikan dengan pemanfaatan/ penggunaan',
                'waktu_pemanfaatan' => "Senin s/d Jum'at",
                'file' => '/assets/img/auth/selasar.jpg'
            ],
            [
                'nama_fasilitas' => 'Ruang Rapat DPMPTSP',
                'kapasitas' => '20',
                'lokasi' => 'Lantai 2',
                'fasilitas' => 'Area kosong disusuaikan dengan pemanfaatan/ penggunaan',
                'waktu_pemanfaatan' => "Senin s/d Jum'at",
                'file' => '/assets/img/auth/ruang-rapat-dpmptsp.jpg'
            ],
            [
                'nama_fasilitas' => 'Ruang Rapat Umum',
                'kapasitas' => '10',
                'lokasi' => 'Lantai 2',
                'fasilitas' => '10 kursi rapat, meja  rapat dan TV LCD',
                'waktu_pemanfaatan' => "Senin s/d Jum'at",
                'file' => '/assets/img/auth/ruang-rapat-umum.jpg'
            ],
            [
                'nama_fasilitas' => 'Ruang Rapat Terbatas',
                'kapasitas' => '10',
                'lokasi' => 'Lantai 4',
                'fasilitas' => '10 kursi rapat, meja  rapat dan TV LCD',
                'waktu_pemanfaatan' => "Senin s/d Jum'at",
                'file' => '/assets/img/auth/ruang-rapat-terbatas.jpg'
            ],
            [
                'nama_fasilitas' => 'Ruang Ballroom',
                'kapasitas' => '100 - 200 (sesuai layout kegiatan)',
                'lokasi' => 'Lantai 4',
                'fasilitas' => '12 round table + 72 kursi chitose , 200 kursi (untuk kegiatan yang tidak menggunakan round table)  vidiowall, sound system, standing MIC dan ruang operator',
                'waktu_pemanfaatan' => "Senin s/d Jum'at",
                'file' => '/assets/img/auth/ballroom.jpg'
            ],
            [
                'nama_fasilitas' => 'Ruang Multimedia',
                'kapasitas' => '30',
                'lokasi' => 'Lantai 4',
                'fasilitas' => '30 kursi, vidiotron indoor, MIC dan ruang operator',
                'waktu_pemanfaatan' => "Senin s/d Jum'at",
                'file' => '/assets/img/auth/multimedia.jpg'
            ],
            [
                'nama_fasilitas' => 'Ruang Podcast',
                'kapasitas' => '4',
                'lokasi' => 'Lantai 4',
                'fasilitas' => 'Seluruh perlengkapan pendukung siaran',
                'waktu_pemanfaatan' => "Selasa s/d Kamis",
                'file' => '/assets/img/auth/podcast.jpg'
            ]
        ];

        Fasilitas::insert($fasilitas);
    }
}
