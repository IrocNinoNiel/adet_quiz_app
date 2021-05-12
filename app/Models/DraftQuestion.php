<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'draft_quiz_id',
        'type',
        'points',
        'status'
    ];

    public function answer(){
        return $this->hasMany(DraftAnswer::class);
    }

    public function quiz(){
        return $this->belongsTo(DraftQuiz::class);
    }
}
