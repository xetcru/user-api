<?php

namespace Database\Factories;

use App\Models\OrderType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderTypeFactory extends Factory
{
    protected $model = OrderType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'Погрузка/Разгрузка', 
                'Такелажные работы', 
                'Уборка'
            ]),
        ];
    }
}
