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
use Illuminate\Support\Facades\Auth;

class ReportsRepository
{

    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        return $this->report->first();
    }

    public function indexOwner()
    {
        return $this->report
            ->with(array(
                'user' => function ($query) {
                    $query->select('id', 'first_name', 'last_name');
                }, 'team' => function ($query) {
                    $query->select('id', 'name');
                },
                'activity' => function ($query) {
                    $query->select('id', 'name');
                }))
            ->where('owner_id', '=', Auth::id())
            ->get();
    }

    public function first()
    {
        return $this->report->first();
    }

    public function last()
    {
        return $this->report->latest()->first();
    }

    public function find($id)
    {
        return $this->report->find($id);
    }

    public function store($attributes)
    {
        return $this->report->create($attributes);
    }

    public function update($id, array $attributes)
    {
        return $this->report->find($id)->update($attributes);
    }
}
