<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ActiveStatus : int {
    use EnumToArray;

    case INACTIVE = 0;
    case ACTIVE = 1;

    public function text(){
        return match($this->value){
            self::INACTIVE->value => __('ACTIVE'),
            self::ACTIVE->value =>  __('INACTIVE'),
        };
    }
}
