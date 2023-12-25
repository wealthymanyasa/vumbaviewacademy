<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'address',
        'student_id',
        'relationship_to_student'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
