<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WorkerService;

class WorkerController extends Controller
{
    protected $workerService;

    public function __construct(WorkerService $workerService)
    {
        $this->workerService = $workerService;
    }

    public function filterByOrderTypes(Request $request)
    {
        $request->validate([
            'order_types' => 'required|array',
            'order_types.*' => 'exists:order_types,id'
        ]);

        try {
            $workers = $this->workerService->filterByOrderTypes($request->order_types);
            
            return response()->json([
                'data' => $workers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error filtering workers',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}