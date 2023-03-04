<?php


namespace App\Helpers;

use \Illuminate\Http\JsonResponse;

class Helper {
    public static function result(mixed $data, array $manager = ['ok' => null,'message' => null, 'messageError' => null, 'status' => 200, 'statusError' => 400]): JsonResponse {
        return response()->json([
            'ok' => $manager['ok'] ?? !empty($data),
            'message' => $manager['ok'] ?? !empty($data) ? $manager['message'] ?? 'ok' : $manager['messageError'] ?? 'error',
            'data' => $data,
        ], $manager['ok'] ?? !empty($data) ? $manager['status'] ?? 200 : $manager['statusError'] ?? 400 );
    }
}
