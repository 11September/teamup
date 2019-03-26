<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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

    public function update(Request $request)
    {
        if (!$this->feedbackService->updateStatus($request)){
            return response()->json(['message' => 'Feedback status changed!', 'success' => false], 200);
        }

        return response()->json(['message' => 'Feedback status changed!', 'success' => true], 200);
    }
}
