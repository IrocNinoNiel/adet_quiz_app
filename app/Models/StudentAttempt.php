<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'status'
    ];

    public function studentAnswer(){
        return $this->hasMany(StudentAnswer::class)->where('user_id','=',Auth::user()->id);
    }

    public function studentInfo(){
        return $this->belongsTo(User::class,'user_id','id')->get();
    }

    public function score($id,$attempId){
        return $this->hasMany(StudentAnswer::class)->where('user_id','=',$id)->where('student_attempt_id','=',$attempId)->get();
    }


}
