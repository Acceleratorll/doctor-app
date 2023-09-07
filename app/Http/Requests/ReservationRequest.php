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
            'patient_id' => 'required',
            'schedule_id' => 'required',
            'reservation_code' => 'required',
            'bpjs' => '',
            'bukti_pembayaran' => 'mimes:jpeg,png,jpg',
            'ktp' => 'file|mimes:jpeg,png,jpg',
            'bpjs_card' => 'file|mimes:jpeg,png,jpg',
            'surat_rujukan' => 'file|mimes:jpeg,png,jpg',
            'approve' => '',
            'status' => '',
            'hide_button' => '',
            'nomor_urut' => '',
        ];
    }
}
