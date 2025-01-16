<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\WorkerRepository;

class OrderService
{
    protected $orderRepository;
    protected $workerRepository;

    public function __construct(
        OrderRepository $orderRepository,
        WorkerRepository $workerRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->workerRepository = $workerRepository;
    }

    public function createOrder(array $data)
    {
        return $this->orderRepository->createOrder($data);
    }

    public function assignWorker($orderId, $workerId, $amount)
    {
        $order = $this->orderRepository->find($orderId);
        
        if (!$order) {
            throw new \Exception('Order not found');
        }

        if ($this->workerRepository->hasExcludedOrderType($workerId, $order->type_id)) {
            throw new \Exception('Worker has excluded this order type');
        }

        return $this->orderRepository->assignWorker($orderId, $workerId, $amount);
    }
}