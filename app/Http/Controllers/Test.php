<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller {
    //

    public function __invoke(): string {

        $names = [
            ['name' => 'aref', 'family' => 'mokhtari'],
            ['name' => 'ali', 'family' => 'miladi'],
        ];

        return view('test', compact('names'));
    }
}
