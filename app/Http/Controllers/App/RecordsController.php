<?php

namespace App\Http\Controllers\App;

use App\Services\Api\RecordService;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecordStoreApi;

class RecordsController extends Controller
{
    protected $recordService;

    public function __construct(RecordService $recordService)
    {
        $this->recordService = $recordService;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecordStoreApi $request)
    {
        $this->recordService->store($request);

        return response()->json([
            "message" => "Record saved successfully!"
        ]);
    }
}
