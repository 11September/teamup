<?php

namespace App\Http\Controllers\Admin;

use App\Services\MeasureService;
use App\Http\Controllers\Controller;
use App\Http\Requests\MeasureStoreOrUpdate;

class MeasuresController extends Controller
{
    protected $measuresService;

    public function __construct(MeasureService $measureService)
    {
        $this->measuresService = $measureService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $measures = $this->measuresService->index();

        return view('admin.measures.index', compact('measures'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeasureStoreOrUpdate $request)
    {
        $status = $this->measuresService->update($request);

        $measure = $this->measuresService->show($request);

        return response()->json(
            [
                'id' => $measure->id,
                'success' => $status,
                'message' => $status

                    ? "Measures saved successfully!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ],
            200
        );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id ? $status = $this->measuresService->delete($id) : $status = false;

        return response()->json(
            [
                'success' => $status,
                'message' => $status

                    ? "Measures deleted successfully!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ],
            200
        );
    }
}
