<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if( Auth::attempt(['email' => request('email'), 'password' => request('password')])
            ||Auth::attempt(['phone_number' => request('phone_number'), 'password' => request('password')]) )
        {
            $user =  User::query()->where('email', $request->email)->orWhere('phone_number', $request->phone_number)->first();
            $data['token'] = $user->createToken('user',['app:all'])->plainTextToken;
            $data['name'] =$user->name;
            $data['email'] =$user->email;
            return ApiResponse::sendResponse(201, 'User Logged In Successfully', $data);
        }
        elseif ( ! Auth::attempt($request->only(['email', 'password'])))
        {
            return response()->json([
                'status' => false,
                'message' => 'Credential Of This User Is Wrong Check It Again',
            ], 401);
        }

    }
    public function refreshToken(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $newToken = $user->createToken(' Access Token',  now()->addMinutes(20))->plainTextToken;
        return ApiResponse::sendResponse(201, 'Your New Token', $newToken);
    }
}
