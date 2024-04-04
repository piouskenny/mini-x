<?php

use App\Http\Controllers\Api\V1\User\AuthController;
use App\Http\Controllers\Api\V1\User\ProfileController;
use App\Http\Controllers\Api\V1\Posts\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/**
 * Base Route
 */
Route::get('/v1', function () {
    return \App\Classes\ApiResponseClass::sendResponse(null, "Welcome to Mini X", 201);
});


/**
 * Fall back Route that will display all posts
 */
//Route::fallback(PostController::class, 'all')->middleware('auth:sanctum');


/**
 * Version 1 Route
 */
Route::prefix('/v1')->group(
    function () {
        /**
         * User Authentication Endpoints
         */
        Route::prefix('/users')->group(
            function () {
                Route::post('/signup', [AuthController::class, 'signup']);
                Route::post('/verify.email', [AuthController::class, 'verifyEmail']);
                Route::post('/login', [AuthController::class, 'login']);

                Route::middleware('auth:sanctum')->group(
                    function() {
                        Route::post('/update.profile/{id}', [ProfileController::class, 'updateProfile']);
                        Route::get('/view.profile/{id}', [ProfileController::class, 'viewProfile']);
                    }
                );
            }
        );

        /**
         * Post Management Endpoint
         */
        Route::prefix('/posts')->middleware('auth:sanctum')->group(
            function () {
                Route::get('/', [PostController::class, 'all']);
            }
        );
    }
);


