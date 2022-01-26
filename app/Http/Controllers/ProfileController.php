<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = User::findOrFail(Auth::id());
        return view("panel/profile",compact('profile'));
    }

    public function upload(Request $request)
    {
        $request->validate(['pic' => 'required|url']);
        $profile = User::findOrFail(Auth::id());
        $profile->pp=$request->pic;
        $profile->save();
        return json_encode(array("pic"=>str_replace("https://","",$request->pic),"status"=>"ok"));
    }


    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'displayname' => 'required',
        ]);

        $profile = User::findOrFail(Auth::id());
        $profile->username=$request->username;
        $profile->displayname=$request->displayname;
        $profile->email=$request->email;
        $profile->save();
        return redirect()->back();
    }

}
