<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function successResponse($data = null, $message = null, $code = 200)
    {
        return response()->json([
            'message' => $message ?? 'success',
            'data' => $data,
        ], $code);
    }

    public function errorResponse($message = null, $code = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $code);
    }
}
