<?php

namespace App\Services;

use App\Repositories\WorkerRepository;

class WorkerService
{
    protected $workerRepository;

    public function __construct(WorkerRepository $workerRepository)
    {
        $this->workerRepository = $workerRepository;
    }

    public function filterByOrderTypes(array $orderTypeIds)
    {
        return $this->workerRepository->filterByOrderTypes($orderTypeIds);
    }
}