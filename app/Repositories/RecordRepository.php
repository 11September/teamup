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

    public function userStats($id)
    {
        return $this->record
            ->select('id', 'activity_id', 'user_id', 'value', 'date')
            ->where('user_id', $id)
            ->whereHas('activities', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();
    }

    public function getUsersRecords($user_id)
    {
        return $this->record
            ->select('id', 'activity_id', 'user_id')
            ->where('user_id', $user_id)
            ->distinct()
            ->get(['activity_id']);
    }

    public function getUsersRecordsToReport($user_id, $activity_id, $format, $from_date)
    {
        $to = Carbon::now();
//        $sort = "asc";

//        dd($from_date, $to);

        return $this->record
            ->select('id', 'activity_id', 'user_id', 'value', 'date', 'notice')
            ->where('user_id', $user_id)
            ->where('activity_id', $activity_id)
            ->whereBetween('date', [$from_date, $to])
            ->orderBy('date')
//            ->orderBy('value', $sort)
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy(function ($val) use ($format) {
                return Carbon::parse($val->date)->setTimezone('America/Vancouver')->format($format);
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
