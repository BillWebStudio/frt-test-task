<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\ClientQuiz;
use App\Models\CalendarItem;
use App\Models\Accounting;


class DashboardsController extends Controller
{

    public function index()
    {
        return Inertia::render('Admin/Dashboards/Index');
    }
}
