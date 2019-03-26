<?php

namespace App\Http\Controllers\Admin;

use App\Services\FeedbackService;
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

    public function allFeedbacksProvider()
    {
        dd('lol');
    }
}
