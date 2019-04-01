<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 025 25.03.19
 * Time: 11:56
 */

namespace App\Repositories;

use App\Note;
use Illuminate\Support\Facades\Auth;

class NoteRepository
{
    protected $note;

    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    public function index()
    {
        return $this->note->where('user_id', Auth::id())->get();
    }

    public function create($attributes)
    {
        return $this->note->create($attributes);
    }

    public function update($id, $attributes)
    {
        return $this->note->findOrFail($id)->update($attributes);
    }

    public function update_field($id, $field, $attribute)
    {
        return $this->note->findOrFail($id)->update([$field => $attribute]);
    }

    public function delete($id)
    {
        return $this->note->findOrFail($id)->delete();
    }
}
