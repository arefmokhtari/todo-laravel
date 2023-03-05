<?php

namespace App\Helpers\Classes;

use App\Helpers\Traits\HasInitialize;
use Genocide\Radiocrud\Services\ActionService\ActionService;

class MainAction extends ActionService {
    use HasInitialize;

    public function updateByFieldQuery(array $querys): bool|int {
        foreach ($querys as $field => $value)
            $this->getEloquent()[$field] = $value;

        return $this->getEloquent()->update();
    }


}

