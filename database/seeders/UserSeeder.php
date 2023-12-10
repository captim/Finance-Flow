<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'is_admin' => 1,
            'currency' => 'USD'
        ]);
    }
}
