<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SettingsStore extends FormRequest
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
            'type_graph_straight' => 'required_without_all:type_graph_reverse,privacy_policy,default_units',
            'type_graph_reverse' => 'required_without_all:type_graph_straight,privacy_policy,default_units',
            'privacy_policy' => 'required_without_all:type_graph_straight,type_graph_reverse,default_units',
            'default_units' => 'required_without_all:type_graph_straight,type_graph_reverse,privacy_policy',
        ];
    }
}
