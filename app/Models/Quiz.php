<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'code',
        'num_of_items',
        'time_limit',
        'num_of_attempt',
        'start_date',
        'end_date',
        'status',
        'subject_id',
        'note',
        'release_remark',
        'can_see_answer',
        'can_see_points'
    ];

    public function question(){
        return $this->hasMany(Question::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
