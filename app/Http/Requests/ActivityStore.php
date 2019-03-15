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
            'Name' => 'required|string|min:6',
            'Units' => [
                'required',
                'int',
                'state' => 'exists:measures,id'
            ],
            'Graphtype' =>  [
                'required',
                Rule::in(['straight', 'reverse']),
            ],
            'Colors' =>  [
                'required',
                Rule::in(['red', 'yellow', 'blue', 'violet', 'orange', 'green', 'indigo']),
            ],
        ];
    }
}
