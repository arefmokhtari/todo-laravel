<?php

namespace App\Actions;

use App\Helpers\Classes\MainAction;
use App\Models\Category;
use App\Http\Resources\CagetoryResource;
use Illuminate\Http\Request;

class CategoryAction extends MainAction
{
    protected array $validationRules = [
        'store' => [
            'title' => ['string', 'required',  'max:200'],
            'parent_id' => ['integer', 'nullable', ],
        ],
        'update' => [
            'title' => ['string', 'required',  'max:200'],
        ],
    ];
    public function __construct(Request $request) {
        $this
            ->setModel(Category::class)
            ->setResource(CagetoryResource::class)
            ->setRequest($request);
        parent::__construct();
    }
}
