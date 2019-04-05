<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 16:31
 */

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\ReportsRepository;

class ReportsService
{
    public function __construct(ReportsRepository $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        return true;

//        return $this->report->update_field($id, "password", $password);
    }
}

