<?php


namespace App\Http\Helper;
use Illuminate\Support\Str;

trait ClassName {
    public static function className() {
        return Str::plural(strtolower(basename(str_replace('\\', '/', get_called_class()))));
    }
}
