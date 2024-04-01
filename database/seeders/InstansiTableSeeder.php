<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Illuminate\Database\Seeder;

class InstansiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instansiList = [
            'Dinas Pendidikan (Disdik)',
            'Dinas Kesehatan (Dinkes)',
            'Dinas Pekerjaan Umum dan Penataan Ruang (DPUPR)',
            'Dinas Perumahan dan Kawasan Permukiman (Disperkim)',
            'Dinas Sosial, Pengendalian Penduduk dan Keluarga Berencana, Pemberdayaan Perempuan dan Perlindungan Anak (Dinsos P3AP2)',
            'Dinas Perdagangan, Koperasi, Usaha Kecil dan Menengah, dan Perindustrian (Disdaginkop UKM dan Perindustrian)',
            'Dinas Perhubungan (Dishub)',
            'Dinas Kependudukan dan Pencatatan Sipil (Disdukcapil)',
            'Dinas Tenaga Kerja (Disnaker)',
            'Dinas Pangan dan Pertanian (Dispangtan)',
            'Dinas Kebudayaan, Pariwisata, Kepemudaan dan Olahraga (Disbudparpora)',
            'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (DPMPTSP)',
            'Dinas Lingkungan Hidup (DLH)',
            'Dinas Komunikasi, Informatika, Kearsipan dan Perpustakaan (Diskominfoarpus)',
            'Sekretariat Daerah Kota Cimahi (Setda)',
            'Sekretariat Dewan Perwakilan Rakyat Daerah Kota Cimahi (Setwan DPRD)',
            'Inspektorat Kota Cimahi',
            'Kecamatan Cimahi Utara',
            'Kecamatan Cimahi Tengah',
            'Kecamatan Cimahi Selatan',   
            'Lainnya'
        ];

        foreach ($instansiList as $instansiName) {
            Instansi::create([
                'nama_instansi' => $instansiName,
            ]);
        }
    }
}
