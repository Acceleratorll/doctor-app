<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'schedule_id',
        'reservation_code',
        'nomor_urut',
        'bukti_pembayaran',
        'bpjs',
        'ktp',
        'surat_rujukan',
        'bpjs_card',
        'approve',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function medical_record()
    {
        return $this->hasOne(MedicalRecord::class);
    }
}
