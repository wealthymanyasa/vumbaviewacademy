<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'student_id',
        'balance',
        'date_of_payment',
        'bill_type',
        'academic_year',
        'term',
        'receipt_number',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
