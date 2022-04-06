<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Show the form Signin
     *
     * @return \Illuminate\Http\Response
     */
    public function showSigninForm()
    {
        return view('client.auth.signin');
    }

    /**
     * Show the form Signup
     *
     * @return \Illuminate\Http\Response
     */
    public function showForgotPasswordForm()
    {
        return view('client.auth.forgot-password');
    }
}
