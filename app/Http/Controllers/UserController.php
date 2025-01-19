<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    // Получение списка пользователей
    public function index(Request $request)
    {
        $users = User::all(); // Получаем всех пользователей
        return response()->json($users);
    }

    // Получение конкретного пользователя
    public function show($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        
        return response()->json($user);
    }

    // Обновление пользователя
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $id,
            'password' => 'string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        
        return response()->json($user);
    }

    // Удаление пользователя
    public function destroy($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        
        $user->delete();
        
        return response()->json(['message' => 'User deleted successfully']);
    }
}
