<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // Проверка, ожидает ли запрос JSON
    protected function redirectTo($request)
    {
        // Проверка, ожидает ли запрос JSON
        if (! $request->expectsJson()) {
            // Если запрос не ожидает JSON, перенаправляем на страницу логина
            return route('login');
            //return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }

    // Обработка неавторизованных запросов
    public function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated'], 401); // Возвращаем JSON-ответ об ошибке
        }

        //return redirect()->route('login');
        return response()->json(['error' => 'Unauthenticated'], 401);
    }
}
