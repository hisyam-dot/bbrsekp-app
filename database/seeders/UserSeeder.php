<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $admin = User::firstOrCreate(
            [
                'name' => 'Admin BBRSEKP',
                'email' => 'admin@bbrsekp.go.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
        $admin->assignRole('admin');

        $pegawai = User::firstOrCreate(
            [
                'name' => 'Pegawai BBRSEKP',
                'email' => 'pegawai@bbrsekp.go.id', 
                'password' => Hash::make('password'),
                'role' => 'pegawai',
            ]
        );
        $pegawai->assignRole('pegawai');
    }
}
