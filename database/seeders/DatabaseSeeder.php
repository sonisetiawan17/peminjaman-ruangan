<?php

namespace Database\Seeders;

use App\Models\BidangKegiatan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(InstansiTableSeeder::class);
        $this->call(AlatPendukungTableSeeder::class);
        $this->call(BidangKegiatanTableSeeder::class);
        $this->call(FasilitasTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        // $this->call(JamTableSeeder::class);
    }
}
