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
        // $subject = SubjectMember::where('user_id','=',Auth::user()->id)
        //     ->where('status','=',1)
        //     ->orderBy('created_at','desc')->with(['user'])
        //     ->get();

        return view('student.subject.index');
    }

    
    public function join(Request $request){

        $this->validate($request,[
            'subjectCode'=>'required',
        ]);

        $code = Subject::where('code',$request->subjectCode)->get();

        if(count($code) == 0) {
            return back()->with('error','Invalid Code');
        }

        foreach(Auth::user()->member as $member){
            echo $member;
            if($member->subject->code == $code[0]->code) return back()->with('error','You are already a Member');
        }
       
        $member = new SubjectMember();

        $member->subject_id = $code[0]->id;
        $member->user_id = Auth::user()->id;
        $member->status = 1;

        $member->save();

        return redirect('/home')->with('success','Succesfully Joined');

        // $subject = SubjectMember::where('user_id','=',Auth::user()->id)
        //     ->where('status','=',1)
        //     ->orderBy('created_at','desc')->with(['user'])
        //     ->get();
        
        // return view('student.index')->with('subjects',$subject);
        
    }

    public function show($id){

        $subject = Subject::find($id);
        if(is_null($subject)) abort(404);

        return view('student.subject.show')->with('subject',$subject);
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
