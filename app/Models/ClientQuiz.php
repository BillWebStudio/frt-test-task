<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;


class ClientQuiz extends Model
{
    use HasFactory;
    use Sortable;


    protected $fillable = [
        'quiz_id',
        'first_name',
        'last_name',
        'name',
        'email',
        'time_spent',
        'total_score',
        'num_questions',
        'answered_questions',
        'unanswered_questions',
        'questions',
    ];

    protected $casts = [
        'created_at'  => 'date:Y-m-d H:i',
        'updated_at'  => 'date:Y-m-d H:i',
    ];


    public $sortable = [
        'id',
        'quiz_id',
        'name',
        'email',
        'time_spent',
        'total_score',
        'num_question',
        'answered_questions',
        'unanswered_questions',
        'created_at',
        'updated_at',
        ];


    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

}
