<?php
namespace App\Traits;

trait ApiResponses{

    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'        => 'Request was succesful.',
            'status_code'   => $code,
            'message'       => $message,
            'data'          => $data

        ], $code);
    }

    protected function error($data, $message = null, $code = 400)
    {
        return response()->json([
            'status'        => 'Error has occured...',
            'status_code'   => $code,
            'message'       => $message,
            'data'          => $data

        ], $code);
    }
}