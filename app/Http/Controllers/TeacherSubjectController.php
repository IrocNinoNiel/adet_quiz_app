<?php

namespace App\Http\Controllers;

use App\Models\DraftQuiz;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\SubjectMember;
use Illuminate\Support\Facades\Auth;

class TeacherSubjectController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {
        return view('teacher.subject.create');
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
    
                $subject = Subject::where('code',$randomString)->get();
                if(count($subject) == 0) {
                    $isNotUnique = false;
                }
            }

            return $randomString;
        }

        // $this->validate($request,[
        //     'subjectName'=>'required|min:1',
        //     'subjectDsc'=>'required:min:1',
        // ]);

        $errors = array();
        if( $request->subjectName == null){
            array_push($errors,'Invalid Subject Name');
        }

        if( $request->subjectDsc == null){
            array_push($errors,'Invalid Subject Description');
        }

        if(count($errors) > 0){
            return back()->with('error',$errors);
        }
        $code = generateRandomString(6);

        $subject = new Subject;

        $subject->name = $request->subjectName;
        $subject->description = $request->subjectDsc;
        $subject->user_id = Auth::user()->id;
        $subject->code = $code;
        $subject->status = 1;

        $subject->save();

        return redirect('/home');
    }

    public function show($id)
    {
        $subject = Subject::find($id);
        if(is_null($subject)) abort(404);
        // Secure Routes
        if($subject->user_id != Auth::user()->id) abort(401);

        return view('teacher.subject.show')->with('subject',$subject);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {


    }

    public function destroy($id)
    {
        $subject = Subject::where('user_id','=',Auth::user()->id)
            ->where('subject_id','=',$id)
            ->where('status','=',1)
            ->orderBy('created_at','desc')->with(['user'])
            ->get();

        if(is_null($subject)) abort(404);
        // Secure Routes
        if($subject->user_id != Auth::user()->id) abort(401);

        $subject->status = 0;
        $subject->save();
    }
}
