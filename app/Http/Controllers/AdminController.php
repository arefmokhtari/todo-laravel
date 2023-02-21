<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Helper\HasAccess;
use App\Http\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use HasAccess;
    public function __construct(){
        $this
            ->setAccess(['store'])
            ->checkAccess();
    }
    //
    public function login(Request $request){
        $validate = self::validateAdmin($request);

        $admin = Admin::query()->where('name', $validate['name'])->first();

        if($admin && Hash::check($validate['password'], $admin->password))
            return Helper::result(array_merge(['token' => $admin->createToken('admin_token')->plainTextToken], $admin->toArray()));

        return Helper::result(null, ['messageError' => 'pass | name is wrong', 'statusError' => 404]);
    }

    public function store(Request $request){
        $validate = self::validateAdmin($request);

        return Helper::result(Admin::create(array_merge($validate, ['password' => Hash::make($validate['password'])])));
    }

    private static function validateAdmin(Request $request): array {
        return $request->validate([
            'name' => ['required', 'string', 'unique:admins'],
            'password' =>  ['required', 'string'],
            'permission' => ['boolean', 'nullable'],
        ]);
    }
}
