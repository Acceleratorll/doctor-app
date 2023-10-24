<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'name',
        'address',
        'reservationable',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
