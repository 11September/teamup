<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 012 12.03.19
 * Time: 15:11
 */

namespace App\Repositories;

use App\Record;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordRepository
{

    protected $record;

    public function __construct(Record $record)
    {
        $this->record = $record;
    }

    public function getUsersRecords($user_id)
    {
        return $this->record
            ->select('id', 'activity_id', 'user_id')
            ->where('user_id', $user_id)
            ->distinct()
            ->get(['activity_id']);
    }

    public function getUsersRecordsToReport($user_id, $activity_id, $sort, $format = "M")
    {
        $now = Carbon::now();
        $from = $now->subYear();
        $to = Carbon::now();

        return $this->record
            ->where('user_id', $user_id)
            ->where('activity_id', $activity_id)
            ->whereBetween('date', [$from, $to])
            ->orderBy('date')
            ->orderBy('value', $sort)
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy(function ($val) use ($format) {
                return Carbon::parse($val->date)->format($format);
            });
    }

    public function getUsersRecordsToReportApi(Request $request)
    {
        $format_group = $request->format_group ? $request->format_group : "M";

        return $this->record
            ->where('user_id', Auth::id())
            ->where('activity_id', $request->activity_id)
            ->filter($request)
            ->get()
            ->groupBy(function ($val) use ($format_group) {
                return Carbon::parse($val->date)->format($format_group);
            });
    }

    public function create($attributes)
    {
        return $this->record->create($attributes);
    }

    public function all()
    {
        return $this->record->latest()->get();
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
