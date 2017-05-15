<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageProfile()
    {
        $data = [
            'profiles' => UserProfile::paginate(5),
            'allProfilesCount' => UserProfile::count()
        ];
        return view('admin/manage-profile' , $data);
    }

    public function profileToggleStatus($id, Request $request)
    {
        $this->validate($request , [
            'status' => 'required'
        ]);
        $profile = UserProfile::find($id);
        if(!$profile)
            return response()->setStatusCode(404);

        $profile->active= $request->get('status');
        $profile->save();

        return response()->json(['action' => 'success'])->setStatusCode(202);
    }
}
