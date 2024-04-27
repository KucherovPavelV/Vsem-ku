<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'AdminMiddleware']], function () {
Route::resource('places', \App\Http\Controllers\Api\Admin\Place\PlaceController::class)->only([
    'index', 'show', 'destroy', 'store', 'update'
]);
Route::resource('users', \App\Http\Controllers\Api\Admin\User\UserController::class)->only([
    'index', 'show', 'destroy', 'store', 'update'
]);
Route::resource('user-places', \App\Http\Controllers\Api\Admin\UserPlace\UserPlaceController::class)->parameters([
    'user-places' => 'user'
])->only([
    'index', 'show', 'destroy', 'store'
]);
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('user-places', \App\Http\Controllers\Api\User\UserPlace\UserPlaceController::class)->parameters([
        'user-places' => 'place'
    ])->only([
        'index', 'destroy', 'store'
    ]);
});
Route::resource('places', \App\Http\Controllers\Api\User\Place\PlaceController::class)->only([
    'index', 'show'
]);



