<?php

namespace App\Actions;

use App\Helpers\Classes\MemberAction;
use App\Helpers\Traits\HasLogin;
use Carbon\Carbon;
use Genocide\Radiocrud\Exceptions\CustomException;
use Genocide\Radiocrud\Helpers;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAction extends MemberAction
{
    use HasLogin;
    private int $sendCodeSecond = 30;
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
        'send-code' => [
            'email' => ['string', 'required', 'max:200', 'email', ],
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
        return $this->setEloquent($this->getMember())->updateByRequest();
    }

    public function setRequest(Request|null $request): static {
        if(Helpers::convertToBoolean($request))
            return parent::setRequest($request);
        return $this;
    }

    public function storeByRequest(callable $storing = null): mixed {
        return parent::storeByRequest(storing: function (&$data) {
            $data['password'] = Hash::make($data['password']);
        });
    }

    /**
     * @throws CustomException
     */
    public function sendCode(): void {
        $this->setEloquent($this->getMemberByQuery('email'));

        if(!$this->getEloquent()->otp_expires_at || Carbon::now()->toDate()->diff(Carbon::parse($this->getEloquent()['otp_expires_at'])->toDate())->i > $this->sendCodeSecond) {
            $this->updateByFieldQuery([
                'otp' => rand(1000, 9999),
                'otp_expires_at' => Carbon::now(),
            ]);
        }
    }
}
