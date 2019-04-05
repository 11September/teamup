<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 025 25.03.19
 * Time: 16:04
 */

namespace App\Services\Api;

use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Repositories\NoteRepository;

class NoteService
{
    public function __construct(NoteRepository $noteRepository)
    {
        $this->note = $noteRepository;
    }

    public function index()
    {
        return $this->note->userNotes();
    }

    public function store(Request $request)
    {
        $attributes = $this->prepareData($request);

        return $this->note->create($attributes);
    }

    public function update(Request $request)
    {
        $attributes = $this->prepareData($request);

        return $this->note->update($request->id, $attributes);
    }

    public function deleteArray($request)
    {
        return $this->note->deleteArray($request->ids);
    }

    public function prepareData(Request $request)
    {
        $attributes['note'] = $request->note;
        $attributes['user_id'] = auth()->user()->id;
        $attributes['date'] = UserHelper::getCurrentDate();

        return $attributes;
    }
}
