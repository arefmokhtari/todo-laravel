<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    //
    private function getProducts($id = null){
        return $id ? Product::query()->find($id) : Product::all();
    }
    public function get(){
        $products = $this->getProducts();

        return response()->json([
            'ok' => true,
            'count' => $products->count(),
            'data' => $products,
        ]);
    }

    public function store(Request $request){
        $validate = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => 'nullable|string|max:500',
            'price' => 'integer|required',
        ]);

        $store = Product::create($validate);

        return response()->json([
            'ok' => true,
            'data' => $store,

        ]);
    }
    public function deleteById(int $id){
//        $product = $this->getProducts($id);
//
//        $product?->delete();

        Product::query()->where('id', $id)->delete();

//        return response()->json([
//            'ok' => !empty($product),
//            'data' => [ 'message' =>  empty($product) ? 'product not found' : 'done' ],
//        ], empty($product) ? 404 : 200);

        return response()->json([
            'message' => 'product deleted successfully'
        ]);
    }
    public function updateById(string $id, Request $request){
        // $product = $this->getProducts($id);

        $validate = $request->validate([
            'title' => 'string|max:100',
            'description' => 'string|max:500',
            'price' => 'integer',
        ]);

        // $product?->update($validate);

        Product::query()->where('id', $id)->update($validate);

//        return response()->json([
//            'ok' => !empty($product),
//            'data' => [ 'message' =>  empty($product) ? 'product not found' : 'done' ],
//        ], empty($product) ? 404 : 200);

        return response()->json([
            'message' => 'ok'
        ]);
    }

    public function getById(int $id){
        $product = $this->getProducts($id);

        return response()->json([
           'ok' => !empty($product),
           'data' => $product,
        ], empty($product) ? 404 : 200);
    }
}
