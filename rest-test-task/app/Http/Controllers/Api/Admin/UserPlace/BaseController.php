<?php

namespace App\Http\Controllers\Api\Admin\UserPlace;

use App\Services\Api\Admin\UserPlaceService;

abstract class BaseController
{
    public UserPlaceService $service;

    public function __construct(UserPlaceService $service)
    {
        $this->service = $service;
    }
}
