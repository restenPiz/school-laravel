<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fees extends Model
{
    protected $table = 'fees';

    protected $fillable = ['student_id', 'amount', 'due_date', 'payment_type', 'status'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
