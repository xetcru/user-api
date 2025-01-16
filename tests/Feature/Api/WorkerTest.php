<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Worker;
use App\Models\OrderType;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkerTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $orderTypes;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Passport::actingAs($this->user);
        
        $this->orderTypes = collect([
            OrderType::create(['name' => 'Type 1']),
            OrderType::create(['name' => 'Type 2']),
            OrderType::create(['name' => 'Type 3'])
        ]);
    }

    public function test_can_filter_workers_by_order_types()
    {
        // Создаем работников
        $worker1 = Worker::factory()->create();
        $worker2 = Worker::factory()->create();
        $worker3 = Worker::factory()->create();

        // Работник 1 исключает тип 1
        $worker1->excludedOrderTypes()->attach($this->orderTypes[0]->id);
        
        // Работник 2 исключает типы 1 и 2
        $worker2->excludedOrderTypes()->attach([
            $this->orderTypes[0]->id,
            $this->orderTypes[1]->id
        ]);
        
        // Работник 3 не исключает ничего

        // Тест 1: Поиск по типу 1
        $response = $this->postJson('/api/workers/filter', [
            'order_types' => [$this->orderTypes[0]->id]
        ]);

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));

        // Тест 2: Поиск по типам 1 и 2
        $response = $this->postJson('/api/workers/filter', [
            'order_types' => [
                $this->orderTypes[0]->id,
                $this->orderTypes[1]->id
            ]
        ]);

        $response->assertOk();
        $this->assertCount(1, $response->json('data'));

        // Тест 3: Поиск по типу 3
        $response = $this->postJson('/api/workers/filter', [
            'order_types' => [$this->orderTypes[2]->id]
        ]);

        $response->assertOk();
        $this->assertCount(3, $response->json('data'));
    }
}