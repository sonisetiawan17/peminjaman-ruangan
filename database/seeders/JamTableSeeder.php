<?php

namespace Database\Seeders;

use App\Models\Jam;
use Illuminate\Database\Seeder;

class JamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jam::create(['data_jam' => ["8", "9", "10", "11", "12", "13", "14", "15"]]);
    }
}
