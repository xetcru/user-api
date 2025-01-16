<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\AssignWorkerRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(CreateOrderRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            
            $order = $this->orderService->createOrder($data);
            
            return response()->json([
                'message' => 'Order created successfully',
                'data' => $order
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating order',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function assignWorker($orderId, AssignWorkerRequest $request)
    {
        try {
            $data = $request->validated();
            
            $order = $this->orderService->assignWorker(
                $orderId,
                $data['worker_id'],
                $data['amount']
            );
            
            return response()->json([
                'message' => 'Worker assigned successfully',
                'data' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error assigning worker',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}