<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Odontogram extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'teeth_id',
        'diastema',
        'anomali',
        'others',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public static function booted()
    {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function teeth()
    {
        return $this->belongsTo(Teeth::class);
    }

    public function medical_record()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function symbols()
    {
        return $this->belongsToMany(Symbol::class)->withTimestamps();
    }
}
