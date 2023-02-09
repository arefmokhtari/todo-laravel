<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Test extends Controller {
    private function getProductTable(){
        return DB::table('products');
    }
    public function getById(string $id){
        $product = $this->getProductTable()->find($id);

        return view('products.show', compact('product'));
    }
    public function get(){
        $products = $this->getProductTable()->get();

        return view('products.index', compact('products'));
    }
}
