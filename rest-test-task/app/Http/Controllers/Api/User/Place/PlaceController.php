<?php

namespace App\Http\Controllers\Api\User\Place;

use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Response;


class PlaceController extends BaseController
{

    public function index(): Response
    {
        return response(PlaceResource::collection(Place::all()), 200);
    }


    public function show($id): Response
    {
        return $this->service->show($id);
    }


}
