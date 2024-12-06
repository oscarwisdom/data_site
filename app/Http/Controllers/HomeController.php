<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use App\Models\Payments;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable

     */
    public function index()
    {
        return view('front.home');
    }

    public function payment()
    {
        $settings = Settings::find(1);
        return view('front.payment', [
            'settings' => $settings
        ]);
    }

    public function make_payment(Request $request) {
        $status = $request->input('status');

        if ($status == "cancelled") {
            return redirect('home')->with('message', 'Payment Cancelled');
        }
        else if ($status == "successful") {
            $tx_id = $request->input("transaction_id");

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.flutterwave.com/v3/transactions/'.$tx_id.'/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer FLWSECK_TEST-41a99426c1734b81a4d2c4c366a3b372-X',
                'Content-Type: application/json'
            ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);

            $res = json_decode($response);

            if ($res->status == "success") {
                $amount_paid = $res->data->charged_amount;
                $tx_ref = $res->data->tx_ref;
                $name = $res->data->customer->name;
                $email = $res->data->customer->email;
                $phone = $res->data->customer->phone;
                $user_id = $res->data->meta->user_id;

                $payments = new Payments;

                $payments->tx_ref = $tx_ref;
                $payments->name = $name;
                $payments->email = $email;
                $payments->phone = $phone;
                $payments->user_id = $user_id;
                $payments->amount_paid = $amount_paid;

                return redirect('home')->with('message', 'Payment Successfull');
            } 
            else {
                return redirect('home')->with('message', 'Payment Not Processed');
            }

        }

    }

    public function services()
    {
        return view('front.services');
    }

    public function transactions()
    {
        return view('front.transactions');
    }

    public function help()
    {
        return view('front.help');
    }

    public function settings()
    {
        return view('front.settings');
    }


    // services section

    public function nin(){
        return view('front.nin');
    }

    public function tin(){
        return view('front.tin');
    }

    public function mobile_data(){
        return view('front.mobiledata');
    }

    public function sme(){
        return view('front.sme');
    }

    public function electricity(){
        return view('front.electricity');
    }
    public function bills(){
        return view('front.bills');
    }
}
