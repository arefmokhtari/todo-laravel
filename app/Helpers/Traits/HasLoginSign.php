<?php

namespace App\Helpers\Traits;

use Genocide\Radiocrud\Exceptions\CustomException;
use Illuminate\Support\Facades\Hash;

trait HasLoginSign {
    /**
     * @throws CustomException
     */
    public function loginByRequest(string $signBy = 'name', string $tokenType = 'admin'): array {
        $member = $this->getMemberByQuery($signBy);

        if(Hash::check($this->getRequest()->password, $member->password))
            return ['token' => $member->createToken($tokenType.'_token')->plainTextToken];

        return throw new CustomException("ur $signBy | passwd is wrong", 84, 400);
    }

    /**
     * @throws CustomException
     */
    private function getMemberByQuery(string $signBy = 'name'): object {
        $this->getEloquent()->where($signBy, $this->getRequest()[$signBy]);

        return $this->getFirstByEloquent();
    }
}
