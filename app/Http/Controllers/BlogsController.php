<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class BlogsController extends Controller
{
    public function Index(){
        if(Auth::check());

        $get_blogs=DB::select("CALL get_blogs()");
        return view('blogs',compact('get_blogs'));
    }

    public function CreateBlog(Request $request){
        $this->validate($request ,[
            'title'=>'required',
            'description'=>'required',
            'image'=>'required',
        ]);

        $title=$request->input('title');
        $description=$request->input('description');
//image
        $image=$request->file('image');
        $image_new_name=time().'.'.$image-> getClientOriginalExtension();
        $image->move(public_path('uploads'),$image_new_name);
//pdf
        $pdf=$request->file('pdf');
        $pdf_new_blog=time().'.'.$pdf->getClientOriginalExtension();
        $pdf->move(public_path('pdf_blogs'),$pdf_new_blog);
        
        $created_at= date("Y-m-d h:i:s");
        $updated_at= date("Y-m-d h:i:s");


        $insert_blogs=DB::insert("CALL insert_blogs(?,?,?,?,?,?)", array($title,$description,$image_new_name, $pdf_new_blog,$created_at,$updated_at));
        if($insert_blogs){
            return redirect(url('blogs'))->with('success','Blog Successfully Created');
        }else{
            return redirect(url('blogs'))->with('fail','Blog Successfully Not Created');
        }
    }
    public function EditBlog($id){
        $edit_blog=DB::select("CALL edit_blogs(?)", array($id));
        return view('edit_blogs',compact('edit_blog'));
    }

    public function UpdateBlog(Request $request){
        $this->validate($request ,[
        'title'=>'required',
        'description'=>'required',
        ]);

        $id=$request->input('id');
        $title=$request->input('title');
        $description=$request->input('description');

        $image=$request->file('image');
        if($image!=""){
            $image_new_name=time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'),$image_new_name);
        }else{
            $edit_blog=DB::select("CALL edit_blogs(?)", array($id));
            $image_new_name=$edit_blog[0]->image;
        }


        $pdf=$request->file('pdf');
        if($pdf){
            $pdf_new_blog=time().'.'.$pdf->getClientOriginalExtension();
            $pdf->move(public_path('pdf_blogs'),$pdf_new_blog);
        }else{
            $edit_blog=DB::select("CALL edit_blogs(?)", array($id));
            $pdf_new_blog=$edit_blog[0]->pdf_blogs;
        }
        


        $updated_at= date("Y-m-d h:i:s");

        $update_blog=DB::update("CALL update_blogs(?,?,?,?,?)", array($id,$title,$description,$image_new_name,$updated_at));
        if($update_blog){
            return redirect(url('blogs'))->with('success','You Have Successfully Update Blog');
        }else{
            return redirect(url('blogs'))->with('fail','You Have Unsuccessfully Update Blog');
        }
    }

    public function DeleteBlog($id){
        $delete_blogs=DB::delete("CALL delete_blog(?)", array($id));
        if($delete_blogs){
            return redirect(url('blogs'))->with('success','Blog is Deleted');
        }else{
            return redirect(url('blogs'))->with('fail','Blog is not Deleted');
        }
    }
}
