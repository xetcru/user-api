<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
//use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /*public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('UserToken')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }*/
    // Регистрация пользователя
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('YourAppName')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /*public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('UserToken')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }*/
    // Логин пользователя
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->accessToken;
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
    // Получить данные пользователя
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
