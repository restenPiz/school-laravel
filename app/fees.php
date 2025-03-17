<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class fees extends Model
{
    protected $table = 'fees';

    protected $fillable = [
        'student_id',
        'class_id',
        'payment_type',
        'amount_due',
        'amount_paid',
        'penalty_fee',
        'due_date',
        'status'
    ];

    protected $dates = ['due_date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(Grade::class);
    }

    public function calculatePenalty()
    {
        $today = Carbon::now();
        $dueDate = Carbon::parse($this->due_date);

        if ($this->status !== 'Pago' && $today->greaterThan($dueDate)) {
            $daysLate = $today->diffInDays($dueDate);
            $this->penalty_fee = $daysLate * 100; // Exemplo: 100 MZN/dia de atraso
            $this->status = 'Atrasado';
        }
    }
}
