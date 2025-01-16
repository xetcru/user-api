<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_types')->insert([
            ['name' => 'Погрузка/Разгрузка'],
            ['name' => 'Такелажные работы'],
            ['name' => 'Уборка'],
        ]);
    }
}
