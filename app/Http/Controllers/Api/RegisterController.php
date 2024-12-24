<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use App\Traits\UploadImage;
use Illuminate\Support\Facades\Hash;
use App\Notifications\EmailVerificationNotification;

class RegisterController extends Controller
{ use UploadImage ;
   public function register(RegisterRequest $request)
   {
       $user_new = $request->all();
       $user_new['password']=Hash::make($request['password']);
       $user = User::query()->create($user_new);
       self::upload($request , $user , 'files' , 'files of signup');
       $success['token']    = $user->createToken('user')->plainTextToken;
       $success['name']     = $user->full_name;
    $user->notify(new EmailVerificationNotification());
       return ApiResponse::sendResponse('200','Welcome User',$success );
   }
}
