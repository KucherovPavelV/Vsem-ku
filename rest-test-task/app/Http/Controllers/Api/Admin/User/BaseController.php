<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Services\Api\Admin\UserService;

abstract class BaseController
{
    public UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
}
