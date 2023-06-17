<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'place_id',
        'schedule_date',
        'schedule_time'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
