<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/**
 * Base Route
 */

Route::get('/v1', function () {
    return \App\Classes\ApiResponseClass::sendResponse(null, "Welcome to Mini X", 201);
});

/**
 * User Authentication Endpoints
 */
Route::prefix('/v1/users')->group(
    function () {
        Route::post('/signup', [\App\Http\Controllers\Api\V1\User\AuthController::class, 'signup']);
    }
);
