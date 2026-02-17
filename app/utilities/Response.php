<?php

namespace App\utilities;

use Illuminate\Http\JsonResponse;

class Response
{
    public static function json($data, $message = "", $status = true, $errors = null,$response_status=200): JsonResponse
    {
        if ($errors === null)
            return response()->json(["status" => $status, "message" => $message, "data" => $data])->setStatusCode($response_status);
        else
            return response()->json(["status" => false, "message" => $message, "errors" => $errors])->setStatusCode($response_status);
    }



}
