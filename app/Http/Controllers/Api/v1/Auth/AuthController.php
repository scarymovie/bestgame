<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->only('phone', 'password');

        Auth::attempt($validated);

        $user = Auth::user();

        $token = $user->createToken('secret')->plainTextToken;

        $cookie = cookie('jwt', $token, 60*24); // 1 day

        return response()->json()->withCookie($cookie);
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        return response()->json([
            'message' => 'разлогинился'
        ])->withCookie($cookie);
    }

    public function user()
    {
        return Auth::user();
    }
}
