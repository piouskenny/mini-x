<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/**
 * Base Route
 */

Route::get('/', function () {
    return \App\Classes\ApiResponseClass::sendResponse(null, "Welcome to Mini X", 201);
});

/**
 * User Authencication Endpoints
 */
Route::prefix('/user')->group(
    function () {
        Route::get('/signup', [\App\Http\Controllers\Api\V1\User\AuthController::class, 'signup']);
    }
);

Route::prefix('/user')->middleware('auth:sanctum')->group(
    function () {
        Route::get('/{$id}');

    }
);
