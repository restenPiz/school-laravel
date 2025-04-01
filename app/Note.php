<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = [
        'first',
        'second',
        'third',
        'work',
        'exam',
        'status',
        'subject_id',
        'student_id',
    ];
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
