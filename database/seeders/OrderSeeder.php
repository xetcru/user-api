<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderType;
use App\Models\Partnership;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        
        $orderTypes = OrderType::all();
        $partnerships = Partnership::all();
        $users = User::all();

        if ($orderTypes->isEmpty() || $partnerships->isEmpty() || $users->isEmpty()) {
            $this->command->error('One of the required collections (OrderType, Partnership, User) is empty.');
            //
            $this->command->info("OrderType count: " . $orderTypes->count());
            $this->command->info("Partnership count: " . $partnerships->count());
            $this->command->info("User count: " . $users->count());
            //
            return;
        }

        foreach (range(1, 50) as $index) {
            Order::create([
                'type_id' => $orderTypes->random()->id,
                'partnership_id' => $partnerships->random()->id,
                'user_id' => $users->random()->id,
                'description' => $faker->sentence,
                'date' => $faker->dateTimeThisYear,
                'address' => $faker->address,
                'amount' => $faker->randomFloat(2, 100, 10000),
                //'status' => $faker->randomElement(['Создан', 'Назначен исполнитель', 'Завершен']),
                'status' => $faker->randomElement(['created', 'assigned', 'completed']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
