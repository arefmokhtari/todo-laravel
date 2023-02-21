<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Http\Helper\HasAccess;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use HasAccess;
    protected array $accesses = [
        'store',
        'deleteById',
        'updateById',
    ];

    public function __construct(){
        // parent::__construct();
        $this
            ->setAccess($this->accesses)
            ->checkAccess();
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
}
