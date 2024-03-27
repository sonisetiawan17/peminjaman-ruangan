<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin123'),
        ]);

        $super_admin->assignRole('super-admin');

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'tipe' => 'admin',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $user = User::create(
            [
                'name' => 'Soni Setiawan',
                'email' => 'sonisetiawan059@gmail.com',
                'password' => bcrypt('rahasiabanget'),
                'nik' => '3273070747000001',
                'no_telp' => '085219881523',
                'nama_organisasi' => 'Dicoding',
            ],
        );

        $user->assignRole('user');

        $user2 = User::create(
            [
                'name' => 'Michael',
                'email' => 'michael@gmail.com',
                'password' => bcrypt('rahasiabanget'),
                'nik' => '3273070747000002',
                'no_telp' => '081546573271',
                'nama_organisasi' => 'Dicoding',
            ],
        );

        $user2->assignRole('user');
    }
}
