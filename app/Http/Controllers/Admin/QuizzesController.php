<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Quiz;
use App\Http\Requests\Admin\Quizzes\SaveRequest as QuizzesSaveRequest;
use App\Traits\ObjectToSelectOptions;


class QuizzesController extends Controller
{
    use ObjectToSelectOptions;

    public function index()
    {
        $query = Quiz::sortable(['created_at' => 'desc']);
        $query = $this->_searchParams($query);

        $quizzes = $query->paginate(20);

        $search = request()->all();

        return Inertia::render('Admin/Quizzes/Index', [
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

        if (isset($search['status']))
        {
            $query->where('status', $search['status']);
        }

        if (isset($search['type']))
        {
            $query->where('type', $search['type']);
        }

        if (!empty($search['from_date']))
        {
            $query->whereDate('created_at', '>=', $search['from_date']);
        }

        if (!empty($search['to_date']))
        {
            $query->whereDate('created_at', '<=', $search['to_date']);
        }

        return $query;
    }


    public function create()
    {
        return Inertia::render('Admin/Quizzes/Create');
    }


    public function store(QuizzesSaveRequest $request)
    {
        $data = $request->validated();
        $data['num_questions'] = count($data['questions']);
        $quiz = Quiz::create($data);

        return redirect()->route('admin.quizzes.index')->with('notification', config('app-notifications')['record.saved']);
    }


    public function show(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        return Inertia::render('Admin/Quizzes/Show', compact('quiz'));
    }


    public function edit(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        return Inertia::render('Admin/Quizzes/Edit', compact('quiz'));
    }


    public function update(QuizzesSaveRequest $request, string $id)
    {
        $data = $request->validated();

        $quiz = Quiz::findOrFail($id);

        $data['num_questions'] = count($data['questions']);

        $quiz->update($data);

        return redirect()->route('admin.quizzes.index')->with('notification', config('app-notifications')['record.saved']);
    }


    public function destroy(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->forceDelete();
        return redirect()->route('admin.quizzes.index')->with('notification', config('app-notifications')['record.deleted']);
    }
}
