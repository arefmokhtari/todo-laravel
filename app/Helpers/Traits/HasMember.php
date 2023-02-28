<?php

namespace App\Helpers\Traits;

use Illuminate\Contracts\Auth\Authenticatable;


trait HasMember {
    protected Authenticatable $member;

    public function getMember(): ?Authenticatable {
        return $this->member ?? ($this->member = auth()->user());
    }
}

