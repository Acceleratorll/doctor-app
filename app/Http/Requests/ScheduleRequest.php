<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'place_id' => 'required',
            'schedule_date' => 'required|date|after_or_equal:today',
            'schedule_time' => 'required',
            'schedule_time_end' => 'required',
        ];
    }
}
