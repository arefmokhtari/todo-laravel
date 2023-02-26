<?php

namespace App\Http\Controllers;

use App\Actions\AdminAction;
use App\Helpers\Helper;
use Genocide\Radiocrud\Exceptions\CustomException;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller {

    /**
     * @throws CustomException
     */
    public function login(Request $request): JsonResponse {
        return Helper::result(
            AdminAction::init($request)
                ->setValidationRule('login')
                ->makeEloquentViaRequest()
                ->login()
        );
    }
}
