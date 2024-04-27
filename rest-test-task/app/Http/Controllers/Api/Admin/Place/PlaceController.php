<?php

namespace App\Http\Controllers\Api\Admin\Place;

use App\Http\Requests\Admin\Place\StoreRequest;
use App\Http\Requests\Admin\Place\UpdateRequest;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Response;


class PlaceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response(PlaceResource::collection(Place::all()), 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): Response
    {
        return response(new PlaceResource(Place::Create($request->validated())), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id): Response
    {
        return $this->service->update($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): Response
    {
        return $this->service->destroy($id);
    }
}
