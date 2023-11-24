<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
