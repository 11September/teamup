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
            'password' => 'required|string|min:6|max:255|confirmed'
//          different:password-old
        ];
    }

//    public function messages()
//    {
//        return [
//            'first_name.required' => "First name required field",
//            'first_name.min' => "First name must contain at least 6 characters",
//
//            'last_name.required' => "Last name required field",
//            'last_name.min' => "Last name must contain at least 6 characters",
//
//            'email.required' => "Email required field",
//            'email.email' => "Email маэ бути згiдно формату",
//            'email.unique' => "Email повинен бути унікальним",
//
//            'address.required' => "Адреса батьків обов'язкове поле",
//            'address.min' => "Мінімальна кількість символів 6 для адреси",
//
//            'password.required' => "Пароль обов'язкове поле",
//            'password.min' => "Пароль повинен містити не менше 6 символів",
//            'password.confirmed' => "Паролі повинні співпадати",
//
//            'school_id.required' => "Садок обов'язкове поле",
//            'group_id.required' => "Група обов'язкове поле",
//            'status.required' => "Статус обов'язкове поле",
//            'parents.required' => "ВибБатько / Мати обов'язкове поле",
//
//            'parent_phone.min' => "Мінімальна кількість символів 10 для номеру телефона",
//            'parent_phone.max' => "Максимальна кількість символів 13 для номеру телефона",
//        ];
//    }
}
