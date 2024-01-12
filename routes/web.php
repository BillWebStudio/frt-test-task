<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\DashboardsController as AdminDashboardsController;
use App\Http\Controllers\Admin\QuizzesController as AdminQuizzesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Front/Pages/home');
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->as('admin.')->group(function () {

    Route::get('/', [AdminDashboardsController::class, 'index'])->name('dashboard');

    Route::resource('quizzes', AdminQuizzesController::class)->parameters(['quiz' => 'id']);

});

require __DIR__.'/auth.php';
