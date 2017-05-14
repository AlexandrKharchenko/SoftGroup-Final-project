<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function index()
    {
        return view('front-end/account/index');
    }

    public function likeProfile()
    {
        return view('front-end/account/like-profile');
    }
}
