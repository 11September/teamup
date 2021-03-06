<?php

namespace App\Http\Requests;

use App\User;
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
            'user_id' => [
                'required',
                'int',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::where('id', $value)->first();
                    if ($user->type !== "coach") {
                        $fail('You have chosen not a valid trainer!');
                    }
                },
            ],
//            'user_id' => 'required|int|exists:users,id',
            'code' => 'required|string|min:5|unique:teams',
            'ids' => 'nullable|array',
            "ids.*" => [
                'required',
                'int',
                'exists:users,id',
            ],
            'activityIds' => 'nullable|array',
            "activityIds.*" => [
                'required',
                'int',
                'exists:activities,id',
            ]
        ];
    }
}
