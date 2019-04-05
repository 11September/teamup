<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\NoteStore;
use App\Http\Requests\NoteDelete;
use App\Services\Api\NoteService;
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

        return response()->json(['data' => $notes], 200);
    }


    /**
     * store
     *
     * @param  [string] note
     *
     * @return [json]
     */
    public function store(NoteStore $request)
    {
        $this->noteService->store($request);

        return response()->json(['message' => 'Notes have been saved!'], 201);
    }


    /**
     * update [id]
     *
     * @param  [int] id
     * @param  [string] note
     *
     * @return [json]
     */
    public function update(NoteUpdate $request)
    {
        $this->noteService->update($request);

        return response()->json(['message' => 'Notes have been updated!'], 200);
    }


    /**
     * delete
     * @param  [array] ids
     *
     * @return [json]
     */
    public function destroy(NoteDelete $request)
    {
        $this->noteService->deleteArray($request);

        return response()->json(['message' => 'Notes have been deleted!'], 200);
    }
}
