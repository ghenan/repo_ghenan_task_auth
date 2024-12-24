<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailRequest;
use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class EmailController extends Controller
{
   private  $otp;
    public function __construct()
    {
        $this->otp =new Otp;
    }
    public function sendEmail(SendEmailRequest $request)
    {
        $otp2 = $this->otp->validate($request->email,$request->otp);
        if (! $otp2->status){
            return response()->json(['error'=>$otp2],401);
        }
        $user =User::where('email',$request->email)->first();
        $user->update(['email_verified_at' => now()]);
        $success['success']=true;
        return response()->json($success,200);
    }
}
