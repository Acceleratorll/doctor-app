<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'name',
        'action',
        'short',
    ];

    public function odontograms()
    {
        return $this->belongsToMany(Odontogram::class)->withTimestamps();
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
