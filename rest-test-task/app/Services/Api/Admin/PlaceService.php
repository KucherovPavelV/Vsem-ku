<?php

namespace App\Services\Api\Admin;

use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class PlaceService
{
    public function update($data, $id): \Illuminate\Http\Response
    {
        try {
            $place = Place::findOrFail($id);
            $place->update($data);
            return response(new PlaceResource($place));
        } catch (ModelNotFoundException $exception) {
            return response(['message' => "id - {$id} not found"], 404);
        } catch (QueryException $exception) {
            return response(['error' => 'Invalid ID format or database error'], 400);
        }
    }
    public function show($id): \Illuminate\Http\Response
    {
        try {
            $place = Place::findOrFail($id);
            return response(new PlaceResource($place), 200);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => "id - {$id} not found"], 404);
        } catch (QueryException $exception) {
            return response(['error' => 'Invalid ID format or database error'], 400);
        }
    }

    public function destroy($id): \Illuminate\Http\Response
    {
        try {
            $place = Place::findOrFail($id);
            $place->delete();
            return response(null, 204);
        } catch (ModelNotFoundException $exception) {
            return response(['message' => "id - {$id} not found"], 404);
        } catch (QueryException $exception) {
            return response(['error' => 'Invalid ID format or database error'], 400);
        }
    }
}
