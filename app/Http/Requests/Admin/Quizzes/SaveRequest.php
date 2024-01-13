<?php

namespace App\Http\Requests\Admin\Quizzes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

use App\Enums\ActiveStatus as ActiveStatusEnum;
use App\Enums\QuizType as QuizTypeEnum;


class SaveRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $rules = [
            'status' => [new Enum(ActiveStatusEnum::class)],
            'type' => [new Enum(QuizTypeEnum::class)],
            'title' => 'required|min:3|max:100',
            'duration' => 'required|numeric|min:30',
            'num_questions' => 'nullable',
            'questions' => 'required|min:1',
        ];

        return $rules;
    }
}

