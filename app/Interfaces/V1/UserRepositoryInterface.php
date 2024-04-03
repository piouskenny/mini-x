<?php

namespace App\Interfaces\V1;

interface UserRepositoryInterface
{
    public function signup(array $data);

    public function verifyEmail(int $user_id, int $otp);

    public function login(array $data);

    public function updateProfile(array $data);

    public function viewProfile(int $userId);
}
