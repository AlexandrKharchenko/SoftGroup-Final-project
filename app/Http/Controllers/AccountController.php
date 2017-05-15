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
        $data = [
            'profiles' => \Auth::user()->likes()->paginate(10)
        ];
        return view('front-end/account/like-profile' , $data);
    }
}
