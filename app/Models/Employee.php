<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'role_id',
        'name',
        'address',
        'birth_date',
        'gender',
        'email',
        'phone',
        'qualification',
        'username',
        'password',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
