<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::attempt(["username" =>  $req->username, "password" => $req->password])){
            return redirect("/dashboard");
        } else {
            return redirect("/login")->with("error","Login Gagal");
        }
    }
    public function register()
    {
        return view("register");
    }
    public function postRegister(Request $req){
        if (Auth::attempt(["username" =>  $req->username, "password" => $req->password])){
            return redirect("/dashboard");
        } else {
            return redirect("/login")->with("error","Login Gagal");
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    
}
