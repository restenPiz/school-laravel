<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'teacher_id',
        'class_id',
        'title',
        'description',
        'file_path',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'visibility',
    ];

    //?Start with the relationShip between the tables
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function class()
    {
        return $this->belongsTo(Grade::class);
    }
}
