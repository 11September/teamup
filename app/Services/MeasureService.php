<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 027 27.03.19
 * Time: 15:12
 */

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Repositories\MeasureRepository;

class MeasureService
{
    public function __construct(MeasureRepository $measureRepository)
    {
        $this->measure = $measureRepository;
    }


    public function index()
    {
        try {
            return $this->measure->index();

        } catch (\Exception $exception) {
            Log::warning('MeasureService@index Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Oops! Something went wrong!'], 500);
        }
    }


    public function show(Request $request)
    {
        try {
            return $this->measure->findByAttr('name', $request->name);

        } catch (\Exception $exception) {
            Log::warning('MeasureService@show Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Oops! Something went wrong!'], 500);
        }
    }


    public function update(Request $request)
    {
        try {
            $attributes = $request->all();

            return $this->measure->updateOrCreate($request->id, $attributes);

        } catch (\Exception $exception) {
            Log::warning('MeasureService@update Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Oops! Something went wrong!'], 500);
        }
    }


    public function delete($id)
    {
        try {
            return $this->measure->delete($id);

        } catch (\Exception $exception) {
            Log::warning('MeasureService@update Exception: ' . $exception->getMessage());
            return response()->json(['message' => 'Oops! Something went wrong!'], 500);
        }
    }

}
