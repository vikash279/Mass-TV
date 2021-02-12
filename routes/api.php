<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\StripeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('verifyOTP', [RegisterController::class, 'verifyOTP']);
Route::post('addphone', [RegisterController::class, 'addPhone']);
Route::post('verifyphone', [RegisterController::class, 'verifyPhone']);
Route::post('uploadvideos', [RegisterController::class, 'uploadVideos']);
Route::post('mysubscription', [RegisterController::class, 'mySubscription']);
Route::get('livevideo', [RegisterController::class, 'liveVideo']);
Route::post('videolist', [RegisterController::class, 'videoList']);
Route::get('fetchcategories', [RegisterController::class, 'fetchMasterCategories']);
Route::post('editprofile', [RegisterController::class, 'editProfile']);
Route::post('paymentprocess', [RegisterController::class, 'paymentProcess']);
//Route::post('createcustomers', [RegisterController::class, 'createCustomer']);
Route::post('getcustomerid', [RegisterController::class, 'getCustomerID']);
Route::post('paymentmethod', [RegisterController::class, 'paymentMethod']);
Route::post('fetchclientsecret', [RegisterController::class, 'fetchClientSecret']);
Route::post('getpaymentmethods', [RegisterController::class, 'getPaymentMethods']);
Route::get('fetchhomescreendata', [RegisterController::class, 'fetchHomeScreenData']);
Route::get('fetchsubscriptiondetails', [RegisterController::class, 'fetchSubscriptionDetails']);
Route::post('captureuserquery', [RegisterController::class, 'captureUserQuery']);
Route::post('getuserquerydetails', [RegisterController::class, 'getUserQueryDetails']);
Route::post('verifysubscription', [RegisterController::class, 'verifySubscription']);
Route::post('searchhint', [RegisterController::class, 'searchHint']);
Route::post('searchresult', [RegisterController::class, 'searchResult']);
Route::post('userbankdetails', [RegisterController::class, 'userBankDetails']);
Route::post('fetchuseraccount', [RegisterController::class, 'fetchUserAccount']);
Route::post('userfcmtoken', [RegisterController::class, 'userFcmToken']);
Route::post('applypromocode', [RegisterController::class, 'applyPromoCode']);
Route::post('pushnotification', [RegisterController::class, 'pushNotification']);
Route::post('pushnotificationios', [RegisterController::class, 'pushNotificationIOS']);
Route::post('watchlist', [RegisterController::class, 'watchList']);
Route::post('fetchwatchlist', [RegisterController::class, 'fetchWatchList']);
Route::post('fetchuseruploadedvideodetails', [RegisterController::class, 'fetchUserUploadedVideoDetails']);
Route::post('fetchuservideodetails', [RegisterController::class, 'fetchUserVideoDetails']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

