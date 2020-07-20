<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReCaptchaTestFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=> 'bail|required|email',
            'fullname' => 'required',
            'message' => 'required|min:10',
            'subject' => 'nullable',
            'g-recaptcha-response'=>'required|recaptcha'
        ];
    }
}
