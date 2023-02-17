<?php

namespace App\Http\Helper;

use Illuminate\Http\Request;

class Helper {
    public static function validate(Request $request, string $tableName){
        return $request->validate([
            'name' => ['string', 'unique:'.$tableName, 'required'],
        ]);
    }
    public static function validateAddClass(Request $request){
        return $request->validate([
            'class_id' => ['integer', 'required'],
            'student_id' => ['integer', 'required'],
        ]);
    }
    public static function result(mixed $data, array $manager = ['ok' => null,'message' => null, 'messageError' => null, 'status' => 200, 'statusError' => 400]){
        return response()->json([
            'ok' => $manager['ok'] ?? !empty($data),
            'message' => $manager['ok'] ?? !empty($data) ? $manager['message'] ?? 'ok' : $manager['messageError'] ?? 'error',
            'data' => $data,
        ], $manager['ok'] ?? !empty($data) ? $manager['status'] ?? 200 : $manager['statusError'] ?? 400 );
    }
}
