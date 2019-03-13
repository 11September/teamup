<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 012 12.03.19
 * Time: 18:01
 */

namespace App\Relations\HasOne;

trait Goal
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function goal()
    {
        return $this->hasOne('goal');
    }
}
