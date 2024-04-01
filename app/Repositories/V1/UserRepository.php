<?php

namespace App\Repositories\V1;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Contracts\HasApiTokens;
use Illuminate\Http\Request;
use App\Interfaces\V1\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Create a new class instance.
     */
    public function signup(array $data)
    {
        return User::create($data);
    }

    public function verifyEmail(array $data)
    {
        $user = User::find($data->id);

        if ($user) {
            /**
             * Update the user's email_verified_at timestamp
             * */
            $user->email_verified_at = now();
            $user->save();
            return true;
        }
        return false;
    }

    public function login(array $data)
    {
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = Auth::user();
            $token = $user->createToken('Token')->plainTextToken;
            return ['token' => $token];
        }
        return ['error' => 'Unauthorized'];
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
