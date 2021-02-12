<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Crypt;
use Validator;
use App\Providers\RouteServiceProvider;
use Srmklive\PayPal\Services\ExpressCheckout;


class PayPalController extends Controller
{


    /**
     * Responds with a welcome message with instructions
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
    public function payment(Request $request)
    {
        $data = [];
        $data['items'] = [
            [
                'name' => 'Mass TV',
                'price' => $request->amount,
                'desc'  => 'Payment from Mass TV',
                'qty' => 1
            ]
        ];
      
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $request->amount;
        print_r($data);die;
        $provider = new ExpressCheckout;
  
        $response = $provider->setExpressCheckout($data);
        //print_r($response);die;
        $response = $provider->setExpressCheckout($data, true);
        
        return redirect($response['paypal_link']);
    }
   
    /**
     * Responds with a welcome message with instructions
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
    	//print_r("hi");die;
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
    	//print_r("hello");die;
    	$provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Your payment was successfully. You can create success page here.');
        }
  
        dd('Something is wrong.');
    }
}
