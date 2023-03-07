<?php

namespace App\Actions;

use App\Helpers\Classes\MainAction;
use App\Helpers\Traits\HasLogin;
use App\Mail\SencCodeMail;
use Carbon\Carbon;
use Genocide\Radiocrud\Exceptions\CustomException;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserAction extends MainAction
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
            'email' => ['required', 'max:200', 'email', ],
        ],
        'check-otp' => [
            'email' => ['required', 'max:200', 'email', ],
            'otp' => ['required', 'integer', ],
        ],
        'change-password' => [
            'current_password' => ['string', 'nullable', 'max:200', ],
            'new_password' => ['string', 'required', 'max:200', ],
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
        return $this->setEloquent($this->getUserFromRequest())->updateByRequest();
    }

    public function storeByRequest(callable $storing = null): mixed {
        return parent::storeByRequest(storing: function (&$data) {
            $data['password'] = Hash::make($data['password']);
        });
    }

    /**
     * @throws CustomException
     */
    public function sendCode(): null {
        $this->setUserByEmail();

        if(!$this->getEloquent()->otp_expires_at || Carbon::now()->diff(Carbon::parse($this->getEloquent()['otp_expires_at']))->i > $this->sendCodeSecond) {
            $this->updateByFieldQuery([
                'otp' => rand(1000, 9999),
                'otp_expires_at' => Carbon::now(),
            ]);
            Mail::to($this->getEloquent())->send(SencCodeMail::init($this->getEloquent()->otp));
        }
        return ;
    }

    /**
     * @throws CustomException
     */
    public function checkOtp(): array|CustomException {
        $this->setUserByEmail();

        if($this->getRequest()->otp == $this->getEloquent()->otp) {
            $this->updateByFieldQuery([
                'should_change_password' => true,
                'otp' => null,
                'otp_expires_at' => null,
            ]);
            return ['token' => $this->createToken($this->getEloquent(), 'user')];
        }
        return throw new CustomException('otp is wrong', 401, 401);
    }

    /**
     * @throws CustomException
     */
    private function setUserByEmail(): static {
        return $this->setEloquent($this->getMemberByQuery('email'));
    }

    /**
     * @throws CustomException
     */
    public function changePassword(): bool|int {
        $this->setEloquent($this->getUserFromRequest());

        if($this->getEloquent()->should_change_password || Hash::check($this->getRequest()->current_password, $this->getEloquent()->password))
            return $this->updateByFieldQuery([
               'password' => Hash::make($this->getRequest()->new_password),
                'should_change_password' => false,
            ]);

        return throw new CustomException('current password is wrong', 400, 400 );
    }
}
