<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherQuizController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
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

        $this->validate($request,[
            'quizTitle'=>'required|max:255',
            'quizDsc'=>'required',
            'quizItems'=>'required',
            'quizTimeLimit'=>'required',
            'quizAttempt'=>'required',
            'quizStartDate'=>'required',
            'quizEndDate'=>'required',
            'quizNote'=>'required',
            'quizReleaseRemark'=> 'required|in:0,1',
            'quizCanSeeAnswer'=> 'required|in:0,1',
            'quizCanSeePoints'=> 'required|in:0,1',
        ]);

        $quizCode = generateRandomString(6);
        $quiz = new Quiz;

        $quiz->title = $request->quizTitle;
        $quiz->description = $request->quizDsc;
        $quiz->code = $quizCode;
        $quiz->num_of_items = $request->quizItems;
        $quiz->time_limit = $request->quizTimeLimit;
        $quiz->num_of_attempt = $request->quizAttempt;
        $quiz->start_date = $request->quizStartDate;
        $quiz->end_date = $request->quizEndDate;
        $quiz->status = 1;
        $quiz->subject_id = $request->subject_id;
        $quiz->note = $request->quizNote;
        $quiz->when_release_remark = $request->quizReleaseRemark;
        $quiz->can_see_answer = $request->quizCanSeeAnswer;
        $quiz->can_see_points = $request->quizCanSeePoints;

        $quiz->save();

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::find($id);
        if(is_null($quiz)) abort(404);

        $this->validate($request,[
            'quizTitle'=>'required|max:255',
            'quizDsc'=>'required',
            'quizItems'=>'required',
            'quizTimeLimit'=>'required',
            'quizAttempt'=>'required',
            'quizStartDate'=>'required',
            'quizEndDate'=>'required',
        ]);

        
        $quiz->title = $request->quizTitle;
        $quiz->description = $request->quizDsc;
        $quiz->num_of_items = $request->quizItems;
        $quiz->time_limit = $request->quizTimeLimit;
        $quiz->num_of_attempt = $request->quizAttempt;
        $quiz->start_date = $request->quizStartDate;
        $quiz->end_date = $request->quizEndDate;
        
        $quiz->save();



    }

    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        if(is_null($quiz)) abort(404);

        $quiz->status = 0;
        $quiz->save();
    }
}
