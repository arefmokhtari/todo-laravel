<?php

namespace App\Helpers\Traits;


trait  HasInitialize {
    public static function init(mixed ... $inits): static {
        return new static(... $inits);
    }
}
