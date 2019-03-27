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

class MeasureRepository
{
    protected $measure;

    public function __construct(Measure $measure)
    {
        $this->measure = $measure;
    }

    public function index()
    {
        return $this->measure->all();
    }
}
