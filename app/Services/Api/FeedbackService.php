<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 025 25.03.19
 * Time: 16:04
 */

namespace App\Services\Api;

use App\Helpers\UserHelper;
use Illuminate\Http\Request;
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
        $attributes['status'] = 'unread';

        return $attributes;
    }

    public function SendFeedback(Request $request)
    {
        $feedback = $this->prepareFeedbackData($request->all());

        return $this->feedback->create($feedback);
    }
}
