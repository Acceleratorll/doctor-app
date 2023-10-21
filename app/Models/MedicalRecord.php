<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reservation_id',
        'icd_code',
        'desc',
        'action',
        'complaint',
        'physical_exam',
        'diagnosis',
        'recommendation',
        'recipe',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function icd()
    {
        return $this->belongsTo(Icd::class, 'icd_code', 'code');
    }
}
