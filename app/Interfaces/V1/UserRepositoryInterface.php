<?php

namespace App\Interfaces\V1;

interface UserRepositoryInterface
{
    public function signup(array $data);

    /**
     * This receives the user Id and the OTP
     */
    public function verifyEmail(array $data);

    public function login(array $data);

    public function updateProfile(array $data);

    public function viewProfile(int $userId);
}
