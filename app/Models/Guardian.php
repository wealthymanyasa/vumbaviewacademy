<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'phone', 'address', 'student_id'];

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
