<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'place_id' => 'required',
            'employee_id' => 'required',
            'schedule_date' => 'required|date',
            'schedule_time' => 'required',
            'schedule_time_end' => 'required',
            'qty' => 'required',
        ];

        $frequency = $this->input('frequency');
        if($frequency){
            if ($frequency !== -1 || $frequency !== null) {
                $rules['duration'] = 'required|integer|min:1';
                $rules['identifier'] = 'required|in:week,month,year';
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'place_id.required' => 'Kolom Tempat harus diisi.',
            'employee_id.required' => 'Kolom Employee harus diisi.',
            'schedule_date.required' => 'Kolom Tanggal harus diisi.',
            'schedule_date.date' => 'Kolom Tanggal harus berupa tanggal.',
            'schedule_time.required' => 'Kolom Jam Mulai harus diisi.',
            'schedule_time_end.required' => 'Kolom Jam Berakhir harus diisi.',
            'qty.required' => 'Kolom Kuota harus diisi.',
            'frequency.required' => 'Kolom Frekuensi harus diisi.',
            'duration.required' => 'Kolom Durasi harus diisi.',
            'duration.integer' => 'Kolom Durasi harus berupa angka.',
            'duration.min' => 'Kolom Durasi harus minimal 1.',
            'identifier.required' => 'Kolom Satuan Durasi harus diisi.',
            'identifier.in' => 'Kolom Satuan Durasi harus berisi "minggu," "bulan," atau "tahun."',
        ];
    }
}
