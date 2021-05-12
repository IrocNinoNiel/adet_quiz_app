<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DraftQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'subject_id',
        'release_remark',
        'can_see_answer',
        'can_see_points'
    ];

    public function question(){
        return $this->hasMany(DraftQuestion::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
