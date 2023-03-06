<?php

namespace App\Http\Controllers;

use App\Actions\CategoryAction;
use App\Helpers\Helper;
use Genocide\Radiocrud\Exceptions\CustomException;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
class CategoryController extends Controller
{
    /**
     * @throws CustomException
     */
    public function store(Request $request): JsonResponse {
        return Helper::result(
            CategoryAction::init($request)
                ->setValidationRule('store')
                ->storeByRequest()
        );
    }
}
