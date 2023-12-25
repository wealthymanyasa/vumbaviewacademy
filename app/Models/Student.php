<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public static function boot()
{
    parent::boot();
    self::creating(function ($model) {
        $model->id = IdGenerator::generate(['table' => 'students', 'length' => 10,'prefix' => date('dmy')]);
    });
}

    protected $fillable = [
        'name',
        'surname',
        'dateOfBirth',
        'birthEntryNumber',
        'dateOfEnrolment',
        'studentType',
        'health_status'
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

    public function buslevies()
    {
        return $this->hasMany(BusLevy::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }



}
