<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    public function Welcome(){
        $data=array();

        $final_data="Welcome";
        //standard format
        $data['status']=200;
        $data['message']="success";
        $data['data']=$final_data;

        return response()->json($data);
    } 

    public function UsersList(){
        $data=array();

        $users_data=DB::select("CALL get_all_users_data");


        $final_user_data=array();
        foreach($users_data as $user)
        {
            $user_details=array();
            $user_details['id']=$user->id;
            $user_details['fName']=$user->name;
            $user_details['lName']=$user->lname;

            $hobbies=explode(",",$user->hobbies);
            $user_details['hobbies']=$hobbies;
            $user_details['mobileNo']=$user->mobile_no;
            
            $final_user_data[]=$user_details;
        }
        $final_data=$final_user_data;


        $data['status']=200;
        $data['message']="success";
        $data['data']=$final_data;

        return response()->json($data);
    }
}
