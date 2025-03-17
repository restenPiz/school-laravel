<?php

namespace App;

use Carbon\Carbon;
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

    public function getCoveredMonths()
    {
        $startMonth = Carbon::parse($this->due_date)->month;

        switch ($this->payment_type) {
            case 'monthly':
                return [$startMonth]; // Apenas o mês da data de vencimento

            case 'quartely':
                return [$startMonth, $startMonth + 1, $startMonth + 2]; // Três meses

            case 'yearly':
                return range(1, 12); // Todos os 12 meses

            default:
                return [];
        }
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }
}
