<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'second_name' => $this->faker->lastName,
            'surname' => $this->faker->lastName,
            'phone' => $this->faker->unique()->phoneNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
