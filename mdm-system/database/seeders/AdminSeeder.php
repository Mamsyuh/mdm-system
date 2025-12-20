<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ← wajib
use Illuminate\Support\Facades\Hash; // untuk password

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@desa.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);
    }
}
