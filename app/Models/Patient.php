<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
