<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login',[App\Http\Controllers\API\LoginController::class, 'login'])->name('login');
Route::post('/signup',[App\Http\Controllers\API\LoginController::class, 'register']);
Route::post('/send/otp',[App\Http\Controllers\API\LoginController::class, 'sendOtp']);
Route::post('/verify/otp',[App\Http\Controllers\API\LoginController::class, 'verifyOtp']);
Route::post('/reset/password',[App\Http\Controllers\API\LoginController::class, 'resetPassword']);

Route::post('/post/proinfo', [App\Http\Controllers\API\LoginController::class, 'proSignup']);
Route::post('/promocode/list',[App\Http\Controllers\API\ApiController::class, 'getPromocodes']);
Route::any('/get/service',[App\Http\Controllers\API\ApiController::class, 'getServiceList']);
Route::any('/get/popular/service',[App\Http\Controllers\API\ApiController::class, 'popularServiceLists']);

Route::middleware('auth:sanctum')->group( function () {
        
    Route::any('/proinfo/after-signup',   [App\Http\Controllers\API\LoginController::class,'proAfterSignup']);
    Route::post('/get/notifications',[App\Http\Controllers\API\ApiController::class, 'getNotifications']);
    Route::post('/get/pros',[App\Http\Controllers\API\ApiController::class, 'getProList']);
    
    Route::post('/subs',[App\Http\Controllers\API\ProController::class, 'subs']);

    Route::post('/post-transaction',[App\Http\Controllers\API\ApiController::class, 'postTransaction']);
    Route::post('/booking-details',[App\Http\Controllers\API\ApiController::class, 'getBookingDetails']);
    Route::post('/search-booking-details',[App\Http\Controllers\API\ApiController::class, 'searchBookingDetails']);
    Route::post('/send_mail', [App\Http\Controllers\API\ApiController::class, 'custombookingsPost']);
    Route::post('/custombookingsList', [App\Http\Controllers\API\ApiController::class, 'custombookingsList']);
    //Pro Leads
    Route::any('/get/leads',[App\Http\Controllers\API\ProController::class, 'getLeads']);
    Route::post('/accept/leads',[App\Http\Controllers\API\ProController::class, 'acceptLeads']);
    Route::post('/reject/leads',[App\Http\Controllers\API\ProController::class, 'rejectLeads']);
    
    //Reviews
    Route::post('user/ratings',[App\Http\Controllers\API\ApiController::class, 'postProReviews']);

    Route::any('/bookings',[App\Http\Controllers\API\ApiController::class, 'bookingsPost']);
    Route::post('re-bookings',[App\Http\Controllers\API\ApiController::class, 'reBookingsPost']);
    Route::post('/bookings/list',[App\Http\Controllers\API\ApiController::class, 'bookingsList']);

    Route::post('/add/address',[App\Http\Controllers\API\ApiController::class, 'addAddress']);
    Route::post('/edit/address',[App\Http\Controllers\API\ApiController::class, 'editAddress']);
    Route::post('/get/address',[App\Http\Controllers\API\ApiController::class, 'getAddress']);

    Route::post('apply/promocode',[App\Http\Controllers\API\ApiController::class, 'applyPromocode']);

    Route::post('pro/bookings/list',[App\Http\Controllers\API\ProController::class, 'proBookingsList']);
    
    Route::post('/user/cancel/booking',[App\Http\Controllers\API\ApiController::class, 'cancelBooking']);
    
    Route::post('/user/get-details',[App\Http\Controllers\API\ApiController::class, 'getUserDetails']);

    Route::post('/delete-notifications',[App\Http\Controllers\API\ApiController::class, 'deleteNotification']);

    Route::post('/pro/start/service',[App\Http\Controllers\API\ProController::class, 'startService']);
    Route::post('/pro/verify/start-otp',[App\Http\Controllers\API\ProController::class, 'verifyStartSvcOtp']);

    Route::post('/pro/update/profile',[App\Http\Controllers\API\ProController::class, 'updateProfilePro']);

    Route::post('/update/profile',[App\Http\Controllers\API\ApiController::class, 'updateProfile']);
    Route::post('/change/noti-status',[App\Http\Controllers\API\ApiController::class, 'changeNotificationStatus']);

    Route::post('/pro/end/service',[App\Http\Controllers\API\ProController::class, 'endService']);
    Route::post('/pro/verify/end-otp',[App\Http\Controllers\API\ProController::class, 'verifyEndSvcOtp']);

    Route::post('/pro/cancel/booking',[App\Http\Controllers\API\ProController::class, 'cancelProBooking']);

    
    //Pro Update Info
    Route::post('/pro/get-services',[App\Http\Controllers\API\ProController::class, 'getProServiceList']);
    Route::post('/pro/update-services',[App\Http\Controllers\API\ProController::class, 'updateServices']);
    Route::post('/pro/update-availability',[App\Http\Controllers\API\ProController::class, 'updateProAvailability']);
    Route::post('/pro/update-company',[App\Http\Controllers\API\ProController::class, 'updateCompanyDetails']);
    Route::post('/pro/update-banking',[App\Http\Controllers\API\ProController::class, 'updateBankingDetails']);
    Route::post('/pro/update-documents',[App\Http\Controllers\API\ProController::class, 'updateDocuments']);
    
    Route::post('/pro/update-insurance',[App\Http\Controllers\API\ProController::class, 'updateInsurance']);

    Route::post('/pro/get-listings',[App\Http\Controllers\API\ProController::class, 'getListingDetails']);

    Route::post('/pro/get-reviews',[App\Http\Controllers\API\ProController::class, 'getProReviews']);
    
 
    

    //Logout
    Route::any('/logout',[App\Http\Controllers\API\LoginController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
