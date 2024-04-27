<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;


class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response(UserResource::collection(User::all()), 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): Response
    {

        return response(new UserResource(User::Create($request->validated())), 201);
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
