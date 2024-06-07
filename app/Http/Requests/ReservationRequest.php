<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'patient_id' => 'required|exists:patients,id',
            'schedule_id' => 'required|exists:schedules,id',
            'reservation_code' => 'required|string|max:255',
            'bpjs' => 'nullable|boolean',
            'bukti_pembayaran' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'ktp' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'bpjs_card' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'surat_rujukan' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'approve' => 'nullable|boolean',
            'status' => 'nullable|integer',
            'hide_button' => 'nullable|boolean',
            'nomor_urut' => 'nullable|integer',
        ];
    }
}
