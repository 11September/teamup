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
use App\Repositories\MeasureRepository;

class MeasureService
{
    public function __construct(MeasureRepository $measureRepository)
    {
        $this->measure = $measureRepository;
    }


    public function index()
    {
        return $this->measure->index();
    }


    public function show(Request $request)
    {
        return $this->measure->findByAttr('name', $request->name);
    }


    public function update(Request $request)
    {
        $attributes = $request->all();

        return $this->measure->updateOrCreate($request->id, $attributes);
    }


    public function delete($id)
    {
        return $this->measure->delete($id);
    }

}
