<?php

namespace App\Http\Controllers;

use App\Actions\UserAction;
use App\Helpers\Helper;
use Genocide\Radiocrud\Exceptions\CustomException;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;

class UserController extends Controller {
    //
    /**
     * @throws CustomException
     */
    public function store(Request $request): JsonResponse {
        return Helper::result(
            UserAction::init($request)
                ->setValidationRule('store')
                ->storeByRequest()
        );
    }

    public function get(){
        // dd(auth()->user());

        return Helper::result(
            ['ok' => true],
        );
    }

    public function login(Request $request) {
        return Helper::result(
            UserAction::init($request)
            ->setValidationRule('login')
            ->makeEloquentViaRequest()
            ->loginByRequest('email', 'user')
        );
    }
}
