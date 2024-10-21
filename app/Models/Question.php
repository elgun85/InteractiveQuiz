<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Question extends Model
{
    use HasFactory,HasRoles;
    protected $table='questions';

    protected $fillable=
        [
            'quiz_id',
            'question',
            'image',
            'optionA',
            'optionB',
            'optionC',
            'optionD',
            'correct_answer',
            'class',
            'level',
            'status'
        ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
