<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request){
        Auth::guard('user')->logout();
        $request->user()->tokens()->delete();
        return ApiResponse::sendResponse('200','user logout');
    }
}
