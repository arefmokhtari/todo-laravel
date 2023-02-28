<?php

namespace App\Actions;

use App\Helpers\Traits\HasLoginSign;
use Genocide\Radiocrud\Services\ActionService\ActionService;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Helpers\Traits\HasInitialize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAction extends ActionService
{
    use HasInitialize, HasLoginSign;
    protected array $validationRules = [
        'store' => [
            'name' => ['string', 'nullable', 'max:200',],
            'password' => ['string', 'required', 'max:200', ],
            'email' => ['string', 'required', 'max:200', 'email', 'unique:users', ], //'regex:/(.+)@(.+)\.(.+)/i'],
        ],
        'update' => [
            'name' => ['string', 'nullable', 'max:200',],
            'email' => ['string', 'nullable', 'max:200', 'email', 'unique:users', ],
        ],
    ];
    public function __construct(Request $request = null)
    {
        $this
            ->setModel(User::class)
            ->setResource(UserResource::class)
            ->setRequest($request);
        parent::__construct();
    }

    public function storeByRequest(callable $storing = null): mixed {
        $this->request['password'] = Hash::make($this->getRequest()->password);

        return parent::storeByRequest($storing);
    }
}
