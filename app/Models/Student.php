<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'dateOfBirth',
        'birthEntryNumber',
        'dateOfEnrolment',
        'studentType'
    ];

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function uniforms()
    {
        return $this->hasMany(Uniform::class);
    }

    public function guardians()
    {
        return $this->hasMany(Guardian::class);
    }
}
