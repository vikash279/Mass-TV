<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayPalController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



  Route::get('/index', function () {
      return view('index');
  })->name('index');
  Route::get('/contactus', function () {
      return view('contact');
  })->name('contactus');
  Route::get('/contentform', function () {
      return view('submitcontent');
  })->name('contentform');
    Route::get('/newindex', function () {
      return view('index1');
  })->name('newindex');
  
  Route::get('/policy', function () {
      return view('privacy_policy');
  })->name('policy');
  
Route::get('/admin',[UserController::class, 'index'])->name('admin');
Route::get('/dashboard',[UserController::class, 'dashBoard'])->name('dashboard');
Route::post('/login',[UserController::class, 'login']);
Route::get('/category',[UserController::class, 'category'])->name('category');
Route::get('/addcategory',[UserController::class, 'addCategory']);
Route::post('/savecategory',[UserController::class, 'saveCategory']);
Route::get('/activecat/{id}',[UserController::class, 'activeCat']);
Route::get('/deactivecat/{id}',[UserController::class, 'deactiveCat']);
Route::get('/editcat/{id}',[UserController::class, 'editCat']);
Route::get('/approvevideo/{id}',[UserController::class, 'approveVideo']);
Route::get('/deletevideo/{id}',[UserController::class, 'deleteVideo']);
Route::get('/makevideolive/{id}',[UserController::class, 'makeVideoLive']);
Route::get('/editlivevideo/{id}',[UserController::class, 'editLiveVideo']);
Route::get('/usersvideo',[UserController::class, 'usersVideo'])->name('usersvideo');
Route::get('/userdetails',[UserController::class, 'userDetails'])->name('userdetails');
Route::post('/updatecategory',[UserController::class, 'updateCategory']);
Route::get('/adminvideo',[UserController::class, 'adminVideo'])->name('adminvideo');
Route::get('/webvideo',[UserController::class, 'webVideo'])->name('webvideo');
Route::get('/adminuploadvideo',[UserController::class, 'adminUploadVideo'])->name('adminuploadvideo');
Route::get('/subscriptiondetails',[UserController::class, 'subscriptionDetails'])->name('subscriptiondetails');
Route::get('/usersubscriptiondetails',[UserController::class, 'userSubscriptionDetails'])->name('usersubscriptiondetails');
Route::get('/userquery',[UserController::class, 'userQuery'])->name('userquery');
Route::get('/editadminuploadvideo/{id}',[UserController::class, 'editAdminUploadVideo']);
Route::get('/userdetailsbyid/{id}',[UserController::class, 'userDetailsById']);
Route::get('/schedulevideoform/{id}',[UserController::class, 'scheduleVideoForm']);
Route::get('/edituseruploadvideo/{id}',[UserController::class, 'editUserUploadVideo']);
Route::get('/replyuserquery/{id}',[UserController::class, 'replyUserQuery']);
Route::get('/editusersubdetails/{id}',[UserController::class, 'editUserSubDetails']);
Route::post('/uploadvideo',[UserController::class, 'uploadVideo']);
Route::post('/savequeryresponse',[UserController::class, 'saveQueryResponse']);
Route::post('/updateadminuploadvideo',[UserController::class, 'updateAdminUploadVideo']);
Route::post('/updateuseruploadvideo',[UserController::class, 'updateUserUploadVideo']);
Route::get('/livevideo',[UserController::class, 'liveVideo'])->name('livevideo');
Route::get('/schedulevideo',[UserController::class, 'scheduleVideo'])->name('schedulevideo');
Route::get('/ondemandvideos',[UserController::class, 'onDemandVideos'])->name('ondemandvideos');
Route::post('/scheduleuploadedvideo',[UserController::class, 'scheduleUploadedVideo']);
Route::post('/contactquery',[UserController::class, 'contactQuery']);
Route::post('/uploadvideoweb',[UserController::class, 'uploadVideoWeb']);
Route::post('/updateusersubscription',[UserController::class, 'updateUserSubscription']);
Route::post('/updatelivevideo',[UserController::class, 'updateLiveVideo']);
Route::post('/updatepromocode',[UserController::class, 'updatePromoCode']);
Route::post('/savepromocode',[UserController::class, 'savePromoCode']);
Route::get('/blockondemandvideos/{id}',[UserController::class, 'blockOnDemandVideos']);
Route::get('/editpromocode/{id}',[UserController::class, 'editPromoCode']);
Route::get('/deletepromocode/{id}',[UserController::class, 'deletePromoCode']);
Route::get('/makevideoads/{id}',[UserController::class, 'makeVideoAds']);
Route::get('/payforvideo/{id}',[UserController::class, 'payForVideo']);
Route::get('/uservideosbyid/{id}',[UserController::class, 'userVideosById']);
Route::get('/demo',[UserController::class, 'Demo'])->name('demo');
Route::get('/promocode',[UserController::class, 'promoCode'])->name('promocode');
Route::get('/addpromocode',[UserController::class, 'addPromoCode'])->name('addpromocode');
Route::get('/approvedvideoslist',[UserController::class, 'approvedVideosList'])->name('approvedvideoslist');

Route::post('payment', [PayPalController::class, 'payment'])->name('payment');
Route::get('cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
Route::get('success', [PayPalController::class, 'success'])->name('payment.success');

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/admin');
})->name('logout');
