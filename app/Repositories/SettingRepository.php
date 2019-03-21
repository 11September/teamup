<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 013 13.03.19
 * Time: 9:54
 */

namespace App\Repositories;

use App\Setting;
use Illuminate\Http\Request;

class SettingRepository{

    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        return $this->setting->first();
    }

    public function first()
    {
        return $this->setting->first();
    }

    public function find($id)
    {
        return $this->setting->find($id);
    }

    public function updateOrCreate($id, array $attributes)
    {
        if (!$attributes['id'] || empty($attributes['id'])){
            unset($attributes['id']);
            return $this->setting->create($attributes);
        }

        return $this->setting->find($id)->update($attributes);
    }
}
