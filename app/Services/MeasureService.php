<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 027 27.03.19
 * Time: 15:12
 */

namespace App\Services;

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

}
