<?php

namespace App\Traits;

trait HttpResponse {
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'successfull' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function error($data, $message = null, $code = 400)
    {
        return response()->json([
            'successfull' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

}

