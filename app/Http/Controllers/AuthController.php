<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\LoginRequest;
use App\Models\User;
use App\Http\Requests\auth\RegisterRequest;
use App\Http\Resources\AuthResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login (LoginRequest $request) {

        $validated = $request->validated();

        if(!Auth::attempt($validated))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }
    
        $user = User::where('email', $validated['email'])->first();
    
        return new AuthResource($user);
    }
}
