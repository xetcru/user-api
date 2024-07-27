<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Метод для показа формы входа
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Метод для обработки логина
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Если аутентификация успешна, перенаправляем на защищенную страницу
            return redirect()->intended('users');
        }

        // Если аутентификация не удалась, перенаправляем обратно с ошибкой
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    // Метод для выхода из системы
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
