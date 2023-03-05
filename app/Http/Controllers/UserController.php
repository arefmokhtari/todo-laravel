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
//                ->storeByRequest(function (&$data){
//                    // $data['password'] = Hash::make($data['password'])
//                })
        );
    }

    public function getInfo(): JsonResponse {
        return Helper::result(
            UserAction::init()->getMember()
        );
    }

    /**
     * @throws CustomException
     */
    public function login(Request $request): JsonResponse {
        return Helper::result(
            UserAction::init($request)
                ->setValidationRule('login')
                ->makeEloquentViaRequest()
                ->loginByRequest('email', 'user')
        );
    }

    /**
     * @throws CustomException
     */
    public function update(Request $request): JsonResponse {
        return Helper::result(
          UserAction::init($request)
            ->setValidationRule('update')
            ->makeEloquentViaRequest()
            ->updateMemberByToken()
        );
    }

    /**
     * @throws CustomException
     */
    public function sendCode(Request $request): JsonResponse {
        return Helper::result(
            UserAction::init($request)
                ->setValidationRule('send-code')
                ->makeEloquentViaRequest()
                ->sendCode()
        , ['ok' => 'true', 'message' => 'code sending']);
    }

    /**
     * @throws CustomException
     */
    public function checkOtp(Request $request): JsonResponse {
        return Helper::result(
            UserAction::init($request)
                ->setValidationRule('check-otp')
                ->makeEloquentViaRequest()
                ->checkOtp()
        );
    }
}
