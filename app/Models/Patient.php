<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Model;

class Patient extends Model
{
    use HasFactory, SoftDeletes;
    protected $guard = 'patient';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'birth_date',
        'gender',
        'heigh',
        'weight',
        'username',
        'password',
    ];



    public function medical_records()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
