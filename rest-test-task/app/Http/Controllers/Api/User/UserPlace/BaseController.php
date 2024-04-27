<?php

namespace App\Http\Controllers\Api\User\UserPlace;

use App\Services\Api\User\UserPlaceService;

abstract class BaseController
{
    public UserPlaceService $service;

    public function __construct(UserPlaceService $service)
    {
        $this->service = $service;
    }
}
