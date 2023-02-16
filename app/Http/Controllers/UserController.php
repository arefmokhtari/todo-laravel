<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    private static function validateUser(Request $request, array $any = []){
        return $request->validate([
            'name' => ['string', 'required', ... $any],
            'password' => ['string', 'required',],
        ]);
    }
    public function signUp(Request $request) {
        self::validateUser($request, ['unique:users',]);

        return Helper::result(
          true,
            'user created',
            User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]),
        );
    }

    public function login(Request $request) {
        self::validateUser($request);

        $user = User::where('name', $request->name)->first();

        if($user && Hash::check($request->password ,$user->value('password')))
            return Helper::result(true, 'done', array_merge(['token' => $user->createToken('user_token')->plainTextToken], $user->toArray()));

        return Helper::result(false, 'not found', null, 404);
    }
}
