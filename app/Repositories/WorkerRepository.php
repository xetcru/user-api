<?php

namespace App\Repositories;

use App\Models\Worker;

class WorkerRepository extends BaseRepository
{
    public function __construct(Worker $model)
    {
        parent::__construct($model);
    }

    /*public function filterByOrderTypes(array $orderTypeIds)
    {
        return $this->model
            ->whereDoesntHave('excludedOrderTypes', function($query) use ($orderTypeIds) {
                $query->whereIn('order_types.id', $orderTypeIds);
            })
            ->orWhereHas('excludedOrderTypes', function($query) use ($orderTypeIds) {
                $query->whereNotIn('order_types.id', $orderTypeIds);
            })
            ->get();
    }*/
    public function filterByOrderTypes(array $orderTypeIds)
    {
        return $this->model
            ->whereDoesntHave('excludedOrderTypes', function ($query) use ($orderTypeIds) {
                $query->whereIn('order_type_id', $orderTypeIds);
            })
            ->get();
    }

    public function hasExcludedOrderType($workerId, $orderTypeId)
    {
        return $this->model
            ->whereHas('excludedOrderTypes', function($query) use ($orderTypeId) {
                $query->where('order_types.id', $orderTypeId);
            })
            ->where('id', $workerId)
            ->exists();
    }
}