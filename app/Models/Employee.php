<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'qualification',
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

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
