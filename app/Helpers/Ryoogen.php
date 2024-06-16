<?php

use App\Models\Otp;

if (!function_exists('otp_code')) {
    function otp_code($email = null)
    {
        if ($email) {
            $data = Otp::where('email', $email);

            if ($data->exists() && $data->date_active <= now()) {
                $data = $data->first();
                return $data->code_otp;
            }
        }

        $x = true;
        while ($x) {
            $digits = 6;
            $random = substr(str_shuffle("0123456789"), 0, $digits);

            if (!Otp::where('code_otp', $random)->first()) {
                return $random;
            }
        }
    }
}
