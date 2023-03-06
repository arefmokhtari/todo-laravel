<?php

namespace App\Helpers\Classes;

use App\Helpers\Traits\HasInitialize;
use Genocide\Radiocrud\Helpers;
use Genocide\Radiocrud\Services\ActionService\ActionService;
use Illuminate\Http\Request;

class MainAction extends ActionService {
    use HasInitialize;

    public function updateByFieldQuery(array $querys): bool|int {
        foreach ($querys as $field => $value)
            $this->getEloquent()[$field] = $value;

        return $this->getEloquent()->update();
    }

    public function setRequest(Request|null $request): static {
        if(Helpers::convertToBoolean($request))
            return parent::setRequest($request);
        return $this;
    }
}

