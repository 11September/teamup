<?php
/**
 * Created by PhpStorm.
 * User: 11September
 * Git: https://github.com/11September
 * Date: 025 25.03.19
 * Time: 11:56
 */

namespace App\Repositories;

use App\Feedback;

class FeedbackRepository
{
    protected $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    public function create($attributes)
    {
        return $this->feedback->create($attributes);
    }
}
