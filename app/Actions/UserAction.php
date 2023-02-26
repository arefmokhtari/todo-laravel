<?php

namespace App\Actions;

use Genocide\Radiocrud\Services\ActionService\ActionService;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserAction extends ActionService
{
    public function __construct()
    {
        $this->setModel(User::class)->setResource(UserResource::class);
        parent::__construct();
    }
}
