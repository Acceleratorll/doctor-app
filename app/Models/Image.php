<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'title',
        'description',
        'image',
    ];

    public function medical_record()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
