<?php

namespace App\Services\Api\Admin;

use App\Http\Resources\UserPlaceResource;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class UserPlaceService
{
    public function store($data)
    {
        try {
            $user = User::findOrFail($data['user_id']);
            if ($user->favoritePlaces()->count() >= 3) {
                return response(['error' => 'There are already 3 entries in favorites'], 400);
            }elseif ($user->favoritePlaces()->where('place_id', $data['place_id'])->exists()) {
                return response(['error' => 'This place is already a favorite for this user.'], 400);
            }
            $user->favoritePlaces()->attach($data['place_id']);
            return response(UserPlaceResource::collection($user->favoritePlaces), 201);
        } catch (QueryException $exception) {
            return response(['error' => 'database error'], 400);
        }
    }

    public function show($id): \Illuminate\Http\Response
    {
        try {
            $user = User::findOrFail($id);
            return response(UserPlaceResource::collection($user->places), 200);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => "User id - {$id} not found"], 404);
        } catch (QueryException $exception) {
            return response(['error' => 'Invalid ID format or database error'], 400);
        }
    }

    public function destroy($data, $id,): \Illuminate\Http\Response
    {
        try {
            $user = User::findOrFail($id,);
            $userPlace = $user->getPlaceById($data['place_id']);
            if ($userPlace) {
                $user->favoritePlaces()->detach($data['place_id']);
                return response(null, 204);
            } else {
                return response(['message' => "place id in user favorites not found"], 404);
            }
        } catch (ModelNotFoundException $exception) {
            return response(['message' => "user id - {$data['user_id']} not found "], 404);
        } catch (QueryException $exception) {
            return response(['error' => 'Invalid ID format or database error'], 400);
        }
    }
}
