<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Image;


class ProfileController extends Controller
{

    public function index()
    {

        return view('front-end/profile/index');
    }


    public function all()
    {
        $data = [
            'profiles' => UserProfile::paginate(10)
        ];
        return view('front-end/profile/all' , $data);
    }

    public function detail($id)
    {

        $profile = UserProfile::with(['user.likes' => function($q) use($id){
            $q->where('profile_id' ,$id);
        }])->where('id' , $id)->first();

        
        if(!$profile)
            abort(404);

        $data = [
            'profile' => $profile
        ];
        return view('front-end/profile/detail' , $data);
    }


    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'middle_name' => 'required|min:3',
            'github_url' => 'min:3',
            'bdate' => 'required|date_format:d.m.Y',
            'about' => 'min:20',
        ]);


        // TODO: Загрузка изображения

        $profile = UserProfile::where('user_id' , \Auth::id())->first();


        if(!$profile) {
            $profile = new UserProfile;
            $profile->user_id = \Auth::id();
        }
        $profile->first_name = $request->get('first_name');
        $profile->last_name = $request->get('last_name');
        $profile->middle_name = $request->get('middle_name');
        $profile->github_url = $request->get('github_url');
        $profile->bdate = $request->get('bdate');
        $profile->phone = $request->get('phone');
        $profile->about = $request->get('about');
        $profile->save();




        return ['response' => 'ok' , 'profile' => $profile ];
    }


    public function toggleLike($id, Request $request)
    {
        $profile = UserProfile::find($id);
        if(!$profile)
            return null;


        $res = \Auth::User()->likes()->toggle($profile);
        return $res;


    }


    public function apiGetProfile()
    {
        $profile = \Auth::user()->profile()->first();
        return response()->json(['profile' => $profile]);
    }
}
