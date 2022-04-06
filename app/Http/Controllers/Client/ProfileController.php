<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {

    }

    /**
     *
     */
    public function profileDetail($userId)
    {
        return view('client.profile.detail');
    }

    /**
     *
     */
    public function settingMyProfile()
    {
        return view('client.profile.my-setting');
    }
}
