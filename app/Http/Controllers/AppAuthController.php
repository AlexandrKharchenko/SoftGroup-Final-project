<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AppAuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')] , $request->get('remember'))) {
            // Authentication passed...
            return response()->json([
                'redirect' => route('user.profile.index')
            ]);
        }

        return response()->json([
            'email' => [
                'Пользователь не найден или неверные данные.'
            ]
        ])->setStatusCode(422);
    }


    public function register(Request $request)
    {



        $this->validate($request, [
           'email' => 'required|email|unique:users',
           'name' => 'required|min:3',
           'password' => 'required|min:6|confirmed',

        ]);




        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);


        Auth::login($user);







        return response()->json([
            'redirect' => route('user.profile.index')
        ]);
    }
}
