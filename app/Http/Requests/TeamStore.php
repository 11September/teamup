<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TeamStore extends FormRequest
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
            'name' => 'required|string|min:2',
            'user_id' => 'nullable|int|exists:users,id',
            'code' => 'required|string|min:10',
            'ids' => 'nullable|array',
            "ids.*" => [
                'required',
                'int',
                'exists:users,id',
            ]
        ];
    }
}
