<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\JWT;


class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validated = $request->only('phone', 'password');

//        $validated['foo'] = 'bar';
        $token = Auth::attempt($validated);
//        Auth::user()->update([
//            'foo' => 'bar'
//        ]);
        $user = Auth::user();

        return $this->respondWithToken($token, $user);
    }

    public function logout($token)
    {
        return response()->json([
            'message' => 'разлогинился'
        ]);
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function user()
    {
        return Auth::user();
    }
}
