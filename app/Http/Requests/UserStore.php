<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
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
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1|max:8|confirmed',
            'type' =>  [
                'required',
                Rule::in(['athlete', 'coach', 'admin']),
            ],
            'activation' =>  [
                'required',
                Rule::in(['demo', 'full']),
            ],
            'activation_code' => 'required|string|min:10',
            'expiration_date' => 'required|date',
            'number_students' => 'nullable|int|min:0',
            'phone' => 'nullable|numeric|digits_between:10,15|unique:users,phone',
            'school' => 'nullable|string|min:3',
        ];
    }
}
