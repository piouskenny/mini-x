<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\OTPRequest;
use App\Http\Requests\V1\UserSignupRequest;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;
use App\Interfaces\V1\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class AuthController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepositoryInterface)
    {
    }

    public function signup(UserSignupRequest $request)
    {
        $userDetails = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ];

        DB::beginTransaction();

        try {
            $user =  $this->userRepositoryInterface->signup($userDetails);
            DB::commit();
            return ApiResponseClass::sendResponse(new UserResource($user),'Account Create Successful',201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function verifyEmail(OTPRequest $request)
    {
        $userDetails = [
            'user_id' => $request->user_id,
            'otp' => $request->otp
        ];

        DB::beginTransaction();
        try {
            $verify = $this->userRepositoryInterface->verifyEmail($userDetails['user_id'], $userDetails['otp'] );
            DB::commit();

            return ApiResponseClass::sendResponse(new UserResource($verify), 'Your Email has been verified ', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e, 'Check your OTP and retry again');
        }

    }
}
