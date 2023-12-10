<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            'title' => 'Доходи'
        ]);
        DB::table('types')->insert([
            'title' => 'Витрати'
        ]);
        DB::table('types')->insert([
            'title' => 'Заощадження'
        ]);
    }
}
