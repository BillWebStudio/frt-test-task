<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Quiz;
use App\Enums\QuizType as QuizTypeEnum;
use App\Enums\ActiveStatus as ActiveStatusEnum;


class QuizzesController extends Controller
{
    public function index()
    {
        $query = Quiz::where('status', '=', ActiveStatusEnum::ACTIVE)
            ->sortable(['created_at' => 'desc']);
        $query = $this->_searchParams($query);

        $quizzes = $query->paginate(20);

        $search = request()->all();

        return Inertia::render('Front/Quizzes/Index', [
            'quizzes' => $quizzes,
            ...$search
        ]);
    }


    private function _searchParams($query)
    {
        $search = request()->all();

        if (!empty($search['s']))
        {
            $query->where('name', 'LIKE', "%{$search['s']}%");
        }

        if (isset($search['type']))
        {
            $query->where('type', $search['type']);
        }

        return $query;
    }


    public function doQuiz(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        return Inertia::render('Admin/Quizzes/Show', compact('quiz'));
    }


    public function store(QuizzesSaveRequest $request, string $id)
    {
        $quiz = Quiz::findOrFail($id);

        $data = $request->validated();
        $data['num_questions'] = count($data['questions']);
        $quiz = Quiz::create($data);

        return redirect()->route('quizzes.index')->with('notification', config('app-notifications')['record.saved']);
    }

}
