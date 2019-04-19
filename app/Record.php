<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = "records";

    protected $fillable = ['activity_id', 'user_id', 'value', 'date', 'notice'];

    public function getDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, Request $request)
    {
        if ($request->has('id')) {
            $query = $query->where('id', '=', $request->id);
        }

        if ($request->has('date_from') && $request->has('date_to')){
            $query = $query->whereBetween('date', [$request->date_from, $request->date_to]);
        }

        if ($request->has('date_from') && !$request->has('date_to')){
            $query = $query->whereBetween('date', [$request->date_from, $now = Carbon::now()]);
        }

        if (!$request->has('date_from') && $request->has('date_to')){
            $query = $query->whereBetween('date', [Carbon::now()->subYear(), $request->date_to]);
        }

        if ($request->has('order_value_by')) {
            $query = $query->orderBy('value', $request->order_value_by);
        }

        if ($request->has('order_date_by')) {
            $query = $query->orderBy('date', $request->order_date_by);
        }

        return $query;
    }
}
