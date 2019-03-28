<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeasureStoreOrUpdate extends FormRequest
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
            'id' => 'nullable|int|exists:measures',
            'name' => 'required|string|min:1|unique:measures'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => "name of measures must be unique",
        ];
    }
}
