<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fees extends Model
{
    protected $table = 'fees';

    protected $fillable = [
        'payment_type',
        'year',
        'due_date',
        'class_id',
        'student_id',
        'amount',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }
}
