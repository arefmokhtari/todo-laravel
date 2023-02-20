<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller { // 1|A4fquVbx0eRt6XuYcmUA8YsXTNCp0L3qfuqw6kZg
    public function signUp(Request $request) {
        self::validateUser($request, ['unique:users',]);

        return Helper::result(User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]));
    }

    public function login(Request $request) {
        self::validateUser($request);

        $user = User::where('name', $request->name)->first();

        if($user && Hash::check($request->password ,$user->value('password')))
            return Helper::result(array_merge(['token' => $user->createToken('user_token')->plainTextToken], $user->toArray()));

        return Helper::result(null, ['statusError' => 404, 'messageError' => 'not found']);
    }

    public function get() {
        return Helper::result(auth('user')->user());
    }

    public function addProfile(Request $request) {
        $validate = $request->validate(['image' => ['required','mimes:jpeg,png,jpg']]);



        return $request;
    }

    public function removeProfile(Request $request) {

    }

    private static function validateUser(Request $request, array $any = []){
        return $request->validate([
            'name' => ['string', 'required', ... $any],
            'password' => ['string', 'required',],
        ]);
    }
}
