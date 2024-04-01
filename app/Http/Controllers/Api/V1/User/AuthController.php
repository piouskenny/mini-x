<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserSignupRequest;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;
use App\Interfaces\V1\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class AuthController extends Controller
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function signup(UserSignupRequest $request)
    {
        $userDetails = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        DB::beginTransaction();

        try {
            $user =  $this->userRepositoryInterface->signup($userDetails);
            DB::commit();

            return ApiResponseClass::sendResponse(new UserResource($user),'Product Create Successful',201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}