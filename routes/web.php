<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Teacher Side
Route::group(['middleware' => 'CheckRole:teacher'],function(){
    // Subject Routes
    Route::resource('teachersubject',App\Http\Controllers\TeacherSubjectController::class);

    // Quiz Routes
    Route::get('teacherquiz/{id}/create',[App\Http\Controllers\TeacherQuizController::class,'create'])->name('teacherquiz.create');
   
    Route::get('teacherquiz/{id}/created',[App\Http\Controllers\TeacherQuizController::class,'createquiz2'])->name('teacherquiz.createquiz2');
    Route::post('teacherquiz/{id}/created',[App\Http\Controllers\TeacherQuizController::class,'created'])->name('teacherquiz.created');
    Route::post('teacherquiz/{id}/save',[App\Http\Controllers\TeacherQuizController::class,'draft'])->name('teacherquiz.draft');
    Route::get('teacherquiz/{subid}/draft/{id}',[App\Http\Controllers\TeacherQuizController::class,'draftpage'])->name('teacherquiz.draftpage');
    Route::post('teacherquiz/{subid}/draft/{id}',[App\Http\Controllers\TeacherQuizController::class,'draftedit'])->name('teacherquiz.draftedit');    
    Route::post('teacherquiz/{id}/store',[App\Http\Controllers\TeacherQuizController::class,'store'])->name('teacherquiz.store');
    
    Route::get('teacherquiz/{subid}/show/{quizid}',[App\Http\Controllers\TeacherQuizController::class,'show'])->name('teacherquiz.show');
    
});

// Student Side
Route::group(['middleware' => 'CheckRole:student'],function(){
    Route::post('/studentsubject',[App\Http\Controllers\StudentSubjectController::class,'join'])->name('studentsubject.join');
    Route::get('/studentsubject/{id}',[App\Http\Controllers\StudentSubjectController::class,'show'])->name('studentsubject.show');

    // student quiz routes
    Route::get('/studentquiz/{subid}/attempt/{quizid}',[App\Http\Controllers\StudentQuizController::class,'index'])->name('studentquiz.index');
    Route::post('/studentquiz/{subid}/attempt/{quizid}',[App\Http\Controllers\StudentQuizController::class,'attemptDateInfo'])->name('studentquiz.attemptdateinfo');
    Route::get('/studentquiz/{subid}/answer/{quizid}',[App\Http\Controllers\StudentQuizController::class,'answer'])->name('studentquiz.answer');
    Route::post('/studentquiz/{subid}/submit/{quizid}',[App\Http\Controllers\StudentQuizController::class,'submit'])->name('studentquiz.submit');
    Route::get('/studentquiz/{subid}/finish/{quizid}',[App\Http\Controllers\StudentQuizController::class,'finish'])->name('studentquiz.finish');
    Route::get('/studentquiz/{subid}/score/{quizid}',[App\Http\Controllers\StudentQuizController::class,'score'])->name('studentquiz.score');
    
});