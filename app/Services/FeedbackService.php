<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 025 25.03.19
 * Time: 16:04
 */

namespace App\Services;

use Illuminate\Http\Request;
use App\Helpers\UserHelper;
use Illuminate\Support\Facades\Log;
use App\Repositories\FeedbackRepository;

class FeedbackService
{
    public function __construct(FeedbackRepository $feedback)
    {
        $this->feedback = $feedback;
    }

    public function prepareFeedbackData($data)
    {
        $attributes['user_id'] = $data['id'];
        $attributes['date'] = UserHelper::getCurrentDate();
        $attributes['feedback'] = $data['feedback'];

        return $attributes;
    }

    public function SendFeedback(Request $request)
    {
        try {
            $feedback = $this->prepareFeedbackData($request->all());

            return $this->feedback->create($feedback);

        } catch (\Exception $exception) {
            Log::warning('FeedbackService@SendFeedback Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Oops! Something went wrong!'], 500);
        }
    }
}
