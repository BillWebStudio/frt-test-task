<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum QuizType : string {
    use EnumToArray;

    case BINARY = 'Binary';
    case MULTIPLECHOICE = 'MultipleChoice';

}
