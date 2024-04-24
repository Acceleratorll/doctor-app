<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teeth extends Model
{
    use HasFactory;

    protected $fillable = [
        'quadrant_id',
        'name',
        'fdi',
        'tooth_type_id',
    ];

    public function odontograms()
    {
        $this->hasMany(Odontogram::class);
    }

    public function quadrant()
    {
        return $this->belongsTo(Quadrant::class);
    }

    public function toothType()
    {
        return $this->belongsTo(ToothType::class);
    }
}
