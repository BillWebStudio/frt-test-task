<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Enums\ActiveStatus as ActiveStatusEnum;
use App\Enums\QuizType as QuizTypeEnum;

use Kyslik\ColumnSortable\Sortable;


class Quiz extends Model
{
    use HasFactory;
    use Sortable;


    protected $fillable = [
        'title',
        'status',
        'type',
        'duration',
        'num_questions',
        'questions',
    ];

    protected $casts = [
        'status' => ActiveStatusEnum::class,
        'type' => QuizTypeEnum::class,
        'questions' => 'array',
        'created_at'  => 'date:Y-m-d H:i',
        'updated_at'  => 'date:Y-m-d H:i',
    ];


    public $sortable = [
        'id',
        'title',
        'status',
        'type',
        'duration',
        'num_questions',
        'created_at',
        'updated_at',
        ];
/*
    public function clientsQuizes()
    {
        return $this->hasMany(ClientQuiz::class);
    }
*/

}
