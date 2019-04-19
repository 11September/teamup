<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\Api\RecordService;
use App\Http\Controllers\Controller;

class RecordsController extends Controller
{
    protected $userservice;
    protected $recordService;

    public function __construct(UserService $userservice, RecordService $recordService)
    {
        $this->userservice = $userservice;
        $this->recordService = $recordService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $records = $this->recordService->getUserRecords($request);

            return response()->json(['data'=> $records, 'success' => true]);
        }

        $records = $this->recordService->index();

        return view('admin.users.index', compact('records'));
    }
}
