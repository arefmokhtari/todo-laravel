<?php

namespace App\Http\Helper;


class Helper {
    
    public static function result(mixed $data, array $manager = ['ok' => null,'message' => null, 'messageError' => null, 'status' => 200, 'statusError' => 400]){
        return response()->json([
            'ok' => $manager['ok'] ?? !empty($data),
            'message' => $manager['ok'] ?? !empty($data) ? $manager['message'] ?? 'ok' : $manager['messageError'] ?? 'error',
            'data' => $data,
        ], $manager['ok'] ?? !empty($data) ? $manager['status'] ?? 200 : $manager['statusError'] ?? 400 );
    }
}


