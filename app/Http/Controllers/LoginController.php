<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
use Auth;


class LoginController extends Controller
{
    public function login_user(Request $request)
    {
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required',

        ]);

        $email=$request->input('email');
        $password=$request->input('password');

        $credentials=$request->only('email','password');
        
        if(Auth::attempt($credentials)){
            return redirect(url('dashboard'))->with('success','You login successfully');
        }else{
            return redirect(url('login'))->with('fail','You login failed');
        }
    }

}
