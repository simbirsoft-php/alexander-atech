<?php

namespace App\Http\Requests;

use App\Rules\TimeRange;
use Illuminate\Foundation\Http\FormRequest;

class ImportScheduleRequest extends FormRequest
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
            'monday'    => ['required', new TimeRange],
            'tuesday'   => ['required', new TimeRange],
            'wednesday' => ['required', new TimeRange],
            'thursday'  => ['required', new TimeRange],
            'friday'    => ['required', new TimeRange],
            'saturday'  => ['required', new TimeRange],
            'sunday'    => ['required', new TimeRange]
        ];
    }
}
