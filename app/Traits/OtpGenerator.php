<?php

namespace App\Traits;

trait OtpGenerator{

    public function randomOtp()
    {
        $number = '1234567890';
        $otp = array(); //remember to declare $pass as an array
        $alphaLength = strlen($number) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $otp[] = $number[$n];
        }
        return implode($otp); //turn the array into a string
    }
}