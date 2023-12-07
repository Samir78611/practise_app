<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Illuminate\Http\Request;
use Str;
use Twilio\Rest\Client;
use Validator;

class ApiController extends Controller
{
    public function Welcome()
    {
        $data = array();

        $final_data = "Welcome";
        //standard format
        $data['status'] = 200;
        $data['message'] = "success";
        $data['data'] = $final_data;

        return response()->json($data);
    }

    public function UsersList()
    {
        $data = array();

        $users_data = DB::select("CALL get_all_users_data");

        $final_user_data = array();
        foreach ($users_data as $user) {
            $user_details = array();
            $user_details['id'] = $user->id;
            $user_details['fName'] = $user->name;
            $user_details['lName'] = $user->lname;

            $hobbies = explode(",", $user->hobbies);
            $user_details['hobbies'] = $hobbies;
            $user_details['mobileNo'] = $user->mobile_no;

            $final_user_data[] = $user_details;
        }
        $final_data = $final_user_data;

        $data['status'] = 200;
        $data['message'] = "success";
        $data['data'] = $final_data;

        return response()->json($data);
    }

    public function CarsCollection()
    {
        $data = array();

        $cars = DB::select("CALL cars_details()");
        $final_cars_data = array();
        foreach ($cars as $car) {
            $car_details = array();
            $car_details['id'] = $car->id;
            $car_details['car_name'] = $car->car;
            $car_details['model'] = $car->model;
            $car_details['image_url'] = $car->image_url;
            $final_car_data[] = $car_details;
        }
        $final_data = $final_car_data;

        //send sms
        $country_code = 91;
        $mobile_no = 9325706639;
        $message = "someone has checking your cars collection ";
        $send_sms = $this->SendSMS($country_code, $mobile_no, $message);

        //send sms end

        $data['message'] = 200;
        $data['status'] = "success";
        $data['data'] = $final_data;

        return response()->json($data);
    }
    public function Signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lname' => 'required',
            'email' => 'required', //unique condition is an show that your email is already used|
            'mobile_no' => 'required|integer|min:10',
            'adhaar_no' => 'required|integer|min:12',
        ]);
        if ($validator->fails()) {
            $errors = "";
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                //go through each messages for this field
                foreach ($messages as $message) {
                    $errors .= $message;
                    $data['message'] = $errors;

                }
            }
            $data['status'] = 400;
            $data['data'] = (object) [];
        } else {
            //main logic
            $fname = $request->input('name');
            $lname = $request->input('lname');
            $email = $request->input('email');
            $password = Hash::make($request->input('password'));
            $gender = $request->input('gender');
            $religion = $request->input('religion');
            $hobbies = $request->input('hobbies');
            $hobbies_user = $hobbies;
            $mobile_no = $request->input('mobile_no');
            $date_of_birth = $request->input('date_of_birth');
            $adhaar_no = $request->input('adhaar_no');
            $country_code = $request->input('country_code');

            $created_at = date("Y-m-d h:i:s");
            $updated_at = date("Y-m-d h:i:s");

            $insert_user = DB::insert("CALL registration(?,?,?,?,?,?,?,?,?,?,?,?,?)", array($fname, $lname, $email, $password, $gender, $religion, $hobbies_user, $mobile_no, $date_of_birth, $adhaar_no, $country_code, $created_at, $updated_at));
            if ($insert_user) {

                //send sms/email
                $reciverEmail = $email;
                $reciverName = $fname;
                $subject = "Hiii";
                $body = "<h4 style=color:green>Welcome to our new page</h4>" .$email;
                
                $send_email = $this->SendEmail($reciverEmail, $reciverName, $subject, $body);

                //send sms/email

                $data['status'] = 200;
                $data['message'] = "signup successful";
                $data['data'] = "";
            } else {
                $data['status'] = 400;
                $data['message'] = "signup unsuccessfully";
                $data['data'] = "";
            }
        }

        return response()->json($data);
    }
    public function Otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "countryCode" => "required",
            "mobileNo" => "required",
        ]);

        if ($validator->fails()) {
            $errors = "";
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                //go through each message fot this field
                foreach ($messages as $message) {
                    $errors .= $message;
                    $data['message'] = $errors;
                }
            }
            $data['status'] = 400;
            $data['data'] = (object) [];
        } else {

            $countryCode = $request->input('countryCode');
            $mobileNo = $request->input('mobileNo');
            $otp = rand(100000, 999999); //for 6 digit otp
            $otp_token = Str::random(15);

            try {
                // third party api start
                $sid = env('TWILIO_SID');
                $token = env('TWILIO_AUTH_TOKEN');
                $twilio = new Client($sid, $token);

                $message = $twilio->messages
                    ->create("+" . $countryCode . $mobileNo, // to
                        array(
                            "from" => "+15014833433",
                            "body" => "Hiii sam gym your otp is" . $otp,
                        )
                    );
                // third party api end
            } catch (\Exception $e) {

            }

            $created_at = date("Y-m-d h:i:s");
            $updated_at = date("Y-m-d h:i:s");

            $store_otp = DB::insert("CALL store_otp(?,?,?,?)", array($otp, $otp_token, $created_at, $updated_at));
            if ($store_otp) {
                $final_data = array();
                // $final_data['otp'] = $otp;
                $final_data['otpToken'] = $otp_token;

                $data['status'] = 200;
                $data['message'] = "OTP sent successfully";
                $data['data'] = $final_data;
            } else {
                $data['status'] = 200;
                $data['message'] = " OTP Failed ";
                $data['data'] = [];
            }
        }
        return response()->json($data);
    }

    public function VerifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "otp" => "required",
            "otp_token" => "required",
        ]);

        if ($validator->fails()) {
            $errors = "";
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                //go through each message fot this field
                foreach ($messages as $message) {
                    $errors .= $message;
                    $data['message'] = $errors;
                }
            }
            $data['status'] = 400;
            $data['data'] = (object) [];

        } else {
            $otp = $request->input('otp');
            $otp_token = $request->input('otp_token');

            $created_at = date("Y-m-d h:i:s");
            $updated_at = date("Y-m-d h:i:s");

            $verify_otp = DB::select("CALL verify_otp(?,?)", array($otp, $otp_token));
            if (count($verify_otp) > 0) {

                $update_verified_otp = DB::update("CALL update_verified_otp(?,?,?)", array($otp, $otp_token, $updated_at));
                if ($update_verified_otp) {

                    $data['status'] = 200;
                    $data['messages'] = "OTP successfully verified";
                    $data['data'] = (object) [];
                } else {
                    $data['status'] = 400;
                    $data['messages'] = "OTP already used";
                    $data['data'] = (object) [];
                }
            } else {
                $data['status'] = 400;
                $data['messages'] = "OTP invalied";
                $data['data'] = (object) [];
            }
        }
        return response()->json($data);
    }
    public function SendSMS($countryCode, $mobileNo, $message)
    {
        // third party api start

        $sid = "ACf891900f5401085e30a7572b305fa59c";
        $token = "b4721071ca707433739eb6b169290f52";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create("+" . $countryCode . $mobileNo, // to
                array(
                    "from" => "+15014833433",
                    "body" => $message,
                )
            );
        // third party api end
    }

    public function SendEmail($reciverEmail, $reciverName, $subject, $body)
{
    $curl = curl_init();

    // Construct the payload as an associative array
    $data = [
        "sender" => [
            "name" => env('BREVO_EMAIL_NAME'),
            "email" => env('BREVO_EMAIL_SENDER'),
        ],
        "to" => [
            [
                "email" => $reciverEmail,
                "name" => $reciverName,
            ]
        ],
        "subject" => $subject,  // Use the parameter instead of hardcoded value
        "htmlContent" => $body, // Use the parameter instead of hardcoded value
    ];

    // Convert the array to a JSON string
    $jsonData = json_encode($data);

    // Set the cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.brevo.com/v3/smtp/email',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => array(
            'accept: application/json',
            'api-key: ' . env('BREVO_EMAIL_APIKEY'),
            'content-type: application/json',
            'Cookie: __cf_bm=LJZi4.rQhrJ8BqbOfOE2Gg.cGoyQFUv8PemxHPQUZ94-1701921296-0-AewKvBE3buHmY1Anp593KmncH8u4k6fIv4UTpWe2sjm1QrWQZEWfCzAupRpFqI6MSdv6JNtRR1VKQEuHBmvxi1k='
        ),
    ));

    // Execute the cURL request
    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl))

    // Close the cURL session
    curl_close($curl);

    // Output the response
    dd($response);
}

}