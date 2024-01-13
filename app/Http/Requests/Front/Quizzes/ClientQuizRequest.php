<?php

namespace App\Http\Requests\Front\Quizzes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;


class ClientQuizRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $rules = [
            'quiz_id' => 'required|numeric',
            'first_name' => 'required|min:3|max:40',
            'last_name' => 'required|min:3|max:40',
            'email' => 'required|email',
            'ip_address' => 'nullable',
            'time_spent' => 'nullable|numeric',
            'total_score' => 'nullable|numeric',
            'num_questions' => 'nullable|numeric',
            'answered_questions' => 'nullable|numeric',
            'unanswered_questions' => 'nullable|numeric',
            'questions' => 'nullable',
        ];

        return $rules;
    }
}
