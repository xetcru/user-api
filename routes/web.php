<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\MailTestController;

Route::get('/', function () {
    return view('welcome'); // Или любой другой маршрут, который вы хотите использовать
});
// Роуты для аутентификации
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Защищенные маршруты для управления пользователями
Route::middleware('auth')->group(function () {
    Route::get('users', [UserController::class, 'webIndex'])->name('users.index');
    Route::get('users/create', [UserController::class, 'webCreate'])->name('users.create');
    Route::post('users', [UserController::class, 'webStore'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'webEdit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'webUpdate'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'webDestroy'])->name('users.destroy');
    Route::get('users/{id}', [UserController::class, 'webShow'])->name('users.show');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

// для почты
Route::get('/send-test-mail', [MailTestController::class, 'sendTestMail']);
