<?php

namespace App\Helpers\Traits;


trait HasInitialize {
    public static function init(mixed ... $inits) {
        return new self(... $inits);
    }
}
