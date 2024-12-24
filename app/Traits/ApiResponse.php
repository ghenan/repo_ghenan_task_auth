<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait  ApiResponse
{
    public static function sendResponse($code = 200, $msg = null, $data = null)
    {
        $response = [
            'status' => $code,
            'msg' => $msg,
            'data' => $data,
        ];

        return response()->json($response, $code);
    }

}
