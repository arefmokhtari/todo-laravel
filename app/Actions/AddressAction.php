<?php

namespace App\Actions;

use App\Helpers\Classes\MainAction;
use App\Models\Address;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;

class AddressAction extends MainAction
{
    protected array $validationRules = [
        'store' => [
            'city' => ['string', 'required', 'max:100'],
            'province' => ['string', 'required', 'max:100'],
            'description' => ['string', 'required', 'max:600'],
        ],
    ];
    public function __construct(Request $request)
    {
        $this
            ->setModel(Address::class)
            ->setResource(AddressResource::class)
            ->setRequest($request);
        parent::__construct();
    }
}
