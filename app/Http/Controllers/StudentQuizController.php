<?php

namespace App\Http\Controllers;

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


        $findAttempt = StudentAttempt::where('user_id','=',Auth::user()->id)->where('quiz_id','=',$quizid)->where('status','=',1)->get();

        if(count($findAttempt) > 0){
            $findAttempt[0]->status = 0;
            $findAttempt[0]->save();
        }

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

        $value = session('array');
        $attempId = $value['attemptid'];
        $finish = $value['finish'];

        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);
        $attempt = StudentAttempt::find($attempId);

        return view('student.quiz.view')->with('subject',$subject)->with('quiz',$quiz)->with('attempt',$attempt)->with('finish',$finish);
    }

    public function score($subid,$quizid)
    {
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


}
