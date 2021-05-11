<?php

use Illuminate\Support\Facades\Route;

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
    Route::resource('teachersubject',App\Http\Controllers\TeacherSubjectController::class);
    Route::get('teacherquiz/{id}/create',[App\Http\Controllers\TeacherQuizController::class,'create'])->name('teacherquiz.create');
    Route::post('teacherquiz/{id}/created',[App\Http\Controllers\TeacherQuizController::class,'created'])->name('teacherquiz.created');
});

// Student Side
Route::group(['middleware' => 'CheckRole:student'],function(){
    Route::post('/studentsubject',[App\Http\Controllers\StudentSubjectController::class,'join'])->name('studentsubject.join');
    Route::get('/studentsubject/{id}',[App\Http\Controllers\StudentSubjectController::class,'show'])->name('studentsubject.show');
});