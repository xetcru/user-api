<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\WorkerController;
use App\Http\Controllers\Api\Auth\SessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:api')->group(function () {
    // Sessions routes
    Route::get('/sessions', [SessionController::class, 'index']);
    Route::delete('/sessions/{token}', [SessionController::class, 'destroy']);

    // Order routes
    Route::post('/orders', [OrderController::class, 'store']);
    Route::post('/orders/{order}/assign', [OrderController::class, 'assignWorker']);

    // Worker routes
    Route::post('/workers/filter', [WorkerController::class, 'filterByOrderTypes']);
});
