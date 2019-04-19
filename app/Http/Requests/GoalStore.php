<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalStore extends FormRequest
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
            'activity_id' => 'required|int|exists:activities,id',
            'user_id' => 'required|int|exists:users,id',
            'goal' => 'required|numeric'
        ];
    }
}
