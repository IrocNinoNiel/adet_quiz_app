<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'draft_question_id',
        'is_right',
        'status'
    ];

    public function question(){
        return $this->belongsTo(DraftQuestion::class);
    }

}
