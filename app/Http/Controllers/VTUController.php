<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VTUController extends Controller
{
    public function buy_airtime(Request $request) {

        date_default_timezone_set('Africa/Lagos');

        $amount = $request->input('amount');

        $balance = Auth::user()->balance;

        if ($balance >= $amount) {

            Auth::user()->decrement('balance', $amount);

            $phone = $request->input('phone');
            $operator = $request->input('operator');
            $datetime = now()->format('YmdHi');

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
            return redirect()->back()->with('message', 'Insufficient balance');
        }
    }
}
