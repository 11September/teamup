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
     * index
     *
     *
     * @return [view]
     */

    public function index()
    {
        $feedbacks = $this->feedbackService->index();

        return view('admin.feedbacks.index', compact('feedbacks'));
    }


    /**
     * loginFeedback
     *
     * @param  [int] id
     * @param  [text] feedback
     *
     * @return [json] text
     * @return [json] status
     */

    public function update(Request $request)
    {
        if (!$this->feedbackService->updateStatus($request)){
            return response()->json(['message' => 'Feedback status changed!', 'success' => false], 200);
        }

        return response()->json(['message' => 'Feedback status changed!', 'success' => true], 200);
    }


    /**
     * destroy
     *
     * @param  [int] id
     * @param  [text] feedback
     *
     * @return [json] text
     * @return [json] status
     */

    public function destroy(Request $request)
    {
        return response()->json(['message' => 'Feedback status changed!', 'success' => true], 200);
    }
}
