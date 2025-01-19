<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartnershipController;

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

//OLD
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});//*/

Route::post('passport/token', [AuthController::class, 'issueToken']);
Route::post('passport/token/refresh', [AuthController::class, 'refreshToken']);
Route::get('passport/tokens', [AuthController::class, 'getTokens']);
Route::delete('passport/tokens/{token}', [AuthController::class, 'revokeToken']);

// Защищенные аутентификацией маршруты
Route::middleware('auth:api')->group(function () {
    //Route::get('passport/clients', [PartnershipController::class, 'index']);
    //Route::get('passport/clients/{id}', [PartnershipController::class, 'show']);
    // Маршруты для работы с пользователями (можно их оставить или использовать по вашему усмотрению)
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    // Маршруты для работы с компаниями (клиентами)
    Route::get('passport/clients', [PartnershipController::class, 'index']); // Получение списка компаний
    Route::get('passport/clients/{id}', [PartnershipController::class, 'show']); // Получение конкретной компании
    Route::post('passport/clients', [PartnershipController::class, 'store']); // Создание новой компании
    Route::put('passport/clients/{client_id}', [PartnershipController::class, 'update']); // Обновление компании
    Route::delete('passport/clients/{client_id}', [PartnershipController::class, 'destroy']); // Удаление компании
});