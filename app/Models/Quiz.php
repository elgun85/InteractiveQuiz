<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Quiz extends Model
{
    use HasFactory,HasRoles;
    protected $table = 'quizzes';

    protected $fillable=
        [
            'category_id',
            'title',
            'slug',
            'level',
            'description',
            'status',

        ];
    // Hər bir quiz bir kategoriya aid ola bilər
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function question()
    {
        return $this->hasMany(Question::class,'quiz_id','id');
    }
}
