<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class CarsController extends Controller
{
    public function cars(){
        if(Auth::check());
        $cars=DB::select("CALL cars_details()");
        
        return view('cars', compact('cars'));
    }
    
    
    public function ListCars(Request $request){

        $this->validate($request, [
            'car'=>'required',
            'model'=>'required',
            'milege'=>'required',
            'image'=>'required|mimes:jpg,jpeg,png,gif|max:2048',
            'pdf'=>"required|mimes:pdf|max:10000",
            

        ]);


        $car=$request->input('car');
        $model=$request->input('model');
        $milege=$request->input('milege');
        $price=$request->input('price');
        $color=$request->input('color');

        $image=$request->file('image');
        
        $image_new_name= time().'.'.$image->getClientOriginalExtension();

        $image->move(public_path('uploads'),$image_new_name);

        
        $pdf=$request->file('pdf');
        $pdf_new_name=time().'.'.$pdf->getClientOriginalExtension();
        $pdf->move(public_path('downloads'),$pdf_new_name);

        $created_at= date("Y-m-d h:i:s");
        $updated_at= date("Y-m-d h:i:s");

        $insert_car=DB::insert("CALL insert_cars(?,?,?,?,?,?,?,?,?)", array($car,$model,$milege,$price,$color,$image_new_name,$pdf_new_name,$created_at,$updated_at));
        return redirect(url('cars'))->with('success','Your Car Added Successfully');
    }

    public function EditCars($id){

        $edit_cars=DB::select("CALL edit_cars(?)", array($id));

        return view('edit_cars',compact('edit_cars')); 
    }

    public function UpdateCars( Request $request){
        $this->validate($request, [
            'car'=>'required',
            'model'=>'required',
            'price'=>'required',
            'color'=>'required',
        ]);

        $id=$request->input('id');
        $car=$request->input('car');
        $model=$request->input('model');
        $milege=$request->input('milege');
        $price=$request->input('price');
        $color=$request->input('color');
        $image=$request->file('image');
        $url=$request->input('url');
        if($image!=""){
            $image_new_name= time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'),$image_new_name);
        }else{
            $edit_cars=DB::select("CALL edit_cars(?)", array($id));
            $image_new_name=$edit_cars[0]->image;


            $pdf=$request->file('pdf');
            if($pdf!=""){
                $pdf_new_name=time().'.'.$pdf->getClientOriginalExtension();
                $pdf->move(public_path('downloads'),$pdf_new_name);
            }else{
                $edit_cars=DB::select("CALL edit_cars(?)", array($id));
                $pdf_new_name=$edit_cars[0]->pdf;
            }
            
        }

        $updated_at= date("Y-m-d h:i:s");

        $update_cars=DB::update("CALL update_cars(?,?,?,?,?,?,?,?,?,?)", array($id,$car,$model,$milege,$price,$color,$image_new_name,$url,$pdf_new_name,$updated_at));
        if($updated_at){
            return redirect(url('cars'))->with('success','Your Car is updated');
        }else{
            return redirect(url('cars'))->with('fail','Your Car is Not updated');
        }
    }

    public function DeleteCars($id){
        $delete_cars=DB::delete("CALL delete_cars(?)", array($id));
        if($delete_cars){
            return redirect(url('cars'))->with('success','Your Car Delete Successfully');
        }else{
            return redirect(url('cars'))->with('fail','Your Car Delete Unsuccessfully');
        }
    }

    
}
