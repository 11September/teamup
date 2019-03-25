<?php

namespace App\Http\Controllers\App;

use App\Services\FeedbackService;
use App\Http\Requests\LoginFeedback;

use App\Http\Controllers\Controller;

class FeedbacksController extends Controller
{
    protected $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }


    /**
     * loginFeedback
     *
     * @param  [int] id
     * @param  [text] feedback
     *
     * @return [json] text
     */

    public function loginFeedback(LoginFeedback $request)
    {
        $this->feedbackService->SendFeedback($request);

        return response()->json(['message' => 'Feedback has been sent!'], 200);
    }
}
