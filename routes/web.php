<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\DashboardsController as AdminDashboardsController;
use App\Http\Controllers\Admin\QuizzesController as AdminQuizzesController;
use App\Http\Controllers\Admin\ClientsQuizzesController as AdminClientsQuizzesController;
use App\Http\Controllers\QuizzesController as FrontQuizzesController;

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

Route::get('/quizzes', [FrontQuizzesController::class, 'index'])->name('quizzes.index');
Route::get('/do-quiz/{id}', [FrontQuizzesController::class, 'doQuiz'])->name('quizzes.do');
Route::post('/do-quiz/{id}', [FrontQuizzesController::class, 'store'])->name('quizzes.store');
Route::get('/quiz-stats/{id}', [FrontQuizzesController::class, 'stats'])->name('quizzes.stats');


Route::middleware('auth')->prefix('admin')->as('admin.')->group(function () {

    Route::get('/', [AdminDashboardsController::class, 'index'])->name('dashboard');

    Route::get('/clients-quizzes', [AdminClientsQuizzesController::class, 'index'])->name('clients-quizzes.index');
    Route::get('/clients-quizzes/{id}', [AdminClientsQuizzesController::class, 'clientDetails'])->name('clients-quizzes.details');

    Route::resource('quizzes', AdminQuizzesController::class)->parameters(['quiz' => 'id']);

});

require __DIR__.'/auth.php';
