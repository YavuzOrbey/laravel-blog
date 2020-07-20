<?php

namespace App\Validators;

use Illuminate\Support\Facades\Http;

class ReCaptcha
{
    public function validate($attribute, $value, $parameters, $validator){

        $response = Http::post('https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>env('GOOGLE_RECAPTCHA_SECRET'),
                    'response'=>$value
                 ]
            ]
        );

        $body = json_decode((string)$response->getBody());
        return $body->success;
    }

}