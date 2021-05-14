<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishQuizTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_attempt_id'
    ];
}
