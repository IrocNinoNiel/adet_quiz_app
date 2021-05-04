<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\SubjectMember;
use Illuminate\Support\Facades\Auth;

class StudentSubjectController extends Controller
{
    
    public function index()
    {
        $subject = SubjectMember::where('user_id','=',Auth::user()->id)
            ->where('status','=',1)
            ->orderBy('created_at','desc')->with(['user'])
            ->get();

        // return view('student.index')->with('subjects',$subject);
    }

    
    public function join(Request $request){

        $this->validate($request,[
            'subjectCode'=>'required',
        ]);

        $code = Subject::where('code',$request->subjectCode)->get();

        if(count($code) == 0) {
            return abort(404);
        }

        $member = new SubjectMember();
        $member->subject_id = $code[0]->id;
        $member->user_id = Auth::user()->id;
        $member->status = 1;

        $member->save();

        // $subject = SubjectMember::where('user_id','=',Auth::user()->id)
        //     ->where('status','=',1)
        //     ->orderBy('created_at','desc')->with(['user'])
        //     ->get();
        
        // return view('student.index')->with('subjects',$subject);
        
    }

    public function destroy($id)
    {
        $subject = SubjectMember::where('user_id','=',Auth::user()->id)
            ->where('subject_id','=',$id)
            ->where('status','=',1)
            ->orderBy('created_at','desc')->with(['user'])
            ->get();

        if(is_null($subject)) abort(404);

        $subject->status = 0;
        $subject->save();
    }
}
