<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Warning;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
class ProductController extends Controller
{
    private $accsesses = [
        'store',
        'deleteById',
        'updateById',
    ];
    public function __construct(){
        // parent::__construct();
        $this->checkAccess();
    }
    public function store(Request $request){
        return Helper::result(Product::create($request->validate([
            'title' => ['required', 'string'],
            'description' => ['string', 'nullable'],
            'price' => ['integer', 'required'],
        ])));
    }

    public function getById(string $id){
        return Helper::result(Product::query()->findOrFail($id));
    }

    public function get(){
        return Helper::result(Product::all(), ['status' => 200, 'ok' => true]);
    }

    public function deleteById(string $id){
        return Helper::result(null, ['ok' => Product::query()->findOrFail($id)->delete()]);
    }

    public function updateById(string $id, Request $request){
        return Helper::result(Product::query()->findOrFail($id)->update($request->validate([
            'title' => ['nullable', 'string'],
            'description' => ['string', 'nullable'],
            'price' => ['integer', 'nullable'],
        ])));
    }

    /**
     * @throws BadRequestException
     */
    private function checkAccess(){
        if(in_array(Helper::getEndsWith(Route::currentRouteAction()), $this->accsesses) && !auth('admin')->user()->hasAccess())
            throw new BadRequestException('s', 400);
    }
}
