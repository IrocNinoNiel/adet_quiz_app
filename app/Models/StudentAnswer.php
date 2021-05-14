<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'question_id',
        'answer_id',
        'student_attempt_id',
        'points',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function attempt(){
        return $this->belongsTo(StudentAttempt::class);
    }
}
