<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icd extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name_en',
        'name_id',
    ];

    public function medical_records()
    {
        return $this->hasMany(MedicalRecord::class);
    }
}
