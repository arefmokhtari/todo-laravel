<?php

namespace App\Actions;

use App\Helpers\Classes\MainAction;
use App\Helpers\Traits\HasLogin;
use App\Models\Admin;
use App\Http\Resources\AdminResource;
use Illuminate\Http\Request;


class AdminAction extends MainAction
{
    use HasLogin;

    protected array $validationRules = [
        'login' => [
            'name' => ['string', 'max:70', 'required',],
            'password' => ['string', 'max:150', 'required',],
        ],
    ];

    public function __construct(Request $request = null) {
        $this
            ->setModel(Admin::class)
            ->setResource(AdminResource::class)
            ->setRequest($request);
        parent::__construct();
    }
}
