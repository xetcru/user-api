<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Worker;
use App\Models\OrderType;
use App\Models\Partnership;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $partnership;
    private $orderType;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->partnership = Partnership::factory()->create();
        $this->user = User::factory()->create(['partnership_id' => $this->partnership->id]);
        $this->orderType = OrderType::create(['name' => 'Test Type']);
        
        Passport::actingAs($this->user);
    }

    public function test_can_create_order()
    {
        $orderData = [
            'type_id' => $this->orderType->id,
            'partnership_id' => $this->partnership->id,
            'description' => 'Test description',
            'date' => '2025-02-01',
            'address' => 'Test address',
            'amount' => 1000
        ];

        $response = $this->postJson('/api/orders', $orderData);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'message',
                    'data' => [
                        'id',
                        'type_id',
                        'partnership_id',
                        'user_id',
                        'description',
                        'date',
                        'address',
                        'amount',
                        'status'
                    ]
                ]);
    }

    public function test_can_assign_worker_to_order()
    {
        $order = Order::factory()->create([
            'type_id' => $this->orderType->id,
            'partnership_id' => $this->partnership->id,
            'user_id' => $this->user->id,
            'status' => 'created'
        ]);

        $worker = Worker::factory()->create();

        $response = $this->postJson("/api/orders/{$order->id}/assign", [
            'worker_id' => $worker->id,
            'amount' => 500
        ]);

        $response->assertOk()
                ->assertJsonStructure([
                    'message',
                    'data'
                ]);

        $this->assertDatabaseHas('order_worker', [
            'order_id' => $order->id,
            'worker_id' => $worker->id
        ]);
    }

    public function test_cannot_assign_worker_with_excluded_order_type()
    {
        $order = Order::factory()->create([
            'type_id' => $this->orderType->id,
            'partnership_id' => $this->partnership->id,
            'user_id' => $this->user->id,
            'status' => 'created'
        ]);

        $worker = Worker::factory()->create();
        $worker->excludedOrderTypes()->attach($this->orderType->id);

        $response = $this->postJson("/api/orders/{$order->id}/assign", [
            'worker_id' => $worker->id,
            'amount' => 500
        ]);

        $response->assertStatus(400)
                ->assertJson([
                    'message' => 'Error assigning worker',
                    'error' => 'Worker has excluded this order type'
                ]);
    }
}