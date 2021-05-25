<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\StudentAnswer;
use App\Models\FinishQuizTime;
use App\Models\StudentAttempt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Session\Session;

class StudentQuizController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($subid,$quizid)
    {
        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);

        $quizattempt = StudentAttempt::where('user_id','=',Auth::user()->id)->where('quiz_id','=',$quiz->id)->where('status','=',1)->get();

        // Check if Student is a Member or not
        if(count($subject->member()) < 1){
            return abort(401);
        }

        return view('student.quiz.attempt')->with('subject',$subject)->with('quiz',$quiz)->with('attempt',$quizattempt);
    }

    public function attemptDateInfo($subid,$quizid)
    {   
        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);

        // Check if Student is a Member or not
        if(count($subject->member()) < 1){
            return abort(401);
        }

        $findAttempt = StudentAttempt::where('user_id','=',Auth::user()->id)->where('quiz_id','=',$quizid)->where('status','=',1)->get();

        if(count($findAttempt) > 0){
            $findAttempt[0]->status = 0;
            $findAttempt[0]->save();
        }

        $attempt = new StudentAttempt();

        $attempt->quiz_id = $quizid;
        $attempt->user_id = Auth::user()->id;
        $attempt->status = 1;

        $attempt->save();

        $timer = Carbon::now()->addMinutes($quiz->time_limit);

        session(['attemptid' => $attempt->id,'timer'=>$timer]);

        return Redirect::route('studentquiz.answer',['subid'=>$subid,'quizid'=>$quizid]);
    }

    public function answer($subid,$quizid)
    {

        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);

        // Check if Student is a Member or not
        if(count($subject->member()) < 1){
            return abort(401);
        }

        $timer = session('timer');

        return view('student.quiz.answer')->with('subject',$subject)->with('quiz',$quiz)->with('timer',$timer);
    }

    public function submit(Request $request, $subid,$quizid)
    {
    
        $attempId = session('attemptid');

        $finish = new FinishQuizTime();
        
        $finish->student_attempt_id = $attempId;
        $finish->save();

        foreach($request->question as $index=>$question){

            if($request->answer){

                if(array_key_exists($index+1, $request->answer)){
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
                }else{
                    $studentAnswer = new StudentAnswer();
                    $question1 = Question::find($question);
                    
                    $studentAnswer->user_id = Auth::user()->id;
                    $studentAnswer->quiz_id =  $quizid;
                    $studentAnswer->question_id = $question1->id;
                    $studentAnswer->answer_id = null;
                    $studentAnswer->student_attempt_id = $attempId;
                    $studentAnswer->points = 0;
                    $studentAnswer->status = 1;

                    $studentAnswer->save();
                }
                
                
            }else{

                $studentAnswer = new StudentAnswer();
                $question1 = Question::find($question);
                    
                $studentAnswer->user_id = Auth::user()->id;
                $studentAnswer->quiz_id =  $quizid;
                $studentAnswer->question_id = $question1->id;
                $studentAnswer->answer_id = null;
                $studentAnswer->student_attempt_id = $attempId;
                $studentAnswer->points = 0;
                $studentAnswer->status = 1;

                $studentAnswer->save();
            }
            
        }
        $array = array(
            'attemptid'=> $attempId,
            'finish'=>$finish,
        );

        session(['array' => $array]);

        return Redirect::route('studentquiz.finish',['subid'=>$subid,'quizid'=>$quizid]);
    }

    public function finish($subid,$quizid){

        if(is_null(session('array'))){
            return back()->with('error','You cannot access the page');
        }

        $value = session('array');
        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);

        $attempId = $value['attemptid'];
        $finish = $value['finish'];

        $attempt = StudentAttempt::find($attempId);

        return view('student.quiz.view')->with('subject',$subject)->with('quiz',$quiz)->with('attempt',$attempt)->with('finish',$finish);
    }

    public function score($subid,$quizid)
    {
        
        if(is_null(session('array'))){
            return back()->with('error','You cannot access the page');
        }

        $value = session('array');
        $attempId = $value['attemptid'];
        $finish = $value['finish'];

        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);
        $attempt = StudentAttempt::find($attempId);
        $studentAnswer = StudentAnswer::where('user_id','=',Auth::user()->id)->where('student_attempt_id','=',$attempId)->get();

        $arrAnswer = array();

        foreach($studentAnswer as $ans){
            array_push($arrAnswer,['points'=>$ans->points,'answer_id'=>$ans->answer_id]);
        }
        
        return view('student.quiz.score')->with('subject',$subject)->with('quiz',$quiz)->with('attempt',$attempt)->with('finish',$finish)->with('arrAnswer',$arrAnswer)->with('arrTotal',$studentAnswer);
    }


    public function viewscore($subid,$quizid){
        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);

        // Check if Student is a Member or not
        if(count($subject->member()) < 1){
            return abort(401);
        }

        $quizattempt = StudentAttempt::where('user_id','=',Auth::user()->id)->where('quiz_id','=',$quiz->id)->where('status','=',1)->get();

        $attemptNum = StudentAttempt::where('user_id','=',Auth::user()->id)->where('quiz_id','=',$quiz->id)->get();

        if(count($quizattempt) < 1){
            return back()->with('error','No Records Found, you did not take the quiz');
        }

        $studentAnswer = StudentAnswer::where('user_id','=',Auth::user()->id)->where('student_attempt_id','=',$quizattempt[0]->id)->get();

        $arrAnswer = array();

        foreach($studentAnswer as $ans){
            array_push($arrAnswer,['points'=>$ans->points,'answer_id'=>$ans->answer_id]);
        }
        return view('student.quiz.viewscore')->with('subject',$subject)->with('quiz',$quiz)->with('arrAnswer',$arrAnswer)->with('arrTotal',$studentAnswer)->with('num_of_attempt',$attemptNum);
    }
}
