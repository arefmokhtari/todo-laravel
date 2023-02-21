<?php

namespace App\Http\Helper;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Route;

trait HasAccess {
    private array $access;

    private function checkAccess(){
        if(in_array(Helper::getEndsWith(Route::currentRouteAction()), $this->access) && !auth('admin')->user()->hasAccess())
            throw new ModelNotFoundException('you do not have access', 400);
    }

    public function setAccess(array $accesses){
        $this->access = $accesses;
        return $this;
    }
}
