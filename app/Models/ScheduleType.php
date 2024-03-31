<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ScheduleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc'
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
