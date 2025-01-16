<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Passport\Token;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $tokens = $request->user()->tokens;
        
        return response()->json([
            'sessions' => $tokens->map(function ($token) {
                return [
                    'id' => $token->id,
                    'last_used' => $token->last_used_at,
                    'created_at' => $token->created_at
                ];
            })
        ]);
    }

    public function destroy($tokenId)
    {
        $token = Token::find($tokenId);
        
        if ($token && $token->user_id === auth()->id()) {
            $token->revoke();
            return response()->json(['message' => 'Сессия завершена']);
        }
        
        return response()->json(['message' => 'Сессия не найдена'], 404);
    }
}
