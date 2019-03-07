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
            'first_name' => 'required|string|min:6',
            'last_name' => 'required|string|min:6',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
            'type' =>  [
                'required',
                Rule::in(['athlete', 'coach', 'admin']),
            ],
            'number_students' => 'required|int|min:1',
            'activation_code' => 'required|string|min:10',
            'expiration_date' => 'required|date',
            'phone' => 'string|min:10|max:18|unique:users,phone',
            'school' => 'string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.first_name' => "ПІБ дитини обов'язкове поле",
            'name.min' => "ПІБ дитини повинен містити не менше 6 символів",

            'birthday.required' => "Дата народження дитини обов'язкове поле",
            'birthday.date' => "Дата народження має бути датою",

            'parent_name.required' => "ПІБ батьків обов'язкове поле",
            'parent_name.min' => "ПІБ батьків повинен містити не менше 6 символів",

            'parent_phone.required' => "Номер телефону батьків обов'язкове поле",
            'parent_phone.unique' => "Номер телефону вже прив'язаний до користувача",

            'email.required' => "Email батьків обов'язкове поле",
            'email.email' => "Email маэ бути згiдно формату",
            'email.unique' => "Email повинен бути унікальним",

            'address.required' => "Адреса батьків обов'язкове поле",
            'address.min' => "Мінімальна кількість символів 6 для адреси",

            'password.required' => "Пароль обов'язкове поле",
            'password.min' => "Пароль повинен містити не менше 6 символів",
            'password.confirmed' => "Паролі повинні співпадати",

            'school_id.required' => "Садок обов'язкове поле",
            'group_id.required' => "Група обов'язкове поле",
            'status.required' => "Статус обов'язкове поле",
            'parents.required' => "ВибБатько / Мати обов'язкове поле",

            'parent_phone.min' => "Мінімальна кількість символів 10 для номеру телефона",
            'parent_phone.max' => "Максимальна кількість символів 13 для номеру телефона",
        ];
    }
}
