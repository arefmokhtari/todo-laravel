<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Test extends Controller {
    public function getById(string $id){
        $product = Product::firstWhere('id', $id);

        return view('products.show', compact('product'));
    }
    public function get(){
        $products = Product::all()->sortDesc();

        return view('products.index', compact('products'));
    }

    public function store(Request $request){

        return response()->json([
            'name' => $request->get('name'),
        ]);
    }


}
