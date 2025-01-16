<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderType;
use App\Models\Partnership;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Очистка таблиц перед созданием данных
        /*\DB::table('users')->truncate();
        \DB::table('orders')->truncate();
        \DB::table('order_types')->truncate();
        \DB::table('partnerships')->truncate();
        \DB::table('workers')->truncate();*/
        //\DB::table('order_types')->truncate();

        // Сначала создаем типы заказов
        $orderTypes = OrderType::create([
            'name' => 'Тип 1',
        ]);

        $orderTypes2 = OrderType::create([
            'name' => 'Тип 2',
        ]);

        // Создание партнерств
        $partnership1 = Partnership::create([
            'name' => 'Партнер 1',
        ]);

        $partnership2 = Partnership::create([
            'name' => 'Партнер 2',
        ]);

        // Создание пользователей
        /*$user1 = User::create([
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
            'partnership_id' => $partnership1->id,
        ]);*/
        $user1 = User::create([
            'name' => 'User 1',
            'email' => 'user1_' . Str::random(5) . '@example.com', // Уникальный email
            'password' => bcrypt('password'),
            'partnership_id' => $partnership1->id,
        ]);

        /*$user2 = User::create([
            'name' => 'User 2',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
            'partnership_id' => $partnership2->id,
        ]);*/
        $user2 = User::create([
            'name' => 'User 2',
            'email' => 'user2_' . Str::random(5) . '@example.com', // Уникальный email
            'password' => bcrypt('password'),
            'partnership_id' => $partnership2->id,
        ]);

        // Создание заказов
        $order1 = Order::create([
            'type_id' => $orderTypes->id,
            'partnership_id' => $partnership1->id,
            'user_id' => $user1->id,
            'description' => 'Описание заказа 1',
            'date' => now(),
            'address' => 'Адрес 1',
            'amount' => 1000,
            'status' => 'created',
        ]);

        $order2 = Order::create([
            'type_id' => $orderTypes2->id,
            'partnership_id' => $partnership2->id,
            'user_id' => $user2->id,
            'description' => 'Описание заказа 2',
            'date' => now(),
            'address' => 'Адрес 2',
            'amount' => 1500,
            'status' => 'completed',
        ]);

        // Создание работников
        $worker1 = Worker::create([
            'name' => 'Иван',
            'second_name' => 'Иванов',
            'surname' => 'Иван',
            'phone' => '+79991234567',
        ]);

        $worker2 = Worker::create([
            'name' => 'Петр',
            'second_name' => 'Петров',
            'surname' => 'Петр',
            'phone' => '+79997654321',
        ]);

        // Присвоение работников к заказам
        $order1->workers()->attach($worker1->id, ['amount' => 500]);
        $order2->workers()->attach($worker2->id, ['amount' => 700]);

        // Дополнительно можно добавить связи для исключений типа заказов для работников
        $worker1->excludedOrderTypes()->attach($orderTypes2->id);
    }
}
