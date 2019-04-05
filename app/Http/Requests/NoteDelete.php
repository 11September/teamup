<?php

namespace App\Http\Requests;

use App\Note;
use Illuminate\Foundation\Http\FormRequest;

class NoteDelete extends FormRequest
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
            'ids' => 'required|array',
            "ids.*" => [
                'required',
                'int',
                'exists:notes,id',
                function ($attribute, $value, $fail) {
                    $note = Note::select('id', 'user_id')->where('id', $value)->first();

                    if ($note && isset($note->user_id) && $note->user_id != auth()->user()->id){
                        $fail('This note does not belong to this user!');
                    }
                }
            ]
        ];
    }
}
