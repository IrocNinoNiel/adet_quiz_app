<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'code',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quiz(){
        return $this->hasMany(Quiz::class);
    }

    public function drafts(){
        return $this->hasMany(DraftQuiz::class);
    }

    public function member(){
        return $this->hasMany(SubjectMember::class)->where('user_id','=',Auth::user()->id)->get();
    }
}
