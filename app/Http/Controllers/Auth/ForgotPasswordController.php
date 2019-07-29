<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateEmail(Request $request)
    {
        $this->validate($request, $this->validateRules(), $this->validateMessages());
    }

    /**
     * @return array
     */
    protected function validateRules()
    {
        return [
            'email'   => 'required|email',
            'captcha' => 'required|captcha',
        ];
    }

    /**
     * @return array
     */
    protected function validateMessages()
    {
        return [
            'captcha.required' => '请输入验证码',
            'captcha.captcha'  => '验证码不匹配',
        ];
    }
}
