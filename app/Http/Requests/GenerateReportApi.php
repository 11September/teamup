<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GenerateReportApi extends FormRequest
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

            'id' => 'nullable|int|exists:records,id',
            'date_from' => [
                'nullable',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    try {
                        $now = Carbon::now();
                        $to = Carbon::now();
                        $subYear = $to->subYear();

                        if (!$value instanceof Carbon) {
                            $date_from = Carbon::createFromFormat('Y-m-d', $value);
                        } else {
                            $date_from = $value;
                        }

                        if ($date_from < $subYear || $date_from > $now) {
                            $fail('Start date does not belong to the range!');
                        }
                    } catch (\Exception $exception) {
//                        $fail('Incorrect date format!');
                    }
                }
            ],
            'date_to' => [
                'nullable',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    try {
                        $now = Carbon::now();
                        $to = Carbon::now();
                        $subYear = $to->subYear();

                        if (!$value instanceof Carbon) {
                            $date_to = Carbon::createFromFormat('Y-m-d', $value);
                        } else {
                            $date_to = $value;
                        }

                        if ($date_to > $now || $date_to < $subYear) {
                            $fail('End date does not belong to the range!');
                        }
                    } catch (\Exception $exception) {
//                        $fail('Incorrect date format!');
                    }
                }
            ],
            'format_group' => [
                'nullable',
                Rule::in(['Y', 'y', 'M', 'm', 'W', 'w', 'D', 'd']),
            ],
            'order_value_by' => [
                'nullable',
                Rule::in(['asc', 'desc']),
            ],
            'order_date_by' => [
                'nullable',
                Rule::in(['asc', 'desc']),
            ],
        ];
    }
}
