<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Client;
use App\Models\CalendarItem;
use App\Models\Accounting;


class DashboardsController extends Controller
{

    public function index()
    {
        return Inertia::render('Admin/Dashboards/Index');
    }

    public function getStats(string $statType)
    {
        $res = [];
        $current_year = date('Y-01-01 00-00-01');
        $current_month = date('Y-m-01 00-00-01');

        switch ($statType){
            case "clients": {
                $res = [
                    'total' => Client::count(),
                    'year' => Client::where('created_at', '>=', $current_year)->count(),
                    'month' => Client::where('created_at', '>=', $current_month)->count(),
                ];
                break;
            }

            case "trainings": {
                $res = [
                    'total' => CalendarItem::count(),
                    'year' => CalendarItem::where('start', '>=', $current_year)->count(),
                    'month' => CalendarItem::where('start', '>=', $current_month)->count(),
                ];
                break;
            }

            case "accounting": {
                $res = [
                    'balance' => 0,
                    'income' => Accounting::where('created_at', '>=', $current_month)->where('price', '>=', 0)->sum('price'),
                    'expenses' => Accounting::where('created_at', '>=', $current_month)->where('price', '<', 0)->sum('price'),
                    'year' => [
                        'balance' => 0,
                        'income' => Accounting::where('created_at', '>=', $current_year)->where('price', '>=', 0)->sum('price'),
                        'expenses' => Accounting::where('created_at', '>=', $current_year)->where('price', '<', 0)->sum('price'),
                    ],
                    'total' => [
                        'balance' => 0,
                        'income' => Accounting::where('price', '>=', 0)->sum('price'),
                        'expenses' => Accounting::where('price', '<', 0)->sum('price'),
                    ]
                ];
                $res['balance'] = $res['income'] + $res['expenses'];
                $res['year']['balance'] = $res['year']['income'] + $res['year']['expenses'];
                $res['total']['balance'] = $res['total']['income'] + $res['total']['expenses'];
                break;
            }

        }

        return $res;
    }
}
