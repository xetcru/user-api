<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Погрузка/Разгрузка'],
            ['name' => 'Такелажные работы'],
            ['name' => 'Уборка'],
        ];

        DB::table('order_types')->insert($types);
    }
}
