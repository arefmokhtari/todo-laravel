<?php

namespace App\Actions;

use App\Helpers\Classes\MemberAction;
use App\Helpers\Traits\HasLogin;
use App\Helpers\Traits\HasMember;
use Genocide\Radiocrud\Exceptions\CustomException;
use Genocide\Radiocrud\Helpers;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAction extends MemberAction
{
    use HasLogin, HasMember;
    protected array $validationRules = [
        'store' => [
            'name' => ['string', 'nullable', 'max:200',],
            'password' => ['string', 'required', 'max:200', ],
            'email' => ['string', 'required', 'max:200', 'email', 'unique:users', ], //'regex:/(.+)@(.+)\.(.+)/i'],
        ],
        'update' => [
            'name' => ['string', 'nullable', 'max:200',],
            'email' => ['string', 'nullable', 'max:200', 'email', ],//'unique:users', ],
            'phone_number' => ['string', 'max:50', 'nullable'],
        ],
        'login' => [
            'password' => ['string', 'required', 'max:200', ],
            'email' => ['string', 'required', 'max:200', 'email', ], //'regex:/(.+)@(.+)\.(.+)/i'],
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

    /**
     * @throws CustomException
     */
    public function updateMemberByToken(): bool|int {
        return $this->updateByIdAndRequest($this->getMember()->id);
    }

    public function setRequest(Request|null $request): static {
        if(Helpers::convertToBoolean($request))
            return parent::setRequest($request);
        return $this;
    }

    public function storeByRequest(callable $storing = null): mixed {
        $this->request['password'] = Hash::make($this->getRequest()->password);
        return parent::storeByRequest($storing);
    }


}
