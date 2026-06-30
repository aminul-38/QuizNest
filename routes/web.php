<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\password;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/registration', [AuthController::class, 'registration'])
    ->name('auth.registration');
Route::post('/registration', [AuthController::class, 'registrationSubmit'])
    ->name('auth.registration.submit');
Route::get('/login', [AuthController::class, 'login'])
    ->name('auth.login');
Route::post('/login', [AuthController::class, 'loginAttempt'])
    ->name('auth.login.attempt');
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('auth.logout');

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/quizzes/type/{quizType}', [HomeController::class, 'filterByType'])
    ->name('quiz.type');
Route::get('/search', [HomeController::class, 'search'])
    ->name('quiz.search');
Route::get('/quiz/{quizID}/start', [HomeController::class, 'quizStart'])
    ->middleware('auth.user', 'learner')
    ->name('quiz.start');

Route::middleware(['auth.user', 'learner'])->group(function () {
    Route::get('/quiz/{quizID}/participate', [ParticipationController::class, 'participate'])
        ->name('participate.quiz');
    Route::post('/quiz/{quizID}/submit', [ParticipationController::class, 'submit'])
        ->name('participation.submit');
    Route::get('/quiz/{quizID}/result', [ParticipationController::class, 'result'])
        ->middleware('signed')
        ->name('participation.result');
});

Route::get('/quiz/{quizID}/view', [QuizController::class, 'viewQuiz'])
    ->middleware(['auth.user'])
    ->name('quiz.view');

Route::get('/leaderboard/quiz/{quizID}', [LeaderboardController::class, 'quizLeaderboard'])
    ->middleware('auth.user')
    ->name('leaderboard.quiz');

Route::middleware(['auth.user'])->group(function () {
    Route::get('/profile/{userID}/{userName}', [ProfileController::class, 'showProfile'])
        ->name('profile.show');
});
