<?php

namespace App\Classes;

use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;

class EmailClass
{
    /**
     * Create a new class instance.
     */
    public function __construct($otp, $recipientMail)
    {
        $title = 'OTP Verification For Mini X';
        $body = "Your OTP is $otp Thank you for signup to Mini X, Please Contact us if you did not initiate this process.!";

        $mail = Mail::to($recipientMail)->send(new OTPMail($title, $body));

        if(!$mail) {
            return false;
        }
        return true;
    }
}
