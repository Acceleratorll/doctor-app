<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'name' => 'required',
            'role_id' => '',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'birth_date' => 'required|date|before_or_equal:today',
            'gender' => 'required',
            'height' => '',
            'weight' => '',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'username' => '',
            'password' => '',
        ];
    }
}
