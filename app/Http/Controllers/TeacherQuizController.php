<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Subject;
use App\Models\Question;
use App\Models\DraftQuiz;
use App\Models\DraftAnswer;
use Illuminate\Http\Request;
use App\Models\DraftQuestion;
use App\Models\StudentAnswer;
use App\Models\StudentAttempt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class TeacherQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($id)
    {
        $subject = Subject::find($id);
        if(is_null($subject)) abort(404);
         // Secure Routes
         if($subject->user_id != Auth::user()->id) abort(401);

        return view('teacher.quiz.create')->with('subject',$subject);
    }

    public function created(Request $request,$id){
        if(request()->ajax()){

            $error = Array();
            if(is_null($request->input('quizTitle'))){
                array_push($error,'Quiz Title is Empty');
            }
            if(is_null($request->input('quizDescription'))){
                array_push($error,'Quiz Description is Empty');
            }

            if(in_array(null,$request->input('ischeck'), true)){
                array_push($error,'Please Check the Correct Answer of a Question');
            }
            if(in_array(null,$request->input('option'), true)){
                array_push($error,'Some  Option Is Empty');
            }
            if(in_array(null,$request->input('question'), true)){
                array_push($error,'Some Question is Empty');
            }

            // if(is_null($request->input('checkboxQuiz2')) && is_null($request->input('checkboxQuiz1'))){
            //     array_push($error,'Please Check at least one Option in the Student Can See Option');
            // }

            $chunck = array_chunk($request->input('ischeck'),4);

            foreach($chunck as $arr) {
                if (!in_array("1",$arr, true)) {
                    array_push($error,'Please add Correct Answer of a Question');
                }
            }
            if(count($error) > 0){
                return response()->json(['msg'=>$error, 'success'=>false]);   
            }

            $array = array(
                'customRadio'=>1,
                'checkboxQuiz1'=>$request->checkboxQuiz1 ?? 0,
                'checkboxQuiz2'=>$request->checkboxQuiz2 ?? 0,
                'quizTitle'=>$request->quizTitle,
                'quizDescription'=>$request->quizDescription,
                'question'=>$request->question,
                'quizPts'=>$request->quizPts,
                'isCheck'=>$request->ischeck,
                'option'=>$request->option,
                'draftid'=>$request->draftid ?? null
            );

            $subject = Subject::find($id);
            if(is_null($subject)) abort(404);
            session(['array' => $array]);

            return response()->json(['msg'=>$request->all(), 'success'=>true]);  

        }
    }

    public function  createquiz2($id)
    {
        $subject = Subject::find($id);
        if(is_null($subject)) abort(404);
        // Secure Routes
        if($subject->user_id != Auth::user()->id) abort(401);

        return view('teacher.quiz.created')->with('subject',$subject);
    }
    
    public function draft(Request $request,$id)
    {
        if(request()->ajax()){

            $title = $request->input('quizTitle')?? 'no title';
            $description = $request->input('quizDescription');
            $questionArray = $request->input('question');
            $answerArray = array_chunk($request->input('option'),4);
            $correctArray = array_chunk($request->input('ischeck'),4);
            $pointsArray = $request->quizPts;
            $remarkOption= 1;
            $answerOption= $request->checkboxQuiz1 ?? 0;
            $pointsOption = $request->checkboxQuiz2 ?? 0;

            $draftquiz = new DraftQuiz;

            $draftquiz->title = $title;
            $draftquiz->description = $description;
            $draftquiz->status = 1;
            $draftquiz->subject_id = $id;
            $draftquiz->when_release_remark = $remarkOption;
            $draftquiz->can_see_answer = $answerOption;
            $draftquiz->can_see_points = $pointsOption;

            $draftquiz->save();

            for($i = 0; $i<count($questionArray); $i++){

                $draftquestion = new DraftQuestion;
                $draftquestion->description = $questionArray[$i];
                $draftquestion->draft_quiz_id = $draftquiz->id;
                $draftquestion->type = null;
                $draftquestion->points = $pointsArray[$i];
                $draftquestion->status = 1;
    
                $draftquestion->save();
    
                for($x = 0; $x<4; $x++){
                    $draftans = new DraftAnswer;
                    $draftans->description = $answerArray[$i][$x];
                    $draftans->draft_question_id = $draftquestion->id;
                    $draftans->is_right = $correctArray[$i][$x];
                    $draftans->status = 1;
    
                    $draftans->save();
                }
                
            }
            return response()->json(['success'=>true]);  
        }
    }

    public function draftpage(Request $request,$subid,$id)
    {
        $draft = DraftQuiz::find($id);
        $subject = Subject::find($subid);

        if(is_null($draft) || is_null($subject)) return abort(404);
        // Secure Routes
        if($subject->user_id != Auth::user()->id) abort(401);

        return view('teacher.quiz.draft')->with('draft',$draft)->with('subject',$subject);
    }

    public function draftedit(Request $request,$subid,$id)
    {
        if(request()->ajax()){

            $title = $request->input('quizTitle')?? 'no title';
            $description = $request->input('quizDescription');
            $questionArray = $request->input('question');
            $answerArray = array_chunk($request->input('option'),4);
            $correctArray = array_chunk($request->input('ischeck'),4);
            $pointsArray = $request->quizPts;
            $remarkOption= 1;
            $answerOption= $request->checkboxQuiz1 ?? 0;
            $pointsOption = $request->checkboxQuiz2 ?? 0;

            $draftquiz = DraftQuiz::find($id);

            $draftquiz->title = $title;
            $draftquiz->description = $description;
            $draftquiz->status = 1;
            $draftquiz->subject_id = $subid;
            $draftquiz->when_release_remark = $remarkOption;
            $draftquiz->can_see_answer = $answerOption;
            $draftquiz->can_see_points = $pointsOption;

            $draftquiz->save();
            
            $questions = DraftQuestion::where('draft_quiz_id','=',$id)->get();
            DraftQuestion::destroy($questions->toArray());

            for($i = 0; $i<count($questionArray); $i++){

                $draftquestion = new DraftQuestion;
                $draftquestion->description = $questionArray[$i];
                $draftquestion->draft_quiz_id = $draftquiz->id;
                $draftquestion->type = null;
                $draftquestion->points = $pointsArray[$i];
                $draftquestion->status = 1;
    
                $draftquestion->save();
    
                for($x = 0; $x<4; $x++){
                    $draftans = new DraftAnswer;
                    $draftans->description = $answerArray[$i][$x];
                    $draftans->draft_question_id = $draftquestion->id;
                    $draftans->is_right = $correctArray[$i][$x];
                    $draftans->status = 1;
    
                    $draftans->save();
                }
                
            }
            return response()->json(['success'=>true]);
        };
    }

    public function store(Request $request)
    {   
        
        $this->validate($request,[
            'note'=>'required',
            'appt'=>'required',
            'attempt'=>'required',
            'AvOn'=>'required|after_or_equal:'.date('Y-m-d H:i:s'),
            'AvUntil'=>'required|after:AvOn|after_or_equal:'.date('Y-m-d H:i:s')
        ],[
            'AvOn.after_or_equal' => "Start Date time must be atleast 2 minutes advanced than the current time",
            'AvUntil.after_or_equal' => "End Date must be After Today's Date",
            'AvOn.required' => 'Please Put Start Date',
            'AvUntil.required' => 'Please Put End Date',
            'AvUntil.after' => 'End Date Must Be After Start Date'
        ]);

        $value = session('array');
        
        $time = explode(':', $request->appt);
        $minutes = ($time[0] * 60 + $time[1] * 1);
        $start = new Carbon(strtotime($request->AvOn));
        $now = Carbon::now();
        // $isTimeInvalid =  $request->AvOn > $request->AvUntil;
        
        // $errors =  array();

       
        if($minutes < 1) {
            return back()->with('error',"Time Limit Must be not equal to 0")->withInput();
        }

        // if($isTimeInvalid) {
        //     array_push($errors,'Date Start Must be early than the Date End');
        // }

        // if(count($errors) > 0) {
        //     return back()->with('errors',$errors);
        // }

        function generateRandomString($length = 25) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);

            $isNotUnique = true;

            while($isNotUnique){
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
    
                $quiz = Quiz::where('code',$randomString)->get();
                if(count($quiz) == 0) {
                    $isNotUnique = false;
                }
            }

            return $randomString;
        }

        $draftid = $value['draftid'];

        if(!is_null($draftid)){
            $draft = DraftQuiz::find($draftid);

            $draft->status = 0;
            $draft->save();
        }

        $quizCode = generateRandomString(6);
        $questionArray = $value['question'];
        $answerArray = array_chunk($value['option'],4);
        $correctArray = array_chunk($value['isCheck'],4);
        $pointsArray = $value['quizPts'];
        $title = $value['quizTitle'];
        $description = $value['quizDescription'];
        $timeLimit = $minutes;
        $attempt = $request->attempt;
        $startDate = date('Y-m-d H:i:s' , strtotime($request->AvOn)); 
        $endDate = date('Y-m-d H:i:s' , strtotime($request->AvUntil)); 
        $note = $request->note;
        $remark = $value['customRadio'];
        $answer = $value['checkboxQuiz1'];
        $points = $value['checkboxQuiz2'];
        $subjectId = $request->subject;

        $quiz = new Quiz;

        $quiz->title = $title;
        $quiz->description = $description;
        $quiz->code = $quizCode;
        $quiz->num_of_items = count($questionArray);
        $quiz->time_limit = $timeLimit;
        $quiz->num_of_attempt = $attempt;
        $quiz->start_date = $startDate;
        $quiz->end_date = $endDate;
        $quiz->status = 1;
        $quiz->subject_id = $subjectId;
        $quiz->note = $note;
        $quiz->when_release_remark = $remark;
        $quiz->can_see_answer = $answer;
        $quiz->can_see_points = $points;

         $quiz->save();

        $type = 'multiple';

        for($i = 0; $i<count($questionArray); $i++){

            $question = new Question;
            $question->description = $questionArray[$i];
            $question->quiz_id = $quiz->id;
            $question->type = $type;
            $question->points = $pointsArray[$i];
            $question->status = 1;

            $question->save();

            for($x = 0; $x<4; $x++){
                $ans = new Answer;
                $ans->description = $answerArray[$i][$x];
                $ans->question_id = $question->id;
                $ans->is_right = $correctArray[$i][$x];
                $ans->status = 1;

                $ans->save();
            }
            
        }
        $subject = Subject::find($subjectId);
        return Redirect::route('teachersubject.show',$subjectId)->with('success','Quiz Created')->with('subject',$subject);
    }

    public function show($subid,$quizid)
    {
        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);
        
        // Secure Routes
        if($subject->user_id != Auth::user()->id) abort(401);

        $studentInfo = StudentAttempt::where('quiz_id','=',$quizid)->where('status','=',1)->get();

        return view('teacher.quiz.show')->with('subject',$subject)->with('quiz',$quiz)->with('studentInfo',$studentInfo);
       
    }

    // Below is not yet implemented

    public function edit($subid,$quizid)
    {
        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);

        // return view('teacher.quiz.edit')->with('subjet',$subject)->with('quiz',$quiz);
       
    }

    public function editquiz(Request $request, $subid,$quizid)
    {
        if(request()->ajax()){

            $error = Array();
            if(is_null($request->input('quizTitle'))){
                array_push($error,'Quiz Title is Empty');
            }
            if(is_null($request->input('quizDescription'))){
                array_push($error,'Quiz Description is Empty');
            }

            if(in_array(null,$request->input('ischeck'), true)){
                array_push($error,'Please Check the Correct Answer of a Question');
            }
            if(in_array(null,$request->input('option'), true)){
                array_push($error,'Some  Option Is Empty');
            }
            if(in_array(null,$request->input('question'), true)){
                array_push($error,'Some Question is Empty');
            }

            if(is_null($request->input('checkboxQuiz2')) && is_null($request->input('checkboxQuiz1'))){
                array_push($error,'Please Check at least one Option in the Student Can See Option');
            }

            $chunck = array_chunk($request->input('ischeck'),4);

            foreach($chunck as $arr) {
                if (!in_array("1",$arr, true)) {
                    array_push($error,'Please add Correct Answer of a Question');
                }
            }

            if(count($error) > 0){
                return response()->json(['msg'=>$error, 'success'=>false]);   
            }

            $array = array(
                'customRadio'=>1,
                'checkboxQuiz1'=>$request->checkboxQuiz1 ?? 0,
                'checkboxQuiz2'=>$request->checkboxQuiz2 ?? 0,
                'quizTitle'=>$request->quizTitle,
                'quizDescription'=>$request->quizDescription,
                'question'=>$request->question,
                'quizPts'=>$request->quizPts,
                'isCheck'=>$request->ischeck,
                'option'=>$request->option,
                'draftid'=>$request->draftid ?? null
            );

            session(['array' => $array]);

            return response()->json(['msg'=>$request->all(), 'success'=>true]);  
        }
    }

    public function edit1($subid,$quizid)
    {
        $subject = Subject::find($subid);
        $quiz = Quiz::find($quizid);
        // return view('teacher.quiz.edit1')->with('subject',$subject)->with('quiz',$quiz);
    }

    public function update(Request $request, $subid,$quizid)
    {
        $this->validate($request,[
            'note'=>'required',
            'appt'=>'required',
            'attempt'=>'required',
            'AvOn'=>'required',
            'AvUntil'=>'required'
        ]);

        $value = session('array');
        
        $time = explode(':', $request->appt);
        $minutes = ($time[0] * 60 + $time[1] * 1);
        $isTimeInvalid =  $request->AvOn > $request->AvUntil;
        
        $errors =  array();

        // return date('Y-m-d H:i:s' , strtotime($request->AvOn));

        if($minutes < 1) {
            array_push($errors,'Time limit must be More than 1 minute');
        }

        if($isTimeInvalid) {
            array_push($errors,'Date Start Must be early than the Date End');
        }

        if(count($errors) > 0) {
            return back()->with('errors1',$errors);
        }

      
        $questionArray = $value['question'];
        $answerArray = array_chunk($value['option'],4);
        $correctArray = array_chunk($value['isCheck'],4);
        $pointsArray = $value['quizPts'];
        $title = $value['quizTitle'];
        $description = $value['quizDescription'];
        $timeLimit = $minutes;
        $attempt = $request->attempt;
        $startDate = date('Y-m-d H:i:s' , strtotime($request->AvOn)); 
        $endDate = date('Y-m-d H:i:s' , strtotime($request->AvUntil)); 
        $note = $request->note;
        $remark = $value['customRadio'];
        $answer = $value['checkboxQuiz1'];
        $points = $value['checkboxQuiz2'];
        $subjectId = $request->subject;

        $quiz = Quiz::find($quizid);

        $quiz->title = $title;
        $quiz->description = $description;
        $quiz->num_of_items = count($questionArray);
        $quiz->time_limit = $timeLimit;
        $quiz->num_of_attempt = $attempt;
        $quiz->start_date = $startDate;
        $quiz->end_date = $endDate;
        $quiz->status = 1;
        $quiz->subject_id = $subjectId;
        $quiz->note = $note;
        $quiz->when_release_remark = $remark;
        $quiz->can_see_answer = $answer;
        $quiz->can_see_points = $points;

        $quiz->save();

        $questions = Question::where('quiz_id','=',$quiz->id)->get();
        Question::destroy($questions->toArray());

        $type = 'multiple';

        for($i = 0; $i<count($questionArray); $i++){

            $question = new Question;
            $question->description = $questionArray[$i];
            $question->quiz_id = $quiz->id;
            $question->type = $type;
            $question->points = $pointsArray[$i];
            $question->status = 1;

            $question->save();

            for($x = 0; $x<4; $x++){
                $ans = new Answer;
                $ans->description = $answerArray[$i][$x];
                $ans->question_id = $question->id;
                $ans->is_right = $correctArray[$i][$x];
                $ans->status = 1;

                $ans->save();
            }
            
        }
        
        $subject = Subject::find($subjectId);
        return Redirect::route('teacherquiz.show',['subid'=>$subject->id,'quizid'=>$quiz->id])->with('success','Quiz Updated')->with('subject',$subject)->with('quiz',$quiz);
    }

    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        if(is_null($quiz)) abort(404);

        $quiz->status = 0;
        $quiz->save();
    }

    // Above is not yet implemented

    
}
