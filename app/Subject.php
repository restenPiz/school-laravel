<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subject_code',
        'teacher_id',
        'description'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function grade()
    {
        return $this->belongsToMany(Grade::class);
    }
}
