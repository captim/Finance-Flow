<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'title' => 'Заклади',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Продукти',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Комунальні',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Аптека й лікарні',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Транспорт',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Підписки',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Донати',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Догляд',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Песдюк',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Одяг',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Хоббі',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Борги',
            'users_id' => 1,
            'types_id' => 1
        ]);
        DB::table('categories')->insert([
            'title' => 'Інше',
            'users_id' => 1,
            'types_id' => 1
        ]);
    }
}
