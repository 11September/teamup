<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 9:54
 */

namespace App\Repositories;

use App\Report;

class ReportsRepository{

    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        return $this->report->first();
    }

    public function first()
    {
        return $this->report->first();
    }

    public function find($id)
    {
        return $this->report->find($id);
    }
}
