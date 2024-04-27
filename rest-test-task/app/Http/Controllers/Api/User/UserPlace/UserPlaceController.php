<?php

namespace App\Http\Controllers\Api\User\UserPlace;

use App\Http\Requests\User\UserPlace\StoreRequest;
use App\Http\Resources\UserPlaceResource;
use Illuminate\Http\Response;


class UserPlaceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {

        return response(UserPlaceResource::collection(auth()->user()->favoritePlaces), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): Response
    {
        return $this->service->store($request->validated());
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): Response
    {
        return $this->service->destroy($id);
    }
}
