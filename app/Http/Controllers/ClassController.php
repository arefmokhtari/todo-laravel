<?php

namespace App\Http\Controllers;

use App\Http\Helper\Helper;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    //

    public function store(Request $request){
        $validate = Helper::validate($request, Classes::className());

        return Helper::result(Classes::create($validate));
    }
}
