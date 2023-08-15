<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'title',
        'type',
        'url',
    ];

    public function medical_record()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
