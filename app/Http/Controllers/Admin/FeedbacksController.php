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
        $status = $this->feedbackService->updateStatus($request);

        return response()->json(
            [
                'success' => $status,
                'message' => $status

                    ? "Feedback status changed!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ],
            200
        );
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

    public function destroy($id)
    {
        $status = $this->feedbackService->delete($id);

        return redirect()->action('Admin\FeedbacksController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "The review has been successfully deleted!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }
}
