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
use App\Repositories\FeedbackRepository;

class FeedbackService
{
    public function __construct(FeedbackRepository $feedback)
    {
        $this->feedback = $feedback;
    }

    public function index()
    {
        return $this->feedback->allWithUsersName();
    }

    public function toAdminPanel()
    {
        return $this->feedback->allWithUsersName();
    }

    public function updateStatus(Request $request)
    {
        return $this->feedback->update_field($request->id, 'status', $request->status);
    }

    public function delete($id)
    {
        return $this->feedback->delete($id);
    }
}
