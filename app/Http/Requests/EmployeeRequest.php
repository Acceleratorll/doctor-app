<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'role' => 'required',
            'name' => 'required',
            'address' => 'required',
            'birth_date' => 'required|date|before_or_equal:today',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->route('pegawai'),
            'phone' => 'required',
            'qualification' => 'required',
            'username' => 'required',
            'password' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'birth_date.before_or_equal' => 'Tanggal lahir tidak boleh lebih dari hari ini.',
            'email' => 'The email has already been registered!'
        ];
    }
}
