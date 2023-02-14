<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {
    //

    public function register(Request $request){
        $req = $request->validate([
           'name' => 'required|string',
           'password' =>  'required|string',
        ]);

        $admin = Admin::where('name', $req['name'])->first();

        if($admin && Hash::check($req['password'],$admin->value('password')))
            return response()->json([
                'ok' => true,
                'data' => [
                    'admin' => $admin,
                    'token' => $admin->createToken('admin_token')->plainTextToken,
                ],
            ]);

        return response()->json([
            'ok' => false,
            'data' => [
                'message' => 'not found',
            ],
        ], 404);
    }


    public function test(){

        $admin = Admin::create([
            'name' => 'aref',
            'password' => Hash::make('aref'),
        ]);

        return response()->json([
           'ok' => 'true',
            'data' => [
                'message' => 'admin created',
            ],
        ]);
    }
}
