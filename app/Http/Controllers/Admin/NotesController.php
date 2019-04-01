<?php

namespace App\Http\Controllers\Admin;

use App\Note;
use App\Services\NoteService;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteUpdateAdmin;

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
     * edit [id]
     *
     * @return [view]
     */
    public function edit(Note $note)
    {



        return view('admin.notes.edit', compact('note'));
    }


    /**
     * update [id]
     *
     * @return [redirect]
     */
    public function update(NoteUpdateAdmin $request)
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
    public function destroy($id)
    {
        $status = $this->noteService->delete($id);

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
