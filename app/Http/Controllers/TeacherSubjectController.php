<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\SubjectMember;
use Illuminate\Support\Facades\Auth;

class TeacherSubjectController extends Controller
{
    
    public function index()
    {
        // $subject = SubjectMember::where('user_id','=',Auth::user()->id)
        //     ->where('status','=',1)
        //     ->orderBy('created_at','desc')->with(['user'])
        //     ->get();

        // // return view('student.index')->with('subjects',$subject);
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

        $this->validate($request,[
            'subjectName'=>'required',
            'subjectDsc'=>'required',
        ]);

        $code = generateRandomString(6);

        $subject = new Subject;

        $subject->name = $request->subjectName;
        $subject->description = $request->subjectDsc;
        $subject->user_id = Auth::user()->id;
        $subject->code = $code;
        $subject->status = 1;

        $subject->save();

        return redirect('/home');

        // protected $fillable = [
        //     'name',
        //     'description',
        //     'user_id',
        //     'code',
        //     'status'
        // ];
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
