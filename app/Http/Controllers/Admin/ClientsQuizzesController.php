<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Quiz;
use App\Models\ClientQuiz;
use App\Traits\ObjectToSelectOptions;


class ClientsQuizzesController extends Controller
{
    use ObjectToSelectOptions;

    public function index()
    {
        $quizzes = Quiz::orderBy('created_at', 'desc')->pluck('title', 'id');

        $query = ClientQuiz::with('Quiz')
            ->orderBy('total_score', 'desc')
            ->orderBy('time_spent', 'asc')
            ->orderBy('created_at', 'asc')
            ->sortable();
        $query = $this->_searchParams($query);

        $stats = $query->paginate(20);

        $search = request()->all();

        return Inertia::render('Admin/ClientsQuizzes/Index', [
            'quizzes' => $this->objectFoSelectOptions($quizzes),
            'stats' => $stats,
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

        if (isset($search['quiz_id']))
        {
            $query->where('quiz_id', $search['quiz_id']);
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


    public function clientDetails(string $id)
    {
        $clientQuiz = ClientQuiz::with('Quiz')
            ->findOrFail($id);
        return Inertia::render('Admin/ClientsQuizzes/ClientDetails', compact('clientQuiz'));
    }

}
