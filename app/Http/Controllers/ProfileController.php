<?php

namespace App\Http\Controllers;

use App\Events\UserCreateProfile;

use App\Events\UserUpdateProfile;
use App\Models\LikeProfile;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\Image;

use League\Fractal;
use League\Fractal\Manager;


class ProfileController extends Controller
{

    public function index()
    {

        return view('front-end/profile/index');
    }


    public function all()
    {
        $data = [
            'profiles' => UserProfile::active()->paginate(10)
        ];
        return view('front-end/profile/all' , $data);
    }

    public function detail($id)
    {

        $profile = UserProfile::active()->with(['likes.profile' , 'user'])->where('id' , $id)->first();

        if(!$profile)
            abort(404);



        $data = [
            'profile' => $profile,

        ];

        return view('front-end/profile/detail' , $data);
    }


    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'middle_name' => 'required|min:3',
            'github_url' => 'min:3|url',
            'bdate' => 'required|date_format:d.m.Y',
            'about' => 'min:20',
        ]);



        // TODO: Загрузка изображения
        if($request->file('photo') && $request->get('editPhoto') == 'true'){

            $this->validate($request, [
                'photo' => 'image'
            ]);


            $ext = $request->file('photo')->getClientOriginalExtension();
            $photoName = Auth::id().'avatar.' . $ext;
            $request->file('photo')->move(public_path('photos') , $photoName);

        }

        $profile = UserProfile::where('user_id' , \Auth::id())->first();


        if($profile)
            broadcast(new UserUpdateProfile($profile));

        if(!$profile) {
            $profile = new UserProfile;
            $profile->user_id = Auth::id();
            $profile->active = 1;

            broadcast(new UserCreateProfile($profile));
        }


        if(isset($photoName))
            $profile->photo = 'photos/' . $photoName;

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
        if(!Auth::check())
            return response()->setStatusCode(401);

        $profile = UserProfile::find($id);
        if(!$profile)
            return response()->setStatusCode(404);


        $res = Auth::User()->likes()->toggle($profile);
        return $res;


    }



    public function apiGetProfileLikes($id , UserProfile $userProfile)
    {
        $profile = $userProfile->find($id);
        if(!$profile) {
            return response()->json([
                'error' => true,
                'message' => 'Профиль не найден',
            ])->setStatusCode(402);
        }


        $likes = $profile->likes()->with('profile')->get();

        $likeResource = new Fractal\Resource\Collection($likes, function($like) {
            return [
                'user_name' => "{$like->profile->first_name} {$like->profile->last_name}",
                'url_profile' => route('user.profile.detail' , $like->profile->id)
            ];
        });

        $fractalManager = new Manager();
        $likeData = $fractalManager->createData($likeResource)->toArray();


        # Если авторизован проверим ставил ли текущий юзер лайк профилю
        if(Auth::check() && Auth::user()->likes()->where('profile_id' , $id)->first()){
            $data = [
                'isLike' => true,
                'likes' => $likeData,
            ];
        } else {
            $data = [
                'isLike' => false,
                'likes' => $likeData,
            ];
        }

        return response()->json($data);
    }


    public function apiGetProfile()
    {
        $profile = \Auth::user()->profile()->first();
        return response()->json(['profile' => $profile]);
    }
}
