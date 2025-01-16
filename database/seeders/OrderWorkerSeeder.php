<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Worker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;

class OrderWorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        $orders = Order::all();
        $workers = Worker::all();

        foreach ($orders as $order) {
            $worker = $workers->random();

            DB::table('order_worker')->insert([
                'order_id' => $order->id,
                'worker_id' => $worker->id,
                'amount' => $faker->randomFloat(2, 100, 10000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
