<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = [
        'id',
        'note',
        'type',
        'subject_id',
        'student_id',
    ];
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
