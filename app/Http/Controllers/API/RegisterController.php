<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Video;
use App\Models\UserQuery;
use App\Models\BankDetail;
use App\Models\PromoCode;
use App\Models\Subscription;
use App\Models\AdVideo;
use App\Models\LiveVideo;
use App\Models\WatchList;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;
use Symfony\Component\HttpFoundation\Response;
use Twilio\Rest\Client;
use Stripe;
   
class RegisterController extends BaseController
{
    /**
     * Register api
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'name' => 'required',
            'email' => 'required|email|unique:users',
            //'password' => 'required',
           // 'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $promo = PromoCode::first();
        $promocode = $promo->promo_code_name;
       // print_r($promocode);die;
        $email = $request->email;
        $cust = $this->createCustomer($email);
        $customer_id = $cust->id;
       // print_r($cust);die;
        $input = $request->all();
      //  $input['password'] = bcrypt($input['password']);
        $input['customer_id'] = $customer_id;
        $user = User::create($input);
        $otp = $this->getRandomString(4);
        $id = $user->id;
        $res = \App\Models\User::saveOTP($id,$otp);
        /*---------code to send email -----*/
       // $email = $request->email;
   
        $mailData = [
            'title' => 'Verification Email',
            'body' => 'Your OTP is :'.$otp.'And your promo code for subscription is :'.$promocode
        ];
  
        Mail::to($email)->send(new \App\Mail\EmailDemo($mailData));
        /*---------code to send email -----*/
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['id'] =  $user->id;
        $success['email'] =  $user->email;
        $success['otp'] =  $otp;
        $success['customer_id'] =  $user->customer_id;
   
        return $this->sendResponse($success, 'OTP has been sent to your email.');
    }
    
    /**
     * Function to generate OTP
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */ 
     private function getRandomString($length) {
       $characters = '0123456789';
       $string = '';

       for ($i = 0; $i < $length; $i++) {
         $string .= $characters[mt_rand(0, strlen($characters) - 1)];
     }

      return $string;
   }
   
    /**
     * Login api
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'email' => 'required|email',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $user = User::where('email', $request->email)->first();
       // print_r($user);die;
         if(!empty($user->email)){
           // print_r($user->id);die;
        if(Auth::loginUsingId($user->id)){
            $user = Auth::user();
            $id = $user->id;
            $otp = $this->getRandomString(4);
            $table = "users_otp";
            $otpdata = \App\Models\User::fetchOtpData($id,$table);
           // print_r($otpdata);die;
            if(!empty($otpdata)){
                $res = \App\Models\User::updateOTP($id,$otp); 
            }else{
               $res = \App\Models\User::saveOTP($id,$otp);    
            }
            
             /*---------code to send email -----*/
                $email = $request->email;
           
                $mailData = [
                    'title' => 'Verification Email',
                    'body' => 'Your OTP is :'.$otp
                ];
          
                Mail::to($email)->send(new \App\Mail\EmailDemo($mailData));
             /*---------code to send email -----*/
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['user_id'] =  $user->id;
            $success['email'] =  $user->email;
            $success['otp'] =  $otp;
            $success['customer_id'] =  $user->customer_id;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Something wrong']);
        }
      }else{
            $email = $request->email;
            $cust = $this->createCustomer($email);
            $customer_id = $cust->id;
            $input = $request->all();
          //  $input['password'] = bcrypt($input['password']);
            $input['customer_id'] = $customer_id;
            $user = User::create($input);
            $otp = $this->getRandomString(4);
            $id = $user->id;
            $res = \App\Models\User::saveOTP($id,$otp);
            /*---------code to send email -----*/
            $email = $request->email;
       
            $mailData = [
                'title' => 'Verification Email',
                'body' => 'Your OTP is :'.$otp
            ];
      
            Mail::to($email)->send(new \App\Mail\EmailDemo($mailData));
            /*---------code to send email -----*/
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['id'] =  $user->id;
            $success['email'] =  $user->email;
            $success['otp'] =  $otp;
            $success['customer_id'] =  $user->customer_id;
       
            return $this->sendResponse($success, 'OTP has been sent to your email.'); 
      }    
        
    }
    
    
    /**
     * OTP Verification
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $user= User::where("email",$request->email)->first();
       // print_r($user->email);die;
        if(!empty($user)){
            $id = $user->id;
            $email = $user->email;
            $name = $user->name;
            $phone_number = $user->phone_number;
            $profile_picture = $user->profile_picture;
            $table = "users_otp";
            $otpdata = \App\Models\User::fetchOtpData($id,$table);
            if($otpdata[0]->otp == $request->otp){
                 $success['user_id'] =  $id;
                 $success['email'] =  $email;
                 $success['name'] =  $name;
                 $success['country'] =  $user->country;
                 $success['state'] =  $user->state;
                 $success['city'] =  $user->city;
                 $success['phone_number'] =  $phone_number;
                 $success['profile_picture'] =  url('images/profile_picture').'/'.$profile_picture;
                return $this->sendResponse($success, 'Otp matched successfully.'); 
            }else{
              return $this->sendError('Unauthorised.', ['error'=>'Otp does not match.']);     
            }
        }else{
          return $this->sendError('Unauthorised.', ['error'=>'Email does not exist.']);  
        }    
    }
    
    
    /**
     * Function for sending sms to user phone using twilio
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */ 
    protected function sendSMS($data123) {
          // Your Account SID and Auth Token from twilio.com/console
            $sid = 'ACcb5a6b7df7e2502b24724ea0eb477f68';
            $token = '54bd2f3b5f41596114c7d7d3dcc8406b';
           // print_r($data123);die;
            $client = new \Twilio\Rest\Client($sid, $token);
             $message = $client->messages
                  ->create($data123['phone'], // to
                       [
                           "from" => "+12059536292",
                           "body" => $data123['text']
                       ]
                  );    

    }
    
     /**
     * function to add user phone number
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function addPhone(Request $request){
          $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            //'phone_number' => 'required|unique:users',
            'phone_number' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $details = User::where('id',$request->user_id)->first();
        if(!empty($details)){
           // print_r($details->phone_verified);die;
            if($details->phone_verified == "0"){
                $data = ['phone_number' => $request->phone_number];
               // print_r($data);die;
                $id = $request->user_id;
                $res = User::saveUserPhone($id,$data);
                $otp = $this->getRandomString(4);
               // print_r($otp);die;
                $data123 = ['phone' => '+'.$request->phone_number, 'text' => 'Your otp is :'.$otp];
                $message_sent = $this->sendSMS($data123);
                $table = "user_phone_otp";
                $otpdata = \App\Models\User::fetchOtpData($id,$table);
                  // print_r($otpdata);die;
                    if(!empty($otpdata[0])){
                        $res1 = \App\Models\User::updatePhoneOTP($id,$otp); 
                    }else{
                       $res1 = \App\Models\User::savePhoneOTP($id,$otp);    
                    }
                 $success['user_id'] =  $id;
                 $success['otp'] =  $otp;
                 return $this->sendResponse($success, 'OTP has been sent to your phone.'); 
            }else{
                 return $this->sendError('Unauthorised.', ['error'=>'Phone number already exist.']); 
            }
        }else{
             return $this->sendError('Unauthorised.', ['error'=>'User id does not exist.']); 
        }
        
     }
     
     /**
     * function to verify user phone number
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     
     public function verifyPhone(Request $request){
           $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'otp' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
         $user= User::where("phone_number",$request->phone_number)->first();
        if(!empty($user)){
            $id = $user->id;
            $phone_number = $user->phone_number;
            $email = $user->email;
            $name = $user->name;
            $profile_picture = $user->profile_picture;
            $table = "user_phone_otp";
            $otpdata = \App\Models\User::fetchOtpData($id,$table);
            if($otpdata[0]->otp == $request->otp){
                $verifyphone = \App\Models\User::verifyphone($id);
                 $success['user_id'] =  $id;
                 $success['phone_number'] =  $phone_number;
                 $success['email'] =  $email;
                 $success['name'] =  $name;
                 $success['profile_picture'] =  url('images/profile_picture').'/'.$profile_picture;
                return $this->sendResponse($success, 'Phone number verified successfully.'); 
            }else{
              return $this->sendError('Unauthorised.', ['error'=>'Otp does not match.']);     
            }
        }else{
          return $this->sendError('Unauthorised.', ['error'=>'Phone number does not exist.']);  
        } 
     }
     
     /**
     * function to upload video
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function uploadVideos(Request $request){
          $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            //'title' => 'required',
           // 'source' => 'mimetypes:video/avi,video/mpeg,video/mp4|required',
            'source' => 'required',
           // 'subtitle' => 'required',
           // 'thumb' => 'required',
           // 'category' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        if ($request->hasFile('source')) {
             $filenameWithExt = $request->file('source')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('source')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'.time().'.'.$extension;

            $video = $request->source;
           // $input = time().$video->getClientOriginalExtension();
            $destinationPath = base_path('videos');
            $video->move($destinationPath, $fileNameToStore);
        } else {
            $fileNameToStore = 'novideo.mp4';
        }
        if(!empty($request->thumb)){
         $destinationPath1 = base_path('images');
        $thumb = time().'.'.$request->thumb->getClientOriginalExtension();
       $request->thumb->move($destinationPath1, $thumb); 
        }else{
            $thumb = '';
        }

        // print_r($fileNameToStore);die;
        $data = array(
              'user_id' => $request->user_id,
            'title' => $request->title,
            'source' => $fileNameToStore,
            'subtitle' => $request->subtitle,
            'thumb' => $thumb,
            'category' => $request->category,
            );
            
         $res = User::saveVideoData($data); 
         $success['video_id'] = $res;
          return $this->sendResponse($success, 'Video uploaded successfully.'); 
     }
     
     /**
     * function to fetch subscription details by user id
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     
     public function mySubscription(Request $request){
            $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
         $id = $request->user_id;
        // $user= User::fetchUsersSubscription($id);
         $user= UserSubscription::where('user_id',$id)->orderBy('id','desc')->limit(1)->get();
        // print_r($user);die;
         if(!empty($user[0])){
             $now = time(); // or your date as well
            $your_date = strtotime($user[0]->subscription_date);
            $datediff = $now - $your_date;
            $totaldays = round($datediff / (60 * 60 * 24));
            $month = date('m');
            $year = date('Y');
            $daysinmonth = cal_days_in_month(CAL_GREGORIAN,$month,$year);
            $remaining_days = (int)$daysinmonth - (int)$totaldays;
        // print_r($remaining_days);die;     
        $success ['id'] = $user[0]->id;
        $success['user_id'] = $user[0]->user_id;
        $success['subscription_time'] = $user[0]->subscription_time;
        $success['subscription_date'] = $user[0]->subscription_date;
        $success['subscription_status'] = $user[0]->subscription_status;
        $success['subsctiption_amount'] = $user[0]->subscription_amount;
        $success['remaining_days'] = $remaining_days;
        $success ['subscription_type'] = $user[0]->subscription_type;
      
          return $this->sendResponse($success, 'User subscription data found.'); 
         }else{
            return $this->sendError('Unauthorised.', ['error'=>'No data found.']);   
         }      
     }
     
     
      /**
     * function to fetch live video
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function liveVideo(){
         $live= User::fetchLiveVideo(); 
        // print_r($live);die;
         if(!empty($live[0])){
             date_default_timezone_set("Asia/Kolkata");
            $time = date("H:i:s");
            $timestamp = strtotime($time) + 60*60;
            $time_after = date('H:i:s', $timestamp);
           // print_r($time); echo'<br>'; print_r($time_after);die;
            $date = date('Y-m-d');
           // print_r($date);die;
             foreach($live as $val){
                 $data = array();
                 // print_r($date);echo('<br>');print_r($val->schedule_date);die;
                 if($val->schedule_date = $date and $val->schedule_time <= $time and $val->duration > $time){
                    
                 $data = array(
                'id' => $val->id,
                //'user_id' => $val->user_id,
                'title' => $val->title,
                'source_ad' => url('videos').'/6.1.mp4',
                'source' => url('videos').'/'.$val->source,
                'subtitle' => $val->subtitle,
                'thumb' => url('images').'/'.$val->thumb,
                'category' => $val->category,
                'schedule_time' => $val->schedule_time,
                'schedule_date' => $val->schedule_date,
                'duration' => $val->duration,
                'video_type' => 'live'
                );
               
              } 
              // print_r($data);die; 
              //$res = $data;
             } 
            
             if(!empty($data)){
               $success = $data;
               return $this->sendResponse($success, 'Live video data found.'); 
             }else{
                // return $this->sendError('Unauthorised.', ['error'=>'No live video found.']); 
              $offset = "1"; 
              $limit = "1";
             $res = AdVideo::where('status','1')->get(); 
               foreach($res as $val){
                    $data = array(
                        'id' => $val->id,
                        //'user_id' => $val->user_id,
                        'title' => $val->title,
                        'source_ad' => url('videos').'/6.1.mp4',
                        'source' => url('videos').'/'.$val->source,
                        'subtitle' => $val->subtitle,
                        'thumb' => url('images').'/'.$val->thumb,
                        'category' => $val->category,
                        // 'schedule_time' => $val->schedule_time,
                        // 'schedule_date' => $val->schedule_date,
                        // 'duration' => $val->duration,
                        'video_type' => 'ad_video'
                        );
                 $date = date('Y-m-d');
                // $time = date('H:i:s');
                 $live = LiveVideo::where('schedule_date', $date)->where('schedule_time','>=', $time)->get(); 
                 $new_array = array_merge($data, ['livevideo_details' => $live]);
               }
                $success = $new_array;
               return $this->sendResponse($success, 'Live video data found.'); 
             // print_r($new_array);die; 
             }
         }else{
            return $this->sendError('Unauthorised.', ['error'=>'No data found.']);  
         }
     }
     
     /**
     * function to fetch video list
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function videoList(Request $request){
          $validator = Validator::make($request->all(), [
            'category' => 'required',
            'index' => 'required',
            'offset' => 'required',
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $cat = $request->category;
        $index = $request->index;   //this is offset being passed from front end
        $offset = $request->offset; //this is limit being passed from front end
       // print_r($cat);die;
       $list = Video::where('category', $cat)->where('admin_approved', "1")->offset($index)->limit($offset)->get();
      //  $list = User::fetchVideoList($cat,$index,$offset);
        $count = count($list);
       // print_r($list);die;
         if(!empty($list[0])){
             foreach($list as $live){
                 $new = array(
                'id' => $live->id,
                'user_id' => $live->user_id,
                'title' => $live->title,
                'source_ad' => url('videos').'/6.1.mp4',
                'source' => url('videos').'/'.$live->source,
                'subtitle' => $live->subtitle,
                'thumb' => url('images').'/'.$live->thumb,
                'category' => $live->category,
                'total video_count' => $count
             );
             
            $watchlistdetails = WatchList::where('video_id',$live->id)->where('user_id',$request->user_id)->first();
            if(!empty($watchlistdetails)){
                $is_watch_later = true;
            }else{
                 $is_watch_later = false;
            }
            
            $success[] = array_merge($new, array('is_watch_later' => $is_watch_later));
             }  
               return $this->sendResponse($success, 'Video list data found.'); 
         }else{
            return $this->sendError('Unauthorised.', ['error'=>'No data found.']);  
         }
     }
     
     /**
     * function to fetch category list
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function fetchMasterCategories(){
          $list = User::fetchCategoryList();
       // print_r($list);die;
         if(!empty($list[0])){
             foreach($list as $live){
                 $success[] = array(
                'id' => $live->id,
                'name' => $live->name,
                'banner_image' => url('images').'/'.$live->banner_image,
             );
             }    
               return $this->sendResponse($success, 'Category list data found.'); 
         }else{
            return $this->sendError('Unauthorised.', ['error'=>'No data found.']);  
         }
     }
     
     /**
     * function to edit user profile
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function editProfile(Request $request){
          $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name' => 'required',
           // 'paypal_id' => 'required',
           // 'country' => 'required',
           // 'state' => 'required',
           // 'city' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        if(!empty($request->profile_picture)){
         $destinationPath = base_path('images/profile_picture');
          $profile_picture = time().'.'.$request->profile_picture->getClientOriginalExtension();
         // print_r($profile_picture);die;
          $request->profile_picture->move($destinationPath, $profile_picture); 
        }else{
            $profile_picture = '';
        }
        
         $data = ['name' => $request->name, 'profile_picture' => $profile_picture, 'country' => $request->country, 'state' => $request->state, 'city' => $request->city, 'paypal_id' => $request->paypal_id];
         $id = $request->user_id;
         $res = User::saveUserPhone($id,$data);
         $success['user_id'] =  $id;
         return $this->sendResponse($success, 'Profile updated successfully.'); 
        
     }
     
     
     /**
     * function for processing payments
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function paymentProcess(Request $request){
        
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'subscription_id' => 'required',
            'currency' => 'required',
            //'amount' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $subscription_details = Subscription::where('id',$request->subscription_id)->first();
        $price = $subscription_details->price;
       // print_r($amount->price);die;
        $user = User::where('id', $request->user_id)->first();
        if(!empty($user->customer_id)){
            $customer_id = $user->customer_id;
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Customer id not available for user.']);
        }
       // print_r(base_path());die; 
        require_once(base_path('/vendor/stripe/stripe-php/init.php'));
        Stripe\Stripe::setApiKey('sk_test_51Hr4iOGRw0lHExl04VenL02NpmctQpxid9fcJ6LJzQpgdSo0ZNZk4VE0DwFndbaed8BYWPyguvmd8XCw0CCKnefH00aNCs2Nd3');
       
        $amount = $price;
	 	$amount *= 100;
        $amount = (int) $amount;
        $currency = $request->currency;
        $payment_intent = \Stripe\PaymentIntent::create([
			'customer' => $customer_id,
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => $currency,
			'description' => 'Payment From User',
			'payment_method_types' => ['card'],
			'setup_future_usage' => 'off_session',
		]);
		$intent = $payment_intent->client_secret;
		
		$success['client_secret'] =  $intent;
   
        return $this->sendResponse($success, 'Payment done successfully.');
    
    }
    
     /**
     * function for creating users on stripe payment gateway while registration
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     private function createCustomer($email){
        //   $validator = Validator::make($request->all(), [
        //     'description' => 'required',
        //     'email' => 'required',
        //   // 'payment_method' => 'required',
        // ]);
   
        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());       
        // }
       // print_r(base_path());die; 
        require_once(base_path('/vendor/stripe/stripe-php/init.php'));
        Stripe\Stripe::setApiKey('sk_test_51Hr4iOGRw0lHExl04VenL02NpmctQpxid9fcJ6LJzQpgdSo0ZNZk4VE0DwFndbaed8BYWPyguvmd8XCw0CCKnefH00aNCs2Nd3');
        
        $stripe = new \Stripe\StripeClient('sk_test_51Hr4iOGRw0lHExl04VenL02NpmctQpxid9fcJ6LJzQpgdSo0ZNZk4VE0DwFndbaed8BYWPyguvmd8XCw0CCKnefH00aNCs2Nd3');
        $customer = $stripe->customers->create([
            //'description' => $request->description,
            'email' => $email,
            //'payment_method' => $request->payment_method ,
        ]);
        //echo $customer;
        
        $success['customer'] =  $customer;
   
       // return $this->sendResponse($success, 'Customer created successfully.');
        return $customer;
     }
     
     /**
     * function for fetching customer id as per user id 
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function getCustomerID(Request $request){
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
        $res = User::where('id', $request->user_id)->first();
        if(!empty($res->customer_id)){
           $success['customer_id'] =  $res->customer_id;
   
          return $this->sendResponse($success, 'Customer id fetched successfully.'); 
        }else{
           return $this->sendError('Unauthorised.', ['error'=>'Customer id not found.']);   
        }
     }
     
     
     /**
     * function for fetching customer all payment method
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function paymentMethod(Request $request){
          $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            //'type' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }  
        
        $input = $request->all();
       // print_r($input);die;
       require_once(base_path('/vendor/stripe/stripe-php/init.php'));
       $stripe = new \Stripe\StripeClient('sk_test_51Hr4iOGRw0lHExl04VenL02NpmctQpxid9fcJ6LJzQpgdSo0ZNZk4VE0DwFndbaed8BYWPyguvmd8XCw0CCKnefH00aNCs2Nd3');
            $stripe->paymentMethods->all([
              'customer' => $request->customer_id,
              'type' => 'card',
            ]);
       // print_r($stripe);die;  
       $success = $stripe;
       return $this->sendResponse($success, 'Payment method fetched successfully.'); 
     }
     
      /**
     * function for fetching client secret key by customer id from stripe
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function fetchClientSecret(Request $request){
           $validator = Validator::make($request->all(), [
            'source_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
        require_once(base_path('/vendor/stripe/stripe-php/init.php'));
       $stripe = new \Stripe\StripeClient('sk_test_51Hr4iOGRw0lHExl04VenL02NpmctQpxid9fcJ6LJzQpgdSo0ZNZk4VE0DwFndbaed8BYWPyguvmd8XCw0CCKnefH00aNCs2Nd3');
       $stripe->sources->retrieve(
              $request->source_id,
              []
            );
       $success = $stripe;
       return $this->sendResponse($success, 'Client secret key fetched successfully.');
     }
     
     
     public function getPaymentMethods(Request $request){
         $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }  
        
        $key = 'sk_test_51Hr4iOGRw0lHExl04VenL02NpmctQpxid9fcJ6LJzQpgdSo0ZNZk4VE0DwFndbaed8BYWPyguvmd8XCw0CCKnefH00aNCs2Nd3';
        $customer = $request->customer_id;
        $type = 'card';
        $data = array(
              'customer' => $customer,
              'type' => $type
            );
        $postdata = http_build_query($data);    
        
        $curl = curl_init();
        $url = 'https://api.stripe.com/v1/payment_methods';
        $getUrl = $url."?".$postdata;
          curl_setopt_array($curl, array(
            CURLOPT_URL => $getUrl,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            // CURLOPT_POST => 1,
            // CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "Authorization: Bearer sk_test_51Hr4iOGRw0lHExl04VenL02NpmctQpxid9fcJ6LJzQpgdSo0ZNZk4VE0DwFndbaed8BYWPyguvmd8XCw0CCKnefH00aNCs2Nd3",
              "Cache-Control: no-cache",
            ),
          ));
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          curl_close($curl);
          
          if ($err) {
           // echo "cURL Error #:" . $err;
            return $this->sendError('Unauthorised.', ['error' => 'Payment method not found!!']);
          } else {
             // echo $response; 
            $success = json_decode($response);
            return $this->sendResponse($success, 'Payment method fetched successfully.');
          }
     }
     
     
    /**
     * function for fetching data for home screen
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function fetchHomeScreenData(){
         $categories = User::fetchCategoryList();
         foreach($categories as $val){
             if(!empty($val->banner_image)){
                 $banner_image = url('images').'/'.$val->banner_image;
             }else{
                 $banner_image = null;
             }
             $data = array(
                  'id' => $val->id,
                  'name' => $val->name,
                  'banner_image' => $banner_image,
                  'source_ad' => url('videos').'/6.1.mp4',
                 );
            $videos = Video::where('category', $val->name)->where('admin_approved','1')->get()->toArray();
            //print_r($videos);die;
            // foreach($videos as $value){
            //     $videoss = array(
            //             'id' => $value['id'],
            //             'user_id' => $value['user_id'],
            //             'title' => $value['title'],
            //             'source' => url('videos').'/'.$value['source'],
            //             'subtitle' => $value['subtitle'],
            //             'thumb' => url('images').'/'.$value['thumb'],
            //             'category' => $value['category'],
            //         );
            // }
            $new_array[] = array_merge($data, ['video_list' => $videos]);
         }//print_r($new_array);die;
         
         $success = $new_array;
         return $this->sendResponse($success, 'Home Screen data fetched successfully.');
   
     }
     
      /**
     * function for saving user query
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function captureUserQuery(Request $request){
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'query' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
        $input = $request->all();
        $res = UserQuery::create($input);
        $success['query_id'] = $res->id;
         return $this->sendResponse($success, 'User query captured successfully.');
     }
     
     /**
     * function for getting query details by user id
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function getUserQueryDetails(Request $request){
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
        $res = UserQuery::where('user_id',$request->user_id)->get()->toArray();
        if(!empty($res)){
            foreach($res as $val){
            $data[] = array(
                  'query' => $val['query'],
                  'response' => $val['response']
                );
            }
         $success = $data;
         return $this->sendResponse($success, 'User query found successfully.');  
        }else{
           return $this->sendError('Unauthorised.', ['error' => 'No query found!!']);  
        }
     }
     
     /**
     * function for getting master subscription plan details
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function fetchSubscriptionDetails(){
         $res = User::fetchSubscriptionDetails();
         $success = $res;
          return $this->sendResponse($success, 'Subscription plans found successfully.');
         
     }
     
     /**
     * function for verification of payment status from stripe payment gateway and update database
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function verifySubscription(Request $request){
          $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'subscription_id' => 'required',
            'payment_method_id' => 'required',
            'secret_client_id' => 'required',
            'status' => 'required',
            'payment_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }  
        if($request->status == "Succeeded"){
        $subscription = Subscription::where('id',$request->subscription_id)->first();
        if(empty($subscription)){
            return $this->sendError('Unauthorised.', ['error' => 'Subscription id not valid!!']); 
        }else{
            date_default_timezone_set('Asia/Kolkata');
            $data = array(
                  'user_id' => $request->user_id,
                  'subscription_time' => date("H:i:s"),
                  'subscription_date' => date('Y-m-d'),
                  'subscription_status' => $request->status,
                  'subscription_amount' => $subscription->price,
                  'subscription_type' => $subscription->plan,
                  'subscription_id' => $request->subscription_id,
                  'payment_method_id' => $request->payment_method_id,
                  'secret_client_id' => $request->secret_client_id,
                  'payment_id' => $request->payment_id,
                );
                
           // $subdetails = UserSubscription::where('user_id',$request->user_id)->first();    
            $res = UserSubscription::create($data);
            $success['id'] = $res->id;
            $success['user_id'] = $res->user_id;
            $success['subscription_time'] = $res->subscription_time;
            $success['subscription_date'] = $res->subscription_date;
            $success['subscription_status'] = $res->subscription_status;
            $success['subsctiption_amount'] = $res->subscription_amount;
            $success ['subscription_type'] = $res->subscription_type;
             return $this->sendResponse($success, 'Subscription plans alloted to user successfully.');
        }
       
     }else{
          date_default_timezone_set('Asia/Kolkata');
            $data = array(
                  'user_id' => $request->user_id,
                  'subscription_time' => date("H:i:s"),
                  'subscription_date' => date('Y-m-d'),
                  'subscription_status' => $request->status,
                  'subscription_amount' => $subscription->price,
                  'subscription_type' => $subscription->plan,
                  'subscription_id' => $request->subscription_id,
                  'payment_method_id' => $request->payment_method_id,
                  'secret_client_id' => $request->secret_client_id,
                  'payment_id' => $request->payment_id,
                );
                
           // $subdetails = UserSubscription::where('user_id',$request->user_id)->first();    
            $res = UserSubscription::create($data);
            $success['id'] = $res->id;
            $success['user_id'] = $res->user_id;
            $success['subscription_time'] = $res->subscription_time;
            $success['subscription_date'] = $res->subscription_date;
            $success['subscription_status'] = $res->subscription_status;
            $success['subsctiption_amount'] = $res->subscription_amount;
            $success ['subscription_type'] = $res->subscription_type;
        return $this->sendError('Unauthorised.', ['error' => 'Transaction not successfull!!']);  
     }
  }
  
  
      /**
     * function for search hint api
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     
     public function searchHint(Request $request){
         $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $search = $request->search;
        $list = Video::where('subtitle', 'like', '%' . $search . '%')->orWhere('title', 'like', '%' . $search . '%')->orderBy('id','desc')->limit(15)->get();
         if(!empty($list[0])){
             foreach($list as $live){
                 $data[] = array(
                'title' => $live->title,
                'subtitle' => $live->subtitle,
             );
             }  
               $titles = array_unique($data, SORT_REGULAR);
               $success = $titles;
               return $this->sendResponse($success, 'Video list data found.'); 
         }else{
            return $this->sendError('Unauthorised.', ['error'=>'No data found.']);  
         }
        
     }        
  
  
     /**
     * function for search result api
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     
     public function searchResult(Request $request){
         $validator = Validator::make($request->all(), [
            'search' => 'required',
            'index' => 'required',
            'offset' => 'required',
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
         $search = $request->search;
         $index = $request->index;   //this is offset being passed from front end
         $offset = $request->offset; //this is limit being passed from front end
       // print_r($cat);die;
         $list = Video::where('subtitle', 'like', '%' . $search . '%')->orWhere('title', 'like', '%' . $search . '%')->offset($index)->limit($offset)->get();
        //print_r($list);die;
           if(!empty($list[0])){
             foreach($list as $live){
                 $new = array(
                'id' => $live->id,
                'user_id' => $live->user_id,
                'title' => $live->title,
                'source_ad' => url('videos').'/6.1.mp4',
                'source' => url('videos').'/'.$live->source,
                'subtitle' => $live->subtitle,
                'thumb' => url('images').'/'.$live->thumb,
                'category' => $live->category
             );
              $watchlistdetails = WatchList::where('video_id',$live->id)->where('user_id',$request->user_id)->first();
            if(!empty($watchlistdetails)){
                $is_watch_later = true;
            }else{
                 $is_watch_later = false;
            }
            
            $success[] = array_merge($new, array('is_watch_later' => $is_watch_later));
             }  
               return $this->sendResponse($success, 'Video list data found.'); 
         }else{
            return $this->sendError('Unauthorised.', ['error'=>'No data found.']);  
         }
        
        
         
     }
     
     
     /**
     * function for save and edit/update user bank details
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function userBankDetails(Request $request){
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'account_number' => 'required',
            'account_holder_name' => 'required',
            'ifsc_code' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $res = BankDetail::where('user_id',$request->user_id)->first();
        if(empty($res)){
           // print_r('empty');die;
           $input = $request->all();
           $datas = BankDetail::create($input);
           
           $success['user_id'] = $datas->user_id;
               return $this->sendResponse($success, 'User bank details captured successfully.'); 
        }else{
        //print_r($res);die;
          $id = $request->user_id;
          $data = array(
                'account_number' => $request->account_number,
                'account_holder_name' => $request->account_holder_name,
                'ifsc_code' => $request->ifsc_code
              );
              
           $details = BankDetail::where('user_id', '=', $id)->update($data); 
            $success['user_id']  = $id;
               return $this->sendResponse($success, 'User bank details updated successfully.'); 
        }
     }
     
      /**
     * function for fetching user bank details
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function fetchUserAccount(Request $request){
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
        $details = BankDetail::where('user_id',$request->user_id)->first();
        if(empty($details)){
             return $this->sendError('Unauthorised.', ['error'=>'No data found.']);  
        }else{
          $success['user_id'] = $details->user_id;    
          $success['account_number'] = $details->account_number;    
          $success['account_holder_name'] = $details->account_holder_name;    
          $success['ifsc_code'] = $details->ifsc_code;  
           return $this->sendResponse($success, 'User bank details found successfully.'); 
            
        }
     }
     
     /**
     * function for fetching user bank details
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function userFcmToken(Request $request){
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'fcm_token' => 'required',
           // 'device_type' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }  
        
        $id = $request->user_id;
        $data = ['fcm_token' => $request->fcm_token, 'device_type' => $request->device_type];
        
        $details = User::where('id', '=', $id)->update($data); 
        $success['user_id']  = $id;
        return $this->sendResponse($success, 'User fcm token details updated successfully.'); 
     }
     
     /**
     * function for applying promo code discount while taking subscription
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function applyPromoCode(Request $request){
         $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'promo_code' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
       $promocode = $request->promo_code;
       $promodetails = PromoCode::where('promo_code_name',$promocode)->first();
       if(empty($promodetails)){
          // print_r("empty");die;
           return $this->sendError('Unauthorised.', ['error'=>'Promo code does not exist.']);  
       }else{
          // print_r($promodetails->discount);die; 
           $discount = $promodetails->discount;
           $subdetails = Subscription::all();
          // print_r($subdetails);die;
          foreach($subdetails as $val){
              $discounted_total = $val->price - ($val->price * ($discount/100)); 
              $data[] = array(
                   'id' => $val->id,
                   'name' => $val->name,
                   'plan' => $val->plan,
                   'price' => $discounted_total,
                   'currency' => $val->currency
                  );
          }
          
          $success  = $data;
        return $this->sendResponse($success, 'Subscription details after discount fetched successfully.'); 
       }
      
     }
     
     /**
     * function for sending push notification
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function pushNotification(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }  
        
          $url = 'https://fcm.googleapis.com/fcm/send';
        
         $api_key = 'AAAA0btHNQU:APA91bEWnWrZ9FfoqbfDzpipLjhqDvKtv0Nx3PTUc203-fPdJ42eKjy4W8h5lXDGtsi9E6OuSS7s2k3ejoJiuo7Gctd2rpqH1QlDsuwKpWvem9-YJlOJv_1AV79XYS7VYzuCNxpIvJ4F';
                        
           $tokendetails = User::where('id',$request->user_id)->first();
           if(empty($tokendetails)){
                return $this->sendError('Unauthorised.', ['error'=>'No fcm token found for this user id.']); 
           }else{
         
         $userfcm = $tokendetails->fcm_token;
        // print_r($userfcm);die;
            $fields = array(
                 'to' => $userfcm,
                 'data' => array(
                     "body" => $request->message,
                     "title"=> $request->title,
                     "content_available" => 1
                     )
                  );
        
            //header includes Content type and api key
            $headers = array(
                'Content-Type:application/json',
                'Authorization:key='.$api_key
            );
                        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
           // print_r($result);die;
            return $result; 
     }
     } 
     
     
      /**
     * function for sending push notification for ios
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function pushNotificationIOS(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
         $url = 'https://fcm.googleapis.com/fcm/send';
        
         $api_key = 'AAAA0btHNQU:APA91bEWnWrZ9FfoqbfDzpipLjhqDvKtv0Nx3PTUc203-fPdJ42eKjy4W8h5lXDGtsi9E6OuSS7s2k3ejoJiuo7Gctd2rpqH1QlDsuwKpWvem9-YJlOJv_1AV79XYS7VYzuCNxpIvJ4F';
                        
           $tokendetails = User::where('id',$request->user_id)->first();
           if(empty($tokendetails)){
                return $this->sendError('Unauthorised.', ['error'=>'No fcm token found for this user id.']); 
           }else{
         
            $userfcm = $tokendetails->fcm_token;
            $title = $request->title;
            $body = $request->message;
            $notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
            $arrayToSend = array('to' => $userfcm, 'notification' => $notification,'priority'=>'high');
            $json = json_encode($arrayToSend);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key='. $api_key;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            //Send the request
            $response = curl_exec($ch);
            //Close request
            if ($response === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
         
         
           }
        
        
     }    
     
      
      /**
     * function for sending video to user watch later list
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function watchList(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'video_id' => 'required',
            'value' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }  
        
        if($request->value == "add"){
            $check = WatchList::where('user_id',$request->user_id)->where('video_id',$request->video_id)->first();
            if(!empty($check)){
                return $this->sendError('Unauthorised.', ['error'=>'Video already in user watch list.']);  
            }else{
                $input = $request->all();
                $res = WatchList::create($input);
                $success['data'] =  $res;
                return $this->sendResponse($success, 'Video added to watch list successfully.'); 
                
            }
        
     }else{
        $res = WatchList::where('user_id', '=', $request->user_id)->where('video_id','=', $request->video_id)->delete();  
         $success['data'] =  $res;
         return $this->sendResponse($success, 'Video deleted from watch list successfully.'); 
     }
     
     } 
     
     
      
      /**
     * function for fetching user watch later video list
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function fetchWatchList(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
        $watchlater = WatchList::where('user_id',$request->user_id)->get();
        if(!empty($watchlater)){
            foreach($watchlater as $val){
                $videoid = $val->video_id;
                $videodata[] = Video::where('id',$videoid)->get()->toArray();
            }
            $arraySingle = call_user_func_array('array_merge', $videodata);
             foreach($arraySingle as $value){
                 $data[] = array(
                        'id' => $value['id'],
                        'user_id' => $value['user_id'],
                        'title' => $value['title'],
                        'source' => url('videos').'/'.$value['source'],
                        'subtitle' => $value['subtitle'],
                        'thumb' => url('images').'/'.$value['thumb'],
                        'category' => $value['category']
                     );
             }
            //print_r($data);die;
            $success =  $data;
   
          return $this->sendResponse($success, 'Watch list video fetched successfully.'); 
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'No data found.']);    
        }
        
        
     }   
     
     
      /**
     * function for fetching user uploaded video details
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function fetchUserUploadedVideoDetails(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
        $videos = Video::where('user_id',$request->user_id)->get()->toArray();
        $totalvideos = count($videos);
        $approvedvideos = Video::where('user_id',$request->user_id)->where('admin_approved','1')->get()->toArray();
        $totalapprovedvideos = count($approvedvideos);
        if(!empty($videos)){
        $success['totalvideos'] = $totalvideos;
        $success['totalapprovedvideos'] = $totalapprovedvideos;
        $success['earning'] = '0';
        
        return $this->sendResponse($success, 'User video details fetched successfully.'); 
        }else{
          return $this->sendError('Unauthorised.', ['error'=>'No data found for this user.']);     
        }
        
     }   
     
     
     
       /**
     * function for fetching user uploaded video list
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function fetchUserVideoDetails(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
         $videos = Video::where('user_id',$request->user_id)->get()->toArray();
          if(!empty($videos)){
              foreach($videos as $val){
                  $data = array(
                        'id'=> $val['id'],
                        'user_id'=> $val['user_id'],
                        'title'=> $val['title'],
                        'source'=> $val['source'],
                        'subtitle'=> $val['subtitle'],
                        'thumb'=> $val['thumb'],
                        'category'=> $val['category'],
                        'admin_approved'=> $val['admin_approved'],
                      );
                     
                $new[] = array_merge($data, array('earning' => '0'));      
              }
            $success = $new;
           
            
            return $this->sendResponse($success, 'User video details fetched successfully.'); 
            }else{
              return $this->sendError('Unauthorised.', ['error'=>'No data found for this user.']);     
            }
        
     }    

}