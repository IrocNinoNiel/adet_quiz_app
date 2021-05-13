<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentQuizController extends Controller
{
   
    public function index($subid,$quizid)
    {
        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);

        return view('student.quiz.attempt')->with('subject',$subject)->with('quiz',$quiz);
    }
}
