<?php

namespace App\Actions;

use App\Helpers\Traits\HasLoginSign;
use Genocide\Radiocrud\Exceptions\CustomException;
use Genocide\Radiocrud\Services\ActionService\ActionService;
use App\Models\Admin;
use App\Http\Resources\AdminResource;
use App\Helpers\Traits\HasInitialize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAction extends ActionService
{
    use HasInitialize, HasLoginSign;

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
