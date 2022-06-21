<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registration(Request $request)
    {
        $user = User::create([
           'phone' => $request->phone,
           'name' => $request->name,
           'password' => Hash::make($request->password),
        ]);

        return $user->createToken('secret')->plainTextToken;
    }
}
