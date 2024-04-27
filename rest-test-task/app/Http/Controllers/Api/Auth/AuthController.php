<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(StoreRequest $request): JsonResponse
    {
        \App\Models\User::Create($request->validated());
        return $this->respondWithToken(auth()->attempt($request->validated()), 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (! $token = auth()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token, 200);
    }

    public function me(): JsonResponse
    {
        return response()->json(new UserResource(auth()->user()));
    }

    public function logout(Request $request): JsonResponse
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh(), 200);
    }

    protected function respondWithToken($token, $status): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ],$status);
    }
}
