<?php

namespace App\Traits;

trait HttpResponses{
    protected function success($data, $message = null, $code = 200){

        return response()->json([
            "success"=> 'Request was Successful',
            "message"=> $message,
            "data"=> $data,
        ], $code);
    }

    protected function error($data, $message = null, $code){

        return response()->json([
            "success"=> 'Error has Occurred...',
            "message"=> $message,
            "data"=> $data,
        ], $code);
    }
    
}