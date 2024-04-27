<?php

namespace App\Http\Controllers\Api\User\Place;

use App\Services\Api\Admin\PlaceService;

abstract class BaseController
{
    public PlaceService $service;

    public function __construct(PlaceService $service)
    {
        $this->service = $service;
    }
}
