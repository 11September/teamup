<?php

namespace App\Http\Controllers\Admin;

use App\Note;
use Illuminate\Http\Request;
use App\Services\NoteService;
use App\Http\Requests\NoteUpdate;
use App\Http\Controllers\Controller;

class NotesController extends Controller
{
    protected $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }


    /**
     * index
     *
     * @return [view]
     */
    public function index()
    {
        $notes = $this->noteService->index();

        return view('admin.notes.index', compact('notes'));
    }


    /**
     * create
     *
     * @return [view]
     */
    public function create()
    {
        return view('admin.notes.create');
    }



    /**
     * store
     *
     * @return [view]
     */
    public function store(Request $request)
    {
        $status = $this->noteService->store($request);

        return redirect()->action('Admin\NotesController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "The note has been successfully updated!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }


    /**
     * edit [id]
     *
     * @return [view]
     */
    public function edit(Note $note)
    {
        if ($note->user_id !== auth()->user()->id) {
            return redirect()->back()->with([
                'success' => true,
                'status' => "danger",
                'message' => 'You cannot access this page!',
            ]);
        }

        return view('admin.notes.edit', compact('note'));
    }


    /**
     * update [id]
     *
     * @return [redirect]
     */
    public function update(NoteUpdate $request)
    {
        $status = $this->noteService->update($request);

        return redirect()->action('Admin\NotesController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "The note has been successfully updated!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }


    /**
     * destroy [id]
     *
     * @return [redirect]
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== auth()->user()->id) {
            return redirect()->back()->with([
                'success' => true,
                'status' => "danger",
                'message' => 'You cannot access this page!',
            ]);
        }

        $status = $this->noteService->delete($note->id);

        return redirect()->action('Admin\NotesController@index')
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
