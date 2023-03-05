<?php

namespace App\Helpers\Traits;

use Genocide\Radiocrud\Exceptions\CustomException;
use Illuminate\Support\Facades\Hash;

trait HasLogin {
    /**
     * @throws CustomException
     */
    public function loginByRequest(string $signBy = 'name', string $tokenType = 'admin'): array {
        $member = $this->getMemberByQuery($signBy);

        if(Hash::check($this->getRequest()->password, $member->password))
            return ['token' => $this->createToken($member, $tokenType)];

        return throw new CustomException("ur $signBy | passwd is wrong", 84, 400);
    }

    /**
     * @throws CustomException
     */
    private function getMemberByQuery(string $signBy = 'name'): object {
        $this->getEloquent()->where($signBy, $this->getRequest()[$signBy]);

        return $this->getFirstByEloquent();
    }

    private function createToken($member, string $type) {
        return $member->createToken($type.'_token')->plainTextToken;
    }
}
