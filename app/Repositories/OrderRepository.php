<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function createOrder(array $data)
    {
        $data['status'] = 'created';
        return $this->create($data);
    }

    public function assignWorker($orderId, $workerId, $amount)
    {
        $order = $this->find($orderId);
        if ($order) {
            $order->workers()->attach($workerId, ['amount' => $amount]);
            $order->update(['status' => 'assigned']);
            return $order;
        }
        return null;
    }
}