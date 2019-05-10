<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Services\Api\MeasureService;
use App\Http\Controllers\Controller;

class MeasuresController extends Controller
{
    protected $measureService;

    public function __construct(MeasureService $measureService)
    {
        $this->measureService = $measureService;
    }

    public function index(Request $request)
    {
        $measures = $this->measureService->indexApi($request);

        return response()->json([
            "data" => $measures
        ]);
    }
}
