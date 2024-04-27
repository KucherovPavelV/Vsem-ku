<?php

namespace App\Http\Controllers\Api\Admin\UserPlace;

use App\Http\Requests\Admin\UserPlace\DestroyRequest;
use App\Http\Requests\Admin\UserPlace\StoreRequest;
use App\Http\Resources\UserPlacesResource;
use App\Models\UserPlace;
use Illuminate\Http\Response;


class UserPlaceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response(UserPlacesResource::collection(UserPlace::all())->groupBy('user_id'), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): Response
    {
        return $this->service->store($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        return $this->service->show($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request, $id): Response
    {
        return $this->service->destroy($request->validated(), $id);
    }
}
