<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'employee_id',
        'date'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function medical_record()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
