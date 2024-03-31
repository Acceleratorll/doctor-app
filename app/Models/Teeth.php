<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teeth extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short',
    ];

    public function odontograms()
    {
        $this->hasMany(Odontogram::class);
    }
}
