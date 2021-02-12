<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
       // 'password',
        'phone_number',
        'phone_verified',
        'email_verified_at',
        'profile_picture',
        'customer_id',
        'paypal_id',
        'country',
        'state',
        'city',
        'fcm_token',
        'device_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       // 'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
      public static function saveOTP($id,$otp){
          $data = array(
                'user_id' => $id,
                'otp' => $otp
              );
         $value = DB::table('users_otp')->insert($data);
        if($value){
            return TRUE;
        }else{
            return FALSE;
        } 
      }
      
      public static function fetchOtpData($id,$table){
           $value = DB::table($table)->where('user_id', $id)->get();
          return $value;
      }
      
      public static function updateOTP($id,$otp){
           $data = array(
                'otp' => $otp
              );
           $value = DB::table('users_otp')->where('user_id',$id)->update($data);
          return $value; 
      }
      
      public static function saveUserPhone($id,$data){
          $value = DB::table('users')->where('id',$id)->update($data);
          return $value; 
      }
      
       public static function savePhoneOTP($id,$otp){
          $data = array(
                'user_id' => $id,
                'otp' => $otp
              );
            //  print_r($data);die;
         $value = DB::table('user_phone_otp')->insert($data);
        if($value){
            return TRUE;
        }else{
            return FALSE;
        } 
      }
      
       public static function updatePhoneOTP($id,$otp){
           $data = array(
                'otp' => $otp
              );
           $value = DB::table('user_phone_otp')->where('user_id',$id)->update($data);
          return $value; 
      }
      
      public static function verifyphone($id){
          $data = ['phone_verified' => "1"];
          $value = DB::table('users')->where('id',$id)->update($data);
          return $value;
      }
      
       public static function saveVideoData($data){
         $value = DB::table('videos')->insertGetId($data);
        if($value){
            return $value;
        }else{
            return FALSE;
        } 
      }
      
      public static function fetchUsersSubscription($id){
          $value = DB::table('user_subscriptions')->where('user_id', $id)->get();
          return $value; 
      }
      
      public static function fetchLiveVideo(){
          $value = DB::table('live_videos')->where('type','1')->get();
          return $value; 
      }
      
      public static function fetchVideoList($cat,$index,$offset){
          $end = (int)$index + 15;
        //  print_r($end);die;
         $value=DB::table('videos')->where('category', $cat)->where('admin_approved', "1")->orderBy('id','desc')->limit($offset,$index)->get()->toArray();
        return $value; 
      }
      
      public static function fetchCategoryList(){
         $value=DB::table('categories')->where('status','1')->get()->toArray();
        return $value;  
      }
      
      public static function fetchSubscriptionDetails(){
          $value = DB::table('subscriptions')->get();
          return $value; 
      }
      
      public static function scheduleVideos($data){
          $value = DB::table('live_videos')->insertGetId($data);
            if($value){
                return $value;
            }else{
                return FALSE;
            }  
      }
      
     public static function blockOnDemandVideo($id,$data){
        $value = DB::table('live_videos')->where('id',$id)->update($data);
          return $value; 
     } 
     
     public static function sendVideoToLive($id,$data){
        $value = DB::table('live_videos')->where('id',$id)->update($data);
          return $value; 
     }
     
     public static function fetchLiveVideoById($id){
         $value = DB::table('live_videos')->where('id',$id)->get();
         return $value;
     }
}
