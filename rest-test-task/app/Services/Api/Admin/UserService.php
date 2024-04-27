<?php

namespace App\Services\Api\Admin;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;


class UserService
{

    public function update($data, $id): \Illuminate\Http\Response
    {
        try {
            $user = User::findOrFail($id);
            $user->update($data);
            return response(new UserResource($user));
        } catch (ModelNotFoundException $exception) {
            return response(['message' => "id - {$id} not found"], 404);
        } catch (QueryException $exception) {
            return response(['error' => 'Invalid ID format or database error'], 400);
        }
    }
    public function show($id): \Illuminate\Http\Response
    {
        try {
            $user = User::findOrFail($id);
            return response(new UserResource($user), 200);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => "id - {$id} not found"], 404);
        } catch (QueryException $exception) {
            return response(['error' => 'Invalid ID format or database error'], 400);
        }
    }

    public function destroy($id): \Illuminate\Http\Response
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response(null, 204);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => "id - {$id} not found"], 404);
        } catch (QueryException $exception) {
            return response(['error' => 'Invalid ID format or database error'], 400);
        }
    }
}
