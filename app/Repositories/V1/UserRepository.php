<?php

namespace App\Repositories\V1;

use App\Classes\ApiResponseClass;
use App\Models\OTP;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Contracts\HasApiTokens;
use Illuminate\Http\Request;
use App\Interfaces\V1\UserRepositoryInterface;
use App\Classes\EmailClass;


class UserRepository implements UserRepositoryInterface
{

    /**
     * Create a new class instance.
     */
    public function signup(array $data)
    {
        $user = User::create($data);

        /**
         * Create OTP for user
         */
        $otp = rand(1000, 9999);

        OTP::create([
            'user_id' => $user->id,
            'otp' => $otp,
        ]);

        /**
         * Send otp to user email
         */
        try {
            $emailClass = new EmailClass($otp,$user->email);
        } catch (\Exception $e) {
            return false;
        }
        return $user;
    }

    public function verifyEmail(int $user_id, int $otp)
    {
        $user = User::find($user_id)->first();

        if ($user) {

            /**
             * Check if the OTP matches the user OTP in the OTP table
             * */
            $storedOTP = OTP::where('user_id', $user_id)->first();


            if($storedOTP->otp !== $otp) {
               return false;
            }

            $storedOTP->delete();

            $user->update([
                'verificationStatus' => true
            ]);

            return $user;
         }
        return false;
    }

    public function login(array $data)
    {

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = Auth::user();


            $token = $user->createToken('Token')->plainTextToken;
            $user['token'] = $token;

            return $user;
        }
        return false;
    }

    public function updateProfile(array $data)
    {
        $user = User::findOrFail($data->id);
        $user->update($data);
        return $user;
    }

    public function viewProfile($id)
    {
        return User::findOrFail($id);
    }
}
