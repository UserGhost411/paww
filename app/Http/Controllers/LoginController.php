<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct(){
        return $this->middleware(["guest"])->except("logout");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("login");
    }

    public function postLogin(Request $req){
        if (Auth::attempt(["username" =>  $req->username, "password" => $req->password],$req->remember)){
            if(Auth::user()->level==0){
                Auth::logout();
                return redirect("/login")->with("error","Login Gagal");
            }
            return redirect("/dashboard");
        } else {
            return redirect("/login")->with("error","Login Gagal");
        }
    }
    public function forget(){
        return view("forget");
    }
    public function postForget(){
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
    }
    public function register(){
        return view("register");
    }
    public function postRegister(Request $req){

        $req->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'repassword' => 'required',
        ]);
      
        if( $req->password == $req->repassword){
            $newuser = new User;
            $newuser->username = $req->username;
            $newuser->displayname = $req->username;
            $newuser->email = $req->email;
            $newuser->password = Hash::make($req->password);
            $newuser->level = 1;
            $newuser->save();
            return redirect("/login")->with("error","Silakan Login Ulang");;
        }
        return redirect()->back();
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    
}
