<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class DashboardController extends Controller
{
    public function Dashboard()
    {
        if(Auth::check()){
            $user=Auth::user();
            $fname=$user->name;
            $lname=$user->lname;
            $image=$user->image;

        $users_data=DB::select("CALL get_all_users_data");

            return view('dashboard',compact('fname','lname','image','users_data'));
        }else{
            return redirect(url('login'))->with('fail','You need to login Firstly discover/access to dashboard');
        }
    }
    public function DeleteUser($id){
        $delete_user=DB::delete("CALL delete_user(?)", array($id));

        if($delete_user){
            return redirect(url('dashboard'))->with('success','Your account has been deleted');
        }else{
            return redirect(url('dashboard'))->with('fail','Your account has not been deleted');
        }
    }
    public function EditUser($id){
        //dd('hiiiii');
        $user_data=DB::select("CALL user_data_by_id(?)", array($id));
        return view('edit_user',compact('user_data'));
    }
    public function Update(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'lname'=>'required',
            'email'=>'required|email',
            'mobile_no'=>'required|integer|min:10',
            'adhaar_no'=>'required|integer|min:12',
            


        ]);

        $id=$request->input('id');
        $fname=$request->input('name');
        $lname=$request->input('lname');
        $email=$request->input('email');
        $gender=$request->input('gender');
        $religion=$request->input('religion');
        $hobbies=$request->input('hobbies');
        $hobbies_user=implode(",",$hobbies);
        $mobile_no=$request->input('mobile_no');
        $date_of_birth=$request->input('date_of_birth');
        $adhaar_no=$request->input('adhaar_no');

        $image=$request->file('image');
        if($image!=""){
            $image_new_name=time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'),$image_new_name);
        }else{
            $user_data=DB::select("CALL user_data_by_id(?)", array($id));
            $image_new_name=$user_data[0]->image;
        }
        

        $updated_at= date("Y-m-d h:i:s");

        $update_user=DB::update("CALL update_user(?,?,?,?,?,?,?,?,?,?,?,?)", array($id,$fname,$lname,$email,$gender,$religion,$hobbies_user,$mobile_no,$date_of_birth,$adhaar_no,$image_new_name,$updated_at)); 

        if($update_user){
            return redirect(url('dashboard'))->with('success','Your Account has been Updated');
        }else{
            return redirect(url('dashboard'))->with('fail','Your Account has been Updated');
        }
        
    }
    public function Logout_user(){
        if(Auth::check()){
            $user=Auth::logout();
            return redirect(url('login'))->with('success','Logout Successfully');
        }else{
            return redirect(url('login'))->with('fail','Logout Successfully');
        }
    }

}
