<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Interfaces\V1\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepositoryInterface)
    {
    }


    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required | string'
        ]);

        $userDetails = [
            'id' => $id,
            'name' => $request->name,
        ];

        DB::beginTransaction();

        try {
            $updateProfile = $this->userRepositoryInterface->updateProfile($userDetails);
            DB::commit();

            return ApiResponseClass::sendResponse(new UserResource($updateProfile), "Profile has been update", 201 );
        } catch (\Exception $e) {
            report($e);

            return ApiResponseClass::rollback($e, "Opps sorry, something went wrong");
        }
    }
}
