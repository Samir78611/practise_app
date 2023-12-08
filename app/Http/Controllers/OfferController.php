<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Auth;
use DB;

class OfferController extends Controller
{
    public function OfferUser()
    {
        if (Auth::check()) {
            return view('offer');
        }

    }
    public function Offers(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $title = $request->input('title');
        $description = $request->input('description');

        $users_data = DB::select("CALL get_all_users_data");
        foreach ($users_data as $user) {
            $user_email=$user->email;
            $user_name=$user->name;

            $reciverEmail = $user_email;
            $reciverName = $user_name;
            $subject = $title;
            $body = $description;
            $send_offer = (new ApiController())->SendEmail($reciverEmail, $reciverName, $subject, $body);
        }
        return redirect(url('dashboard'))->with('success','Your offer data successfully sent ');
    }
}
