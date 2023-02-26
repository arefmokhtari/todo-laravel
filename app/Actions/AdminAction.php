<?php

namespace App\Actions;

use Genocide\Radiocrud\Exceptions\CustomException;
use Genocide\Radiocrud\Services\ActionService\ActionService;
use App\Models\Admin;
use App\Http\Resources\AdminResource;
use App\Helpers\Traits\HasInitialize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAction extends ActionService
{
    use HasInitialize;
    private $admin = null;
    protected array $validationRules = [
        'login' => [
            'name' => ['string', 'max:70', 'required'],
            'password' => ['string', 'max:150', 'required'],
        ],
    ];

    public function __construct(Request $request = null) {
        $this
            ->setModel(Admin::class)
            ->setResource(AdminResource::class)
            ->setRequest($request);
        parent::__construct();
    }


    /**
     * @throws CustomException
     */
    public function login(): array|CustomException {
        $admin = $this->getAdminByName();

        if(Hash::check($this->getRequest()->password, $admin->password))
            return ['token' => $admin->createToken('admin_token')->plainTextToken];

        return throw new CustomException('ur name | passwd is wrong ', 84, 400);
    }

    /**
     * @throws CustomException
     */
    private function getAdminByName(): object {
        $this->getEloquent()->where('name', $this->getRequest()->name);
        return $this->getFirstByEloquent();
    }
}
