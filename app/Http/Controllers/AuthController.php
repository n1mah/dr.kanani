<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view("register");
    }
    public function register_check(LoginRequest $request)
    {
        if (User::where("email",$request->email)->count()<1){
            $user = new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::login($user);
            return redirect()->route("dashboard")->with("success","Register Success");
        }else{
            return back()->with("error","ایمیل از قبل وجود دارد");
        }

    }
    public function login_check(LoginRequest $request)
    {
        $data=[
            "email"=> $request->email,
            "password"=>$request->password
        ];
        if (Auth::attempt($data)){
            return redirect()->route("dashboard")->with("success","Login Success");
        }
        return back()->with("error","ایمیل یا رمز عبور اشتباه می باشد");
    }

    public function login()
    {
        return view("login");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
