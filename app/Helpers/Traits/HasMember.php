<?php

namespace App\Helpers\Traits;

use Illuminate\Contracts\Auth\Authenticatable;


trait HasMember {
    protected Authenticatable $member;

    public function getMember(): ?Authenticatable { // check if request & user is existed, else return auth user
        return $this->member ?? ($this->member = $this->getRequest()?->user() ?? auth()->user());
    }
}

