<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\MeasureService;
use App\Http\Controllers\Controller;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = null;

        return redirect()->action('Admin\UsersController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "User password successfully changed!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = null;

        return redirect()->action('Admin\UsersController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "User password successfully changed!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = null;

        return redirect()->action('Admin\UsersController@index')
            ->with([
                'success' => $status,
                'status' => $status
                    ? "success"
                    : "danger",
                'message' => $status
                    ? "User password successfully changed!"
                    : "Whoops, looks like something went wrong! Please try again later."
            ], 200);
    }
}
