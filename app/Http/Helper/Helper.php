<?php

namespace App\Http\Helper;


class Helper {
    public static function result(bool $ok, string $message, mixed $data, int $status = 200){
        return response()->json([
            'ok' => $ok,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}


