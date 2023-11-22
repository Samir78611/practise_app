<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

class GoogleController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
        
            $user = Socialite::driver('google')->user();
        //  /database 
            $finduser = User::where('google_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect()->intended('dashboard');
         
            }else{
                $google_id=$user->id;
                $name=$user->name;
                $email=$user->email;
                $password=encrypt('123456dummy');
                $image=$user->avatar;
                $created_at= date("Y-m-d h:i:s");
                
                
                $insert_user=DB::insert("CALL google(?,?,?,?,?,?)", array($google_id,$name,$email,$password,$image,$created_at));
                if($insert_user){
                    $finduser = User::where('google_id', $user->id)->first();

                    Auth::login($finduser);
        
                return redirect()->intended('dashboard');
                }else{
                    return redirect(url('login'))->with('fail','You login failed');
                }
         

            }
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
