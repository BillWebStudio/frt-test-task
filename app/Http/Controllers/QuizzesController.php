<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Quiz;
use App\Models\ClientQuiz;
use App\Enums\QuizType as QuizTypeEnum;
use App\Enums\ActiveStatus as ActiveStatusEnum;
use App\Http\Requests\Front\Quizzes\ClientQuizRequest;


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

        return Inertia::render('Front/Quizzes/DoQuiz', compact('quiz'));
    }


    public function store(ClientQuizRequest $request, string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $data = $request->validated();

        if (@$request->step == "personalInfo"){
            return redirect()->route('quizzes.do', $id);
        }

        $data['name'] = trim($data['first_name'] . ' ' . $data['last_name']);
        $data['ip_address'] = request()->ip();

        $clientQuiz = ClientQuiz::create($data);

        return redirect()->route('quizzes.do', $id);
       // return redirect()->route('quizzes.index')->with('notification', config('app-notifications')['record.saved']);
    }


    public function stats(string $id)
    {
        $quiz = Quiz::findOrFail($id);

        $query = ClientQuiz::where('quiz_id', '=', $id)
            ->orderBy('total_score', 'desc')
            ->orderBy('time_spent', 'asc')
            ->orderBy('created_at', 'asc');

        $stats = $query->paginate(20);

        return Inertia::render('Front/Quizzes/Stats', [
            'quiz' => $quiz,
            'stats' => $stats,
        ]);
    }

}
