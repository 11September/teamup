<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class UserUpdatePassword extends FormRequest
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
//            'password-old' =>
//                [
//                    'required',
//                    'string',
//                    'min:6',
//                    'max:255',
//                    function ($attribute, $value, $fail) {
//                        if (!Hash::check($value, $this->user()->password)) {
//                            $fail('Your current password doesnt match');
//                        }
//                    },
//                ],
            'password' => 'required|string|min:1|max:8|confirmed'
//          different:password-old
        ];
    }
}
