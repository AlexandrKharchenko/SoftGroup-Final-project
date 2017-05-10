<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppAuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        return response()->json($request->all());
    }


    public function register(Request $request)
    {
        $this->validate($request, [
           'email' => 'email|min:988',
           'name' => 'email:min:988',
        ]);



        return response()->json($request->all());
    }
}
