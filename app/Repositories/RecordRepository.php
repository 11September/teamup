<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 15:11
 */

namespace App\Repositories;

use App\Record;

class RecordRepository
{

    protected $record;

    public function __construct(Record $record)
    {
        $this->record = $record;
    }

    public function create($attributes)
    {
        return $this->record->create($attributes);
    }

    public function all()
    {
        return $this->record->latest()->get();
    }

    public function find($id)
    {
        return $this->record->find($id);
    }

    public function findEmail($email)
    {
        return $this->record->where('email', $email)->first();
    }

    public function findByAttr($attribute, $value)
    {
        return $this->record->where($attribute, $value)->first();
    }

    public function update($id, array $attributes)
    {
        return $this->record->findOrFail($id)->update($attributes);
    }

    public function update_field($id, $field, $attribute)
    {
        return $this->record->findOrFail($id)->update([$field => $attribute]);
    }

    public function delete($id)
    {
        return $this->record->findOrFail($id)->delete();
    }
}
