<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'place_id',
        'schedule_date',
        'schedule_time',
        'schedule_time_end',
        'qty',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
