<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'user_id',
        'status'
    ];
}
