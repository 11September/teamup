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
use Illuminate\Support\Facades\Log;
use App\Repositories\NoteRepository;

class NoteService
{
    public function __construct(NoteRepository $noteRepository)
    {
        $this->note = $noteRepository;
    }

    public function index()
    {
        try {
            return $this->note->index();

        } catch (\Exception $exception) {
            Log::warning('NoteService@index Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Oops! Something went wrong!'], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            return $this->note->update_field($request->id, 'note', $request->note);

        } catch (\Exception $exception) {
            Log::warning('FeedbackService@updateStatus Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Oops! Something went wrong!'], 500);
        }
    }

    public function delete($id)
    {
        try {
            return $this->note->delete($id);

        } catch (\Exception $exception) {
            Log::warning('FeedbackService@delete Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Oops! Something went wrong!'], 500);
        }
    }
}
