<?php

namespace App\Validators;

use Illuminate\Support\Facades\Http;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator){
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',
                [
                    'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
                    'response' =>$value,
                ]
        );
        $body = json_decode($response->getBody());
        return $body->success;
    }

}