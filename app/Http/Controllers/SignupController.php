<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;

class SignupController extends Controller
{
    public function signup(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'lname'=>'required',
            'email'=>'required|email',
            'mobile_no'=>'required|integer|min:10',
            'adhaar_no'=>'required|integer|min:12',
            


        ]);

        $fname=$request->input('name');
        $lname=$request->input('lname');
        $email=$request->input('email');
        $password=Hash::make($request->input('password'));
        $gender=$request->input('gender');
        $religion=$request->input('religion');
        $hobbies=$request->input('hobbies');
        $hobbies_user=implode(",",$hobbies);
        $mobile_no=$request->input('mobile_no');
        $date_of_birth=$request->input('date_of_birth');
        $adhaar_no=$request->input('adhaar_no');

        $image=$request->file('image');
        $image_new_name=time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'),$image_new_name);
        


        $created_at= date("Y-m-d h:i:s");
        $updated_at= date("Y-m-d h:i:s");

        $insert_user=DB::insert("CALL registration(?,?,?,?,?,?,?,?,?,?,?,?,?)", array($fname,$lname,$email,$password,$gender,$religion,$hobbies_user,$mobile_no,$date_of_birth,$adhaar_no,$image_new_name,$created_at,$updated_at)); 

        return redirect(url('login'))->with('success','your signup complete login to continue');
        
    }
}
