<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ActivityStore extends FormRequest
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
            'name' => 'required|string|min:3',
            'measure_id' => [
                'required',
                'int',
                'state' => 'exists:measures,id'
            ],
            'graph_type' =>  [
                'required',
                Rule::in(['straight', 'reverse']),
            ],
            'status' =>  [
                'required',
                Rule::in(['blank', 'custom']),
            ],
            'team_id' => 'required|int|exists:teams,id',
        ];
    }
}
