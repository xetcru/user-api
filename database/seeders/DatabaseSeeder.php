<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            PartnershipSeeder::class,
            OrderTypeSeeder::class,
            WorkerSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
            OrderWorkerSeeder::class,
            WorkersExOrderTypeSeeder::class,
        ]);
    }
}
