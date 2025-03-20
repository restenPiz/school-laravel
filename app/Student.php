<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'parent_id',
        'class_id',
        'roll_number',
        'gender',
        'phone',
        'dateofbirth',
        'current_address',
        'permanent_address',
        'payment_type'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    public function fees()
    {
        return $this->hasOne(fees::class);
    }

    public function parent() 
    {
        return $this->belongsTo(Parents::class);
    }

    public function class() 
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }

    public function attendances() 
    {
        return $this->hasMany(Attendance::class);
    }
}
