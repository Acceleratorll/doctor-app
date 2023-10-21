<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalRecordRequest extends FormRequest
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
            'reservation_id' => 'required',
            'icd_code' => 'nullable',
            'desc' => 'nullable',
            'action' => 'required',
            'complaint' => 'required',
            'physical_exam' => 'required',
            'diagnosis' => 'required',
            'recommendation' => 'required',
            'recipe' => 'required',
        ];
    }
}
