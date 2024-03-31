<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odontogram extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'teeth_id',
        'symbol_id',
        'occlusi',
        'torus_palatinus',
        'torus_mandibularis',
        'palatum',
        'diastema',
        'anomali_teeth',
        'others',
    ];

    public function teeth()
    {
        $this->belongsTo(Teeth::class);
    }

    public function symbol()
    {
        $this->belongsTo(Symbol::class);
    }

    public function medical_record()
    {
        $this->belongsTo(MedicalRecord::class);
    }
}
