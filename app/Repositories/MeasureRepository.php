<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 027 27.03.19
 * Time: 15:16
 */

namespace App\Repositories;

use App\Measure;
use Illuminate\Support\Facades\DB;

class MeasureRepository
{
    protected $measure;

    public function __construct(Measure $measure)
    {
        $this->measure = $measure;
    }

    public function index()
    {
        return $this->measure->select('id', 'name')->get();
    }

    public function indexApi($attributes)
    {
        return $this->measure
            ->select('id', 'name')
            ->filter($attributes)
            ->get();
    }

    public function findByAttr($attribute, $value)
    {
        return $this->measure->where($attribute, $value)->first();
    }

    public function updateOrCreate($id, array $attributes)
    {
        return $this->measure->updateOrInsert(['id' => $id], $attributes);
    }

    public function delete($id)
    {
        return $this->measure->findOrFail($id)->delete();
    }
}
