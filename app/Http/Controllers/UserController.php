<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Session;
use Crypt;
use Validator;
use App\Models\Video;
use App\Models\User;
use App\Models\Category;
use App\Models\LiveVideo;
use App\Models\AdVideo;
use App\Models\UserQuery;
use App\Models\PromoCode;
use App\Models\Subscription;
use App\Models\Contact;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Twilio\Rest\Client;
use Stripe;

class UserController extends Controller
{
    
    /**
     * function for loading login page
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('login');
    }
    
     /**
     * function for loading admin dashboard 
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
    public function dashBoard(){
        return view('dashboard');
    }
    
    /**
     * function for login 
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
       // dd($request);die;
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $userdata = \DB::table('admins')->select('*')->where('email', $request->email)->where('status', 1)->first();
       // print_r($userdata->email);die;
        if(!empty($userdata->email)){
       if($userdata->password == $request->password){
          // print_r("login done");die;
           
            $request->session()->put('email',$userdata->email);
			$request->session()->put('admin_id',$userdata->id);
		
		//	return redirect('dashBoard');
			return redirect()->route('dashboard');
       }else{
          // print_r("wrong");die;
           return back()->with('error','wrong credentials!');
       }
        }else{
           return back()->with('error','email does not exist!'); 
        }
    }
    
    /**
     * function for loading category data
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function category(){
         $category = Category::latest()->paginate(10);
         return view('category',compact('category'))->with('i', (request()->input('page', 1) - 1) * 10);
        
     }
     
      /**
     * function for loading add category page
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function addCategory(){
         return view('addcategory');
     }
     
     /**
     * function for saving new category
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function saveCategory(Request $request){
         if(!empty($request->name)){
             if(!empty($request->banner_image)){
                     $destinationPath = base_path('images');
                      $profile_picture = time().'.'.$request->banner_image->getClientOriginalExtension();
                    //  print_r($profile_picture);die;
                      $request->banner_image->move($destinationPath, $profile_picture); 
                      $data = array(
                            'name' => $request->name,
                            'banner_image' => $profile_picture
                            );
                   // print_r($data);die;
                 $res = Category::create($data);
                 return back()->with('success','Category added successfully');
                 
             }else{
                 return back()->with('error','Banner image is mandatory');
             }
             
         }else{
            return back()->with('error','Banner name is mandatory!'); 
         }
        
     }
     
     
     /**
     * function for making category active
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function activeCat(Request $request,$id){
        // dd($id);die;
         $data = ['status' => 1];
         $res = Category::where('id','=',$id)->update($data);
         return redirect()->route('category')->withSuccess('Category status updated successfully!');
        
     }
     
     /**
     * function for making category deactive
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function deactiveCat(Request $request,$id){
         $data = ['status' => 0];
         $res = Category::where('id','=',$id)->update($data);
         return redirect()->route('category')->withSuccess('Category status updated successfully!'); 
     }
     
     /**
     * function for load details for edit category
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function editCat(Request $request,$id){
         $data = Category::where('id',$id)->first();
        // print_r($data);die;
          return view('editcategory', ["category"=>$data]);
     }
     
      /**
     * function for update category details
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function updateCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'banner_image' => 'required',
        ]);
   
        if($validator->fails()){
             return back()->with('error','All fields are mandatory!');       
        }
        $id = $request->id;
       // print_r($id);die;
       if(!empty($request->banner_image)){
             $destinationPath = base_path('images');
              $profile_picture = time().'.'.$request->banner_image->getClientOriginalExtension();
            //  print_r($profile_picture);die;
              $request->banner_image->move($destinationPath, $profile_picture); 
       }else{
           $profile_picture = '';
       } 
       $data = ['name' => $request->name, 'banner_image' => $profile_picture];
       $res = Category::where('id','=',$id)->update($data);
        return redirect()->route('category')->withSuccess('Category updated successfully!'); 
         
     }
     
      /**
     * function for loading user's uploaded video details page
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function usersVideo(){
         $videos = Video::where('uploaded_by',1)->join('users', 'videos.user_id', '=', 'users.id')->select('users.name', 'videos.*')->latest()->paginate(10);
        // dd($videos);die;
       // return view('usersvideo',compact('videos'));
         return view('usersvideo',compact('videos'))->with('i', (request()->input('page', 1) - 1) * 10);
     }
     
     
      /**
     * function for admin to approve user's uploaded video
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function approveVideo(Request $request,$id){
        $data = ['admin_approved' => 1];
         $res = Video::where('id','=',$id)->update($data);
        $videodata = Video::where('id','=',$id)->first();
        $user_id = $videodata->user_id;
        $res = $this->pushNotification($user_id);
       // print_r($videodata->user_id);die;
        
         return redirect()->route('usersvideo')->withSuccess('Video approved successfully!');  
     }
     
     /**
     * function for sending push notification
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     private function pushNotification($user_id){
        
          $url = 'https://fcm.googleapis.com/fcm/send';
        
         $api_key = 'AAAA0btHNQU:APA91bEWnWrZ9FfoqbfDzpipLjhqDvKtv0Nx3PTUc203-fPdJ42eKjy4W8h5lXDGtsi9E6OuSS7s2k3ejoJiuo7Gctd2rpqH1QlDsuwKpWvem9-YJlOJv_1AV79XYS7VYzuCNxpIvJ4F';
                        
           $tokendetails = User::where('id',$user_id)->first();
           if(empty($tokendetails)){
                return back()->with('error','No fcm token found for this user id'); 
           }else{
         
         $userfcm = $tokendetails->fcm_token;
        // print_r($userfcm);die;
            $fields = array(
                 'to' => $userfcm,
                 'data' => array(
                     "body" => "Your video is approved by the admin.",
                     "title"=> "Video Approved",
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
     * function for loading admin uploaded video details page
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function adminVideo(){
          $videos = Video::where('uploaded_by',2)->latest()->paginate(10);
         return view('adminvideo',compact('videos'))->with('i', (request()->input('page', 1) - 1) * 10);
     }
     
     
       /**
     * function for loading website uploaded video details page
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function webVideo(){
          $videos = Video::where('uploaded_by',3)->latest()->paginate(10);
         return view('webvideo',compact('videos'))->with('i', (request()->input('page', 1) - 1) * 10);
     }
     
     
     /**
     * function for loading admin upload video form
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function adminUploadVideo(){
         $cat = Category::all();
         return View('adminuploadvideo',compact('cat'));
     }
     
     
     /**
     * function for loading admin upload video form
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function uploadVideo(Request $request){
         $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category' => 'required',
            'thumb' => 'required',
            'source' => 'required',
            'subtitle' => 'required',
        ]);
   
        if($validator->fails()){
             return back()->with('error','All fields are mandatory!');       
        } 
        
        if(!empty($request->thumb)){
             $destinationPath = base_path('images');
              $thumb = time().'.'.$request->thumb->getClientOriginalExtension();
            //  print_r($thumb);die;
              $request->thumb->move($destinationPath, $thumb); 
       }else{
           $thumb = '';
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
        
        $data = array(
              'user_id' => '0',
              'title' => $request->title,
              'category' => $request->category,
              'thumb' => $thumb,
              'source' => $fileNameToStore,
              'subtitle' => $request->subtitle,
              'uploaded_by' => '2',
              'admin_approved' => '1'
            );
            
        $res = Video::create($data);
        return redirect()->route('adminvideo')->withSuccess('Video uploaded successfully!');
        
        
     }
     
     /**
     * function for loading admin upload video edit form
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function editAdminUploadVideo(Request $request,$id){
          $videos = Video::where('id',$id)->first();
           $cat = Category::all();
         // print_r($videos);die;
         return View('editadminuploadvideo',compact('videos','cat'));
     }
     
     
     /**
     * function for loading detailed subscription plans
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     
     public function subscriptionDetails(){
    // $subscriptions = \DB::table('subscriptions')->get();
     $subscriptions = Subscription::latest()->paginate(10);
    // print_r($subscriptions);die;
    return View('subscriptionplan',compact('subscriptions'))->with('i', (request()->input('page', 1) - 1) * 10);
     
     }
     
      /**
     * function for loading user queries
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function userQuery(){
         $query = UserQuery::latest()->paginate(10);
         return view('userquery',compact('query'))->with('i', (request()->input('page', 1) - 1) * 10);
     }
     
     /**
     * function for loading user queriesreply page
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function replyUserQuery(Request $request,$id){
         $query = UserQuery::where('id',$id)->first();
        // print_r($query);die;
         return View('replyuserquery',compact('query'));
         
     }
     
     
     /**
     * function for capturing admin response to user query
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function saveQueryResponse(Request $request){
          $validator = Validator::make($request->all(), [
            'response' => 'required',
            
        ]);
   
        if($validator->fails()){
             return back()->with('error','All fields are mandatory!');       
        }
        
        $id = $request->id;
        $data = ['response' => $request->response];
        $res = UserQuery::where('id','=',$id)->update($data);
         return redirect()->route('userquery')->withSuccess('User query replied successfully!');  
     }
     
      /**
     * function for update admin uploaded video 
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function updateAdminUploadVideo(Request $request){
          $validator = Validator::make($request->all(), [
             'title' => 'required',
             'category' => 'required',
             'thumb' => 'required',
             'source' => 'required',
             'subtitle' => 'required',
            
        ]);
   
        if($validator->fails()){
             return back()->with('error','All fields are mandatory!');       
        } 
        $id = $request->id;
        if(!empty($request->thumb1)){
             $destinationPath = base_path('images');
             $thumb = time().'.'.$request->thumb1->getClientOriginalExtension();
             $request->thumb1->move($destinationPath, $thumb); 
        }else{
             $thumb = $request->thumb;
        }
        
        if (!empty($request->hasFile('source1'))) {
             $filenameWithExt = $request->file('source1')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('source1')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'.time().'.'.$extension;
            $name = str_replace(' ', '', $fileNameToStore);

            $video = $request->source1;
           // $input = time().$video->getClientOriginalExtension();
            $destinationPath = base_path('videos');
            $video->move($destinationPath, $name);
        } else {
            $name = $request->source;
        }
        
         $data = array(
              'title' => $request->title,
              'category' => $request->category,
              'thumb' => $thumb,
              'source' => $name,
              'subtitle' => $request->subtitle,
            );
            
        $res = Video::where('id','=',$id)->update($data);
        return redirect()->route('adminvideo')->withSuccess('Video updated successfully!');
        
        
     }
     
     
    
      /**
     * function for loading user upload video edit form
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
      public function editUserUploadVideo(Request $request,$id){
          $videos = Video::where('id',$id)->first();
          $cat = Category::all();
         // print_r($videos);die;
         return View('edituseruploadvideo',compact('videos','cat'));
     }
     
      public function updateUserUploadVideo(Request $request){
          $validator = Validator::make($request->all(), [
             'title' => 'required',
             'category' => 'required',
            // 'thumb' => 'required',
            // 'source' => 'required',
             'subtitle' => 'required',
            
        ]);
   
        if($validator->fails()){
             return back()->with('error','All fields are mandatory!');       
        } 
        $id = $request->id;
        if(!empty($request->thumb1)){
             $destinationPath = base_path('images');
             $thumb = time().'.'.$request->thumb1->getClientOriginalExtension();
             $request->thumb1->move($destinationPath, $thumb); 
        }else{
             $thumb = $request->thumb;
        }
        
        if (!empty($request->hasFile('source1'))) {
             $filenameWithExt = $request->file('source1')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('source1')->getClientOriginalExtension();
            $fileNameToStore = $filename. '_'.time().'.'.$extension;

            $video = $request->source1;
           // $input = time().$video->getClientOriginalExtension();
            $destinationPath = base_path('videos');
            $video->move($destinationPath, $fileNameToStore);
        } else {
            $fileNameToStore = $request->source;
        }
        
         $data = array(
              'title' => $request->title,
              'category' => $request->category,
              'thumb' => $thumb,
              'source' => $fileNameToStore,
              'subtitle' => $request->subtitle,
            );
            
        $res = Video::where('id','=',$id)->update($data);
        return redirect()->route('usersvideo')->withSuccess('Video updated successfully!');
        
        
     }
     
     
      /**
     * function for loading user details page
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function userDetails(){
         $users = User::latest()->paginate(10);
        // print_r($users);die;
       //  return View('userdetails',compact('users'));
          return view('userdetails',compact('users'))->with('i', (request()->input('page', 1) - 1) * 10);
         
     }
     
     /**
     * function for loading live video details page
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function liveVideo(){
       $videos = LiveVideo::where('type', '=', '1')->latest()->paginate(10); 
      // print_r($videos);die;
       return view('livevideo',compact('videos'))->with('i', (request()->input('page', 1) - 1) * 10);
     }
     
     
     /**
     * function for loading on demand video details page
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function ondemandvideos(){
         $videos = LiveVideo::where('type', '=', '2')->latest()->paginate(10); 
     // print_r($videos);die;
       return view('ondemandvideo',compact('videos'))->with('i', (request()->input('page', 1) - 1) * 10); 
     }
     
     
     /**
     * function for loading videos for schedule video 
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function scheduleVideo(){
        $videos = Video::where('admin_approved', '=', '1')->latest()->paginate(10); 
      //  print_r($videos);die;
        return view('schedulevideo',compact('videos'))->with('i', (request()->input('page',1) - 1) * 10);
     }
     
     
     /**
     * function for loading schedule video form with video details
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function scheduleVideoForm(Request $request,$id){
         $videos = Video::where('id',$id)->first();
         $cat = Category::all();
        // print_r($videos);die;
         return view('schedulevideoform',compact('videos','cat'));
         
     }
     
     public function scheduleUploadedVideo(Request $request){
         $validator = Validator::make($request->all(), [
             'title' => 'required',
             'category' => 'required',
             'subtitle' => 'required',
             'schedule_time' => 'required',
             'schedule_date' => 'required',
             'duration' => 'required',
            
        ]);
   
        if($validator->fails()){
             return back()->with('error','All fields are mandatory!');       
        } 
        $secs = strtotime($request->duration)-strtotime("00:00:00");
        $endtime = date("H:i:s",strtotime($request->schedule_time)+$secs);
       // print_r($request->schedule_time);print_r('<br>');print_r($request->duration);print_r('<br>');print_r($endtime);die;
        if($request->get('btnSubmit') == 'livelivebutton'){
           // print_r("hi");die;
            if(!empty($request->thumb1)){
             $destinationPath = base_path('images');
             $thumb = time().'.'.$request->thumb1->getClientOriginalExtension();
             $request->thumb1->move($destinationPath, $thumb); 
            }else{
                 $thumb = $request->thumb;
            }
            
            $data = array(
                 'title' => $request->title,
                 'source' => $request->source,
                 'subtitle' => $request->subtitle,
                 'thumb' => $thumb,
                 'category' => $request->category,
                 'schedule_time' => $request->schedule_time,
                 'schedule_date' => $request->schedule_date,
                 'duration' => $endtime,
                 'type' => 1
                 
                );
            $live_videos =User::scheduleVideos($data);
            return redirect()->route('livevideo')->withSuccess('Video scheduled for live videos successfully!');
            
        }else{
           // print_r("hello");die;
            if(!empty($request->thumb1)){
             $destinationPath = base_path('images');
             $thumb = time().'.'.$request->thumb1->getClientOriginalExtension();
             $request->thumb1->move($destinationPath, $thumb); 
            }else{
                 $thumb = $request->thumb;
            }
            
            $data = array(
                 'title' => $request->title,
                 'source' => $request->source,
                 'subtitle' => $request->subtitle,
                 'thumb' => $thumb,
                 'category' => $request->category,
                 'schedule_time' => $request->schedule_time,
                 'schedule_date' => $request->schedule_date,
                 'duration' => $endtime,
                 'type' => 2
                 
                );
            $live_videos =User::scheduleVideos($data);
            return redirect()->route('ondemandvideos')->withSuccess('Video scheduled for on demand videos successfully!');
        }
     }
     
     
     /**
     * function for blocking on demand videos
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function blockOnDemandVideos(Request $request,$id){
         $data = ['type' => 3];
         $res = User::blockOnDemandVideo($id,$data);
         return redirect()->route('ondemandvideos')->withSuccess('Video blocked successfully!');  
     }
     
     
      /**
     * function for loading users subscription details
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function userSubscriptionDetails(){
         $details = UserSubscription::latest()->join('users', 'user_subscriptions.user_id', '=', 'users.id')->select('users.name', 'user_subscriptions.*')->paginate(10); 
      //  print_r($details);die;
        return view('usersubscriptiondetails',compact('details'))->with('i', (request()->input('page',1) - 1) * 10);
         
     }
     
     
     /**
     * function for loading users subscription details for edit by admin
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function editUserSubDetails(Request $request,$id){
         $details = Subscription::where('id',$id)->first();
         return view('editusersubscription', compact('details'));
     }
     
      /**
     * function for updating users subscription details for edit by admin
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function updateUserSubscription(Request $request){
         $id = $request->id;
         $data = array(
         'price' => $request->amount,
         'currency' => $request->currency,
         );
         $res = Subscription::where('id','=',$id)->update($data);
        return redirect()->route('subscriptiondetails')->withSuccess('Subscription updated successfully!');
         
     }
     
      /**
     * function for submit contact us data from website
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function contactQuery(Request $request){
         $input = $request->all();
        // dd($input);die;
         $res = Contact::create($input);
         return redirect()->route('index'); 
     }
     
     
      /**
     * function for upload video from website
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function uploadVideoWeb(Request $request){
       $input = $request->all();
       //dd($input);die;
        if(!empty($request->thumb)){
             $destinationPath = base_path('images');
              $thumb = time().'.'.$request->thumb->getClientOriginalExtension();
            //  print_r($thumb);die;
              $request->thumb->move($destinationPath, $thumb); 
       }else{
           $thumb = '';
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
        
        $data = array(
              'user_id' => '0',
              'title' => $request->title,
              'category' => $request->category,
              'thumb' => $thumb,
              'source' => $fileNameToStore,
              'subtitle' => $request->subtitle,
              'uploaded_by' => '3',
              'admin_approved' => '0'
            );
            
        $res = Video::create($data);
         echo ("<script LANGUAGE='JavaScript'>
                    window.alert('Video uploaded successfully');
                    window.location.href='http://44.238.240.101';
                    </script>");
        return redirect()->route('index');  
     }
     
     
     public function Demo(Request $request){
          $videos = \DB::table('live_videos')->where('type','1')->latest()->paginate(10); 
         // print_r($videos);die;
         return view('demo',compact('videos'))->with('i', (request()->input('page', 1) - 1) * 10);
     }
     
      /**
     * function for deleting videos uploaded by user
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function deleteVideo(Request $request,$id){
         $res = Video::where('id',$id)->delete();
         return redirect()->route('usersvideo')->withSuccess('Video deleted successfully!');  
     }
     
      /**
     * function for transferring on demand videos to live videos
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function makeVideoLive(Request $request,$id){
         $data = ['type' => 1];
         $res = User::sendVideoToLive($id,$data);
        return redirect()->route('ondemandvideos')->withSuccess('Video transferred to live videos successfully!'); 
     }
     
     
      /**
     * function for loading edit live video details
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function editLiveVideo(Request $request,$id){
        // $videos = User::fetchLiveVideoById($id);
         $videos = LiveVideo::where('id',$id)->first();
        // print_r($videos[0]->title);die;
         return view('editlivevideo',compact('videos'));
     }
     
     
     /**
     * function for updating live videos
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     public function updateLiveVideo(Request $request){
        // dd($request);die;
        $id = $request->id;
       // $data = ['schedule_time' => $request->schedule_time, 'schedule_date' => $request->schedule_date];
        $details = LiveVideo::where('id',$id)->first();
        $prescheduletime = $details->schedule_time;
        $duration = $details->duration;
        
       $timediff = date("H:i:s",strtotime($duration) - strtotime($prescheduletime));
       $videoduration = $timediff;
       
        $secs = strtotime($videoduration)-strtotime("00:00:00");
        $endtime = date("H:i:s",strtotime($request->schedule_time)+$secs);
        
        $exist = LiveVideo::where('schedule_date',$request->schedule_date)->where('schedule_time', '>=', $request->schedule_time)->orWhere('duration', '<=', $endtime)->first();
       // print_r($exist);die;
        if(empty($exist)){
        $data = ['schedule_time' => $request->schedule_time, 'schedule_date' => $request->schedule_date, 'duration' => $endtime];
       
       $res = LiveVideo::where('id',$id)->update($data);
       return redirect()->route('livevideo')->withSuccess('Live video details updated successfully!');
        }else{
           return redirect()->route('livevideo')->withSuccess('This time slot is already alloted to other live video. Please select different time slot!');    
        }
     }
     
     
     public function userDetailsById(Request $request,$id){
         $details = User::where('id',$id)->first();
         if(empty($details)){
            return redirect()->route('schedulevideo')->withSuccess('User not found!'); 
         }else{
          // print_r($details);die; 
           return view('userdetailsview',compact('details'));
         }
         
     }
     
     public function promoCode(){
         $details = PromoCode::latest()->paginate(10);
         return view('promocodedetails',compact('details'))->with('i', (request()->input('page', 1) - 1) * 10);
         
     }
     
     public function editPromoCode(Request $request,$id){
         $details = PromoCode::where('id',$id)->first();
        // print_r($details);die;
         return view('editpromocode',compact('details'));
     }
     
     public function updatePromoCode(Request $request){
         $id = $request->id;
         $data = ['promo_code_name' => $request->promo_code_name, 'discount' => $request->discount];
        // print_r($id);die;
        $res = PromoCode::where('id','=',$id)->update($data);
        return redirect()->route('promocode')->withSuccess('Promo Code updated successfully!');
     }
     
     public function deletePromoCode(Request $request,$id){
         $id = $request->id;
         $res = PromoCode::where('id','=',$id)->delete();
        return redirect()->route('promocode')->withSuccess('Promo Code deleted successfully!');
     }
     
     public function addPromoCode(){
         return view('addpromocode');
     }
     
     public function savePromoCode(Request $request){
         $input = $request->all();
         $res = PromoCode::create($input);
         return redirect()->route('promocode')->withSuccess('Promo Code added successfully!');
     }
     
     public function makeVideoAds(Request $request,$id){
        // print_r($id);die;
        $details = LiveVideo::where('id',$id)->first();
       // print_r($details);die;
       $data = array(
             'title' => $details->title,
             'source' => $details->source,
             'subtitle' => $details->subtitle,
             'thumb' => $details->thumb,
             'category' => $details->category,
             'schedule_time' => $details->schedule_time,
             'schedule_date' => $details->schedule_date,
             'duration' => $details->duration,
           );
           
         $res = AdVideo::create($data); 
         return redirect()->route('ondemandvideos')->withSuccess('Video added at empty slots successfully!');
     }
     
     
     public function approvedVideosList(){
          $videos = Video::where('admin_approved',1)->join('users', 'videos.user_id', '=', 'users.id')->select('users.name', 'videos.*')->latest()->paginate(10);
       //  print_r($videos);die;
         return view('approvedvideolist',compact('videos'))->with('i', (request()->input('page', 1) - 1) * 10);
     }
     
     // public function payForVideo(Request $request,$id){
     //     $videodetails = Video::where('id',$id)->first();
     //     $user_id = $videodetails->user_id;
     //     $userdetails = User::where('id',$user_id)->first();
     //     if(!empty($userdetails->stripe_token)){
     //         $destination = $userdetails->stripe_token;
     //         $amount = $request->amount;
     //         $pay =  $this->paymentProcessByAdmin($destination,$amount);
     //     }else{
     //       return back()->with('error','Stripe token of user is not available');   
     //     }
        
     // }

     public function payForVideo(Request $request,$id){
       $userdetails = Video::where('videos.id',$id)->join('users', 'videos.user_id', '=', 'users.id')->select('users.name','users.paypal_id','users.fcm_token','videos.*')->first();
           
           // print_r($userdetails);die;
           return view('paypal',compact('userdetails'));  
      }  
     
     public function userVideosById(Request $request,$id){
         $videos = Video::where('user_id', $id)->latest()->paginate(10);
         return view('uservideodetails',compact('videos'))->with('i', (request()->input('page', 1) - 1) * 10);
     }
     
     
      /**
     * function for processing payments
     * Vikash Rai
     * @return \Illuminate\Http\Response
     */
     private function paymentProcessByAdmin($destination,$amount){
       
     
        require_once(base_path('/vendor/stripe/stripe-php/init.php'));
        Stripe\Stripe::setApiKey('sk_test_51Hr4iOGRw0lHExl04VenL02NpmctQpxid9fcJ6LJzQpgdSo0ZNZk4VE0DwFndbaed8BYWPyguvmd8XCw0CCKnefH00aNCs2Nd3');
       
	 	$amount *= 100;
        $amount = (int) $amount;
        $currency = "usd";
        
		$pay = \Stripe\transfers::create([
          'amount' => $amount,
          'currency' => $currency,
          'destination' => $destination,
        ]);
		
		return $pay;
    
    }
    
    
     
   
}
