<?php

namespace Database\Factories;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
{
    protected $model = Worker::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'second_name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber
        ];
    }
}
