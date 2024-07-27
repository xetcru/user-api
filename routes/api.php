<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Маршруты для аутентификации
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Защищенные маршруты для управления пользователями
Route::middleware('auth:sanctum')->group(function () {
    Route::get('users', [UserController::class, 'apiIndex']);
    Route::get('users/{id}', [UserController::class, 'apiShow']);
    Route::post('users', [UserController::class, 'apiStore']);
    Route::put('users/{id}', [UserController::class, 'apiUpdate']);
    Route::delete('users/{id}', [UserController::class, 'apiDestroy']);
});

// Маршрут для генерации токена
Route::post('/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'role' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'User not found.'], 404);
    }

    if (!Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Incorrect password.'], 401);
    }

    /*if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'The provided credentials are incorrect.'
        ], 401);
    }*/

    $token = $user->createToken($request->device_name)->plainTextToken;

    return response()->json(['token' => $token]);
});
// Запрос типа:
/*
POST
http://user-api.gro/api/token
raw (JSON):
{
    "email": "adm@xetc.ru",
    "password": "password",
    "role": "admin",
    "device_name": "postman"
}*/