<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'icd_code',
        'desc',
        'action',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
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
