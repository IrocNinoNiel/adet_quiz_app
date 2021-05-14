<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\StudentAnswer;
use App\Models\StudentAttempt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StudentQuizController extends Controller
{
   
    public function index($subid,$quizid)
    {
        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);

        return view('student.quiz.attempt')->with('subject',$subject)->with('quiz',$quiz);
    }

    public function answer($subid,$quizid)
    {
        $attempt = new StudentAttempt();

        $attempt->quiz_id = $quizid;
        $attempt->user_id = Auth::user()->id;
        $attempt->status = 1;

        $attempt->save();

        session(['attemptid' => $attempt->id]);

        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);

        return view('student.quiz.answer')->with('subject',$subject)->with('quiz',$quiz);
    }

    public function submit(Request $request, $subid,$quizid)
    {
        $attempId = session('attemptid');

        foreach($request->question as $index=>$question){

            $studentAnswer = new StudentAnswer();

            $answer = Answer::find($request->answer[$index+1]);
            $question1 = Question::find($question);
            $points = 0;

            if($answer->is_right == 1){
                $points = $question1->points;
            }  
        
            $studentAnswer->user_id = Auth::user()->id;
            $studentAnswer->quiz_id =  $quizid;
            $studentAnswer->question_id = $question1->id;
            $studentAnswer->answer_id = $answer->id;
            $studentAnswer->student_attempt_id = $attempId;
            $studentAnswer->points = $points;
            $studentAnswer->status = 1;

            $studentAnswer->save();
        }
        

        return Redirect::route('studentquiz.finish',['subid'=>$subid,'quizid'=>$quizid]);
    }

    public function finish($subid,$quizid){

        $attempId = session('attemptid');

        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);
        $attempt = StudentAttempt::find($attempId);
        // return $attempt;

        return view('student.quiz.view')->with('subject',$subject)->with('quiz',$quiz)->with('attempt',$attempt);
    }

    public function score($subid,$quizid)
    {
       
        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);
       
        return view('student.quiz.score')->with('subject',$subject)->with('quiz',$quiz);
    }


}
