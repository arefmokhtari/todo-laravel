<?php

namespace App\Actions;

use Genocide\Radiocrud\Services\ActionService\ActionService;
use App\Models\Admin;
use App\Http\Resources\AdminResource;

class AdminAction extends ActionService
{
    private $validates = [
        'login' => [
            'name' => ['string', 'max:150', 'required'],
        ],
    ];

    public function __construct() {
        $this->setModel(Admin::class)->setResource(AdminResource::class)
            ->setValidationRules($this->validates);
        parent::__construct();
    }

    public function login($request){

    }
}
