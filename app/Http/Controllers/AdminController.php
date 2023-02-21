<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function login(Request $request){
        $validate = $request->validate([
            'name' => ['required', 'string'],
            'password' =>  ['required', 'string'],
        ]);

        $admin = Admin::query()->where('name', $validate['name'])->first();

        if($admin && Hash::check($validate['password'], $admin->password))
            return Helper::result(array_merge(['token' => $admin->createToken('admin_token')->plainTextToken], $admin->toArray()));

        return Helper::result(null, ['messageError' => 'pass | name is wrong', 'statusError' => 404]);
    }
}
