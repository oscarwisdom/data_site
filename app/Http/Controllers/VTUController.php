<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VTUController extends Controller
{
    // this is were we setup the vtpass api logic
    public function buy_airtime(Request $request) { 
        ######### we take in the request for the input button we are using from the form 💻 #########

        // this part is is were we set up the timezone to be africa/lagos so this just changes the timezone for entre script
        date_default_timezone_set('Africa/Lagos');

        // take a request to get the name of the input tag in blade file using this controller
        $amount = $request->input('amount');

        // we access the culome in the DB and work with it in a variable called $balance
        $balance = Auth::user()->balance;

        // this logic is purchase of the Airtime
        if ($balance >= $amount) { // if th balance is greater than or equal to amount

            // then the amount being requested from the user and substract the balance from the user table
            Auth::user()->decreament('balance', $amount);
            

            // this are the required field to fill which is in our form 
            $phone = $request->input('phone');
            $operator = $request->input('operator');
            // set the time to be current time being used in this system
            $datetime = now()->format('YmdHi');

            // store the datetime variable in the request_id variable then we make it generate random number between 10000 t0 99999
            $request_id = $datetime.rand(10000,99999);

            $apiUrl = 'https://sandbox.vtpass.com/api/pay';

            $data = array(
                "request_id" => $request_id,
                "serviceID" => $operator,
                "amount" => $amount,
                "phone" => $phone
            );

            //Set up some cURL config
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "api-key: 73e79f5061471d520ebcf391d3d4776a",
                "secret-key: SK_783da8798c6c37dd78f1f0f242fa258b1841c1e63b7",
                "Content-Type: application/json"
            ));
            // After executing the request
            $response = curl_exec($ch);
            $result = json_decode($response);


            if($result->content->transactions->status === "delivered"){

                return redirect('/home')->with('message', 'Airtime Purchased Successfully'); 
             }
             else{
                return redirect()->back()->with('message', 'Request No Processed'); 
             }

        }
        else {
            return redirect()->back()->with('message', 'Insufficient Balance');
        }
    }
}
