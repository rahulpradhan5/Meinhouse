<?php

use Illuminate\Support\Facades\Route;


Route::get('/email_template_demo',function(){
   return view('email_template_demo'); 
});

/*----------------------------------------------------------------------- start of website ----------------------------------------------------------------------*/

Route::get('/',[App\Http\Controllers\HomeController::class,"Index"])->name('index');
Route::get('about-us',[App\Http\Controllers\HomeController::class,"About"])->name('about');
Route::get('our-services',[App\Http\Controllers\HomeController::class,"Service"])->name('service');
Route::get('blog-post',[App\Http\Controllers\HomeController::class,"Blog"])->name('blog');
Route::get('blog/{url}',[App\Http\Controllers\HomeController::class,"blogdetail"])->name('blogdetail');
Route::get('contact-us',[App\Http\Controllers\HomeController::class,"Contact"])->name('contact');


Route::get('service-detail/{url}',[App\Http\Controllers\HomeController::class,"serviceDetail"])->name("service-detail");
Route::get('terms',[App\Http\Controllers\HomeController::class,"Terms"])->name("terms");
Route::get('privacy-policy',[App\Http\Controllers\HomeController::class,"privacyPolicy"])->name("privacy-policy");

/*----------------------------------------------------------------------- end of website ------------------------------------------------------------------------*/

Route::get('/view/estimate/{id}/{service_id}',[App\Http\Controllers\AdminControllerNew::class,"ViewProEstimate"]);

Route::post('purchase-job-payment-post',[App\Http\Controllers\AdminControllerNew::class,"purchaseJobPaymentPost"]);

Route::get('/view/user/ProjectDetails/{id}',[App\Http\Controllers\HomeController::class,"ViewProjectDetails"]);



Route::get('userEstimateInvoice/{id}',[App\Http\Controllers\HomeController::class,"userEstimateInvoice"]);
/*-------------------------------------------------------- Start of User Section ----------------------------------------------*/
Route::group(['middleware'=>['prevent-back-history','userCheck']],function(){
    Route::get('dashboard',[App\Http\Controllers\UserController::class,"Dashboard"])->name('dashboard');
    Route::get('past',[App\Http\Controllers\UserController::class,"Past"])->name('past');
    Route::post('booking',[App\Http\Controllers\UserController::class,"booking"])->name('booking');
    Route::get('editprofile',[App\Http\Controllers\UserController::class,"editprofile"])->name('editprofile');
    Route::post('add-address',[App\Http\Controllers\UserController::class,"addaddress"])->name('add-address');
    Route::post('edit-address',[App\Http\Controllers\UserController::class,"editaddress"])->name('edit-address');
    Route::post('cancel-booking',[App\Http\Controllers\UserController::class,"userCancelBooking"])->name('userCancelBooking');
    Route::post('edit-address-post',[App\Http\Controllers\UserController::class,"postEditAddress"])->name('edit-address-post');
    Route::post('update-profile',[App\Http\Controllers\UserController::class,"updateprofile"])->name('update-profile');
    Route::post('update-password',[App\Http\Controllers\UserController::class,"updatepassword"])->name('update-password');
    Route::get('delete-address/{id}',[App\Http\Controllers\UserController::class,"deleteaddress"])->name('delete-address');
    Route::get('add-primary-address/{id}',[App\Http\Controllers\UserController::class,"addprimaryaddress"])->name('add-primary-address');
    Route::post('custom-booking-post',[App\Http\Controllers\UserController::class,"customBookingPost"])->name('customBookingPost');
    Route::get('booking-details/{id}',[App\Http\Controllers\UserController::class,"bookingDetail"])->name('bookingDetail');
    Route::post('payment-make',[App\Http\Controllers\UserController::class,"makePayment"])->name('payment-make');
    Route::post('payment-make-post',[App\Http\Controllers\UserController::class,"makePaymentPost"])->name('payment-make-post');
    Route::get('view-invoice/{id}',[App\Http\Controllers\UserController::class,"ViewInvoice"])->name('view.invoice');
    Route::get('invoices/{id}',[App\Http\Controllers\UserController::class,"Invoice"])->name('invoice');
    Route::post('search-booking',[App\Http\Controllers\UserController::class,"showBooking"])->name('search-booking');
    Route::get('user-offers',[App\Http\Controllers\UserController::class,"offers"])->name('offer-detail');
});
Route::get('custom-booking',[App\Http\Controllers\UserController::class,"custom_booking"])->name('custom_booking');
Route::post('contact-us-post',[App\Http\Controllers\HomeController::class,"contactUsPost"])->name('contactUsPost');


/*-------------------------------------------------------- End of User Section ------------------------------------------------*/

/*----------------------Invoice Management -----------------------*/
Route::get('booking-invoice/{id}', [App\Http\Controllers\AdminController::class, 'booking_invoice'])->name('booking-invoice');
Route::get('online-pay/{id}', [App\Http\Controllers\AdminController::class, 'online_pay'])->name('online-pay');
Route::post('payment-done/{id}', [App\Http\Controllers\AdminController::class, 'payment_done'])->name('payment-done');

Route::get('professional', [App\Http\Controllers\AdminController::class, 'professional'])->name('professional');

/*----------------------Invoice Management -----------------------*/


Route::get('estimate', [App\Http\Controllers\AdminController::class, 'estimate'])->name('estimate');
//Route::get('estimate', [App\Http\Controllers\AdminController::class, 'estimate'])->name('estimate');
Route::get('add-estimate', [App\Http\Controllers\AdminController::class, 'add_estimate'])->name('add-estimate');
Route::post('post-add-estimate', [App\Http\Controllers\AdminController::class, 'post_add_estimate'])->name('post-add-estimate');


Route::group(['middleware'=>['prevent-back-history','adminBasicAuth']],function(){

        Route::get('admin-dashboard', [App\Http\Controllers\AdminController::class, 'admin_dashboard'])->name('admin-dashboard');

        // --------------------------Manage Professional------------------------
        Route::get('view-professional/{id}', [App\Http\Controllers\AdminController::class, 'view_professional'])->name('view-professional');
         
        /*----------------------User Management -----------------------*/
        Route::get('user', [App\Http\Controllers\AdminController::class, 'user_index'])->name('user');
        Route::post('user_status', [App\Http\Controllers\AdminController::class, 'user_status'])->name('user_status');
        Route::post('user_state', [App\Http\Controllers\AdminController::class, 'user_state'])->name('user_state');
        /*----------------------User Management -----------------------*/
        /*----------------------Service Management -----------------------*/
        Route::get('service', [App\Http\Controllers\AdminController::class, 'service_index'])->name('service');
        Route::get('view-service/{id}', [App\Http\Controllers\AdminController::class, 'view_service'])->name('view-service');
        Route::post('service_status', [App\Http\Controllers\AdminController::class, 'service_status'])->name('service_status');
        /*----------------------Service Management -----------------------*/



        /*----------------------Booking Management -----------------------*/
        Route::get('bookings', [App\Http\Controllers\AdminController::class, 'bookings_index'])->name('bookings');
        Route::get('view-booking/{id}', [App\Http\Controllers\AdminController::class, 'view_booking'])->name('view-booking');

        /*----------------------Booking Management -----------------------*/

        /*----------------------Sales Management -----------------------*/
        Route::get('sales', [App\Http\Controllers\AdminController::class, 'sales_index'])->name('sales');
        Route::get('view-sale/{id}', [App\Http\Controllers\AdminController::class, 'view_sale'])->name('view-sale');

        /*----------------------Booking Management -----------------------*/

        /*----------------------Transaction Management -----------------------*/
        Route::get('transaction', [App\Http\Controllers\AdminController::class, 'transaction_index'])->name('transaction');

        /*----------------------Transaction Management -----------------------*/

        /*----------------------Promo Management -----------------------*/
        Route::get('promo', [App\Http\Controllers\AdminController::class, 'promo_index'])->name('promo');
        Route::get('view-promo/{id}', [App\Http\Controllers\AdminController::class, 'view_promo'])->name('view-promo');

        /*----------------------Promo Management -----------------------*/
        // ------------------------Testimonial Management--------------------
        Route::get('testimonials',[App\Http\Controllers\AdminController::class,'testimonial'])->name('testimonial');
        Route::match(['get','post'],'add-testimonial',[App\Http\Controllers\AdminController::class,'addTestimonial'])->name('add-testimonial');
        Route::get('view-testimonial/{id}', [App\Http\Controllers\AdminController::class, 'view_testimonial'])->name('view-testimonial');
        Route::match(['get','post'],'edit-testimonial/{id}',[App\Http\Controllers\AdminController::class,'editTestimonial'])->name('edit-testimonial');
        Route::get('delete-testimonial/{id}',[App\Http\Controllers\AdminController::class,'deleteTestimonial']);

        // ------------------------Testimonial Management--------------------
        // ------------------------Blog Management--------------------
        Route::get('blog',[App\Http\Controllers\AdminController::class,'blog'])->name('blog');
        Route::match(['get','post'],'add-blog',[App\Http\Controllers\AdminController::class,'addBlog'])->name('add-blog');
        Route::get('view-blog/{id}', [App\Http\Controllers\AdminController::class, 'view_blog'])->name('view-blog');
        Route::match(['get','post'],'edit-blog/{id}',[App\Http\Controllers\AdminController::class,'editBlog'])->name('edit-blog');
        Route::get('delete-blog/{id}',[App\Http\Controllers\AdminController::class,'deleteBlog']);

        // ------------------------Blog Management--------------------
        // ------------------------Contact Management--------------------
        Route::get('contact',[App\Http\Controllers\AdminController::class,'contact'])->name('contact');
        Route::get('view-contact/{id}', [App\Http\Controllers\AdminController::class, 'view_contact'])->name('view-contact');
        Route::get('delete-contact/{id}',[App\Http\Controllers\AdminController::class,'deleteContact']);

        // ------------------------Contact Management--------------------
        /*----------------------Estimate Management -----------------------*/
        /*----------------------Estimate Management -----------------------*/
});
Route::get('getProfessional', [App\Http\Controllers\AdminController::class, 'getProfessional'])->name('getProfessional');

Route::group(['middleware'=>['prevent-back-history','webLoginAuth']],function(){
    Route::get('login',[App\Http\Controllers\UserController::class,"Login"])->name('login');
    Route::post('login-post',[App\Http\Controllers\UserController::class,"login_post"])->name('login_post');
    Route::post('registerPost',[App\Http\Controllers\UserController::class,"registerPost"])->name('user_register');
    Route::get('register',[App\Http\Controllers\UserController::class,"Register"])->name('register');
    Route::get('forgot-password',[App\Http\Controllers\UserController::class,"forgotPassword"])->name('forget password');
	Route::post('forgot-sendmail',[App\Http\Controllers\UserController::class,"forgotSendMail"])->name('forget-sendmail');
		Route::get('password-reset/{token}',[App\Http\Controllers\UserController::class,"resetPassword"])->name('password-reset');
	Route::post('password-reset/post',[App\Http\Controllers\UserController::class,"resetPasswordSave"])->name('password-reset-post');
//
});

//Route::group(['middleware'=>['prevent-back-history','adminLoginAuth']],function(){
    //Route::get('admin-login', [App\Http\Controllers\AdminController::class, 'index'])->name('admin-login');
    //Route::post('admin-login-post', [App\Http\Controllers\AdminController::class, 'login_post'])->name('admin-login-post');
//});
Route::group(['middleware'=>'prevent-back-history'],function(){
    Route::get('user-logout', [App\Http\Controllers\UserController::class, 'logout'])->name('user-logout');
    Route::get('pro-logout', [App\Http\Controllers\ProffController::class, 'logout'])->name('pro-logout');
    Route::get('logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('logout');
});

//-------------------------------------------------------*******--------------------------------------------------
//-------------------------------------------------------*******--------------------------------------------------
//-------------------------------------------------------*******--------------------------------------------------
// ---------------------------------------------New Professional template Start-----------------------------------
Route::post('create-subs', [App\Http\Controllers\ProffController::class,'createSubs'])->name('create-subs');
Route::post('payment-update-make', [App\Http\Controllers\ProffController::class,'updateMake'])->name('payment.update.make');
Route::group(['middleware'=>'prevent-back-history'],function(){
    Route::get('pro-payment',[App\Http\Controllers\ProffController::class,'payment'])->name('pro-payment');
    Route::get('pro-approval',[App\Http\Controllers\ProffController::class,'approval'])->name('pro-approval');
    Route::post('pro-payment-post',[App\Http\Controllers\ProffController::class,'paymentpost'])->name('pro-payment-post');
});
Route::group(['middleware'=>['prevent-back-history','proOnBoard']],function(){
    Route::get('pro-onboarding',[App\Http\Controllers\ProffController::class,'proCompanyProfile'])->name('pro-onboarding');
    Route::post('pro-onboarding-post',[App\Http\Controllers\ProffController::class,'proCompanyProfilePost'])->name('pro-onboarding-post');
});
Route::group(['middleware'=>['prevent-back-history','proffLoginAuth']],function(){
    Route::get('pro-login',[App\Http\Controllers\HomeController::class,"proLogin"])->name('pro-login');
    Route::get('pro-register',[App\Http\Controllers\HomeController::class,"proRegister"])->name('pro-register');
    Route::post('registerpostproff', [App\Http\Controllers\ProffController::class, 'registerpostproff'])->name('proff-register-post');
    Route::post('proff-login-post', [App\Http\Controllers\ProffController::class, 'proff_login_post'])->name('proff-login-post');
      Route::get('forgot-password-proff',[App\Http\Controllers\ProffController::class,"forgotPassword"])->name('forget-password-proff');
	Route::post('forgot-sendmail-proff',[App\Http\Controllers\ProffController::class,"forgotSendMail"])->name('forget-sendmail-proff');
		Route::get('proff/password-reset/{token}',[App\Http\Controllers\ProffController::class,"resetPassword"])->name('password-reset-proff');
	Route::post('proff/password-reset/post',[App\Http\Controllers\ProffController::class,"resetPasswordSave"])->name('password-reset-post-proff');
});
Route::group(['prefix'=>'pro','middleware'=>['prevent-back-history','proffCheck']],function(){

    Route::get('dashboard', [App\Http\Controllers\ProffController::class, 'index'])->name('proff-dashboard');
      Route::get('images', [App\Http\Controllers\ProffController::class, 'Images'])->name('proff-images');
      Route::get('images/delete/{id}', [App\Http\Controllers\ProffController::class, 'ImagesDelete'])->name('proff-images-delete');
      Route::post('images/post', [App\Http\Controllers\ProffController::class, 'ImagesPost'])->name('proff-images-post');  
    Route::get('site-images', [App\Http\Controllers\ProffController::class, 'siteImage']);
     Route::post('site-images/post', [App\Http\Controllers\ProffController::class, 'proSiteImagePost']);
    Route::get('markComplete/{id}',[App\Http\Controllers\ProffController::class, 'markComplete']);
    Route::get('leads', [App\Http\Controllers\ProffController::class, 'leads']);
    Route::get('pro-reject/{id}', [App\Http\Controllers\ProffController::class, 'pro_reject']);
    Route::get('pro-accept/{id}', [App\Http\Controllers\ProffController::class, 'pro_accept']);
    Route::get('profile', [App\Http\Controllers\ProffController::class, 'pro_profile'])->name('pro_profile');
    Route::get('bookings', [App\Http\Controllers\ProffController::class, 'proff_bookings'])->name('proff-bookings');
    Route::get('past-bookings', [App\Http\Controllers\ProffController::class, 'past_bookings'])->name('past-bookings');
     Route::post('profile-update', [App\Http\Controllers\ProffController::class, 'pro_profile_update'])->name('pro_profile_update');
     Route::post('experience-update', [App\Http\Controllers\ProffController::class, 'pro_exp_update'])->name('pro_exp_update');
    Route::match(['get','post'],'proff-documents', [App\Http\Controllers\ProffController::class, 'proff_documents']);
    Route::match(['get','post'],'proff-banking', [App\Http\Controllers\ProffController::class, 'proff_banking'])->name('proff-banking');
    Route::get('proff-availability', [App\Http\Controllers\ProffController::class, 'proff_availability'])->name('proff-availability');
    Route::post('pro-availability-post', [App\Http\Controllers\ProffController::class, 'pro_availability_post'])->name('pro-availability-post');
    Route::get('proff-business', [App\Http\Controllers\ProffController::class, 'proff_business'])->name('proff-business');
    Route::post('pro-business-post',[App\Http\Controllers\ProffController::class,"updateServicesPost"])->name('pro.business.post');
    
    Route::get('pro/business', [App\Http\Controllers\ProffController::class,"updateServices"])->name('pro-business');
    Route::post('pro/busines/save', [App\Http\Controllers\ProffController::class,"updateBusinesPost"])->name('pro.busines.save');
    
    Route::post('checkout',[App\Http\Controllers\ProffController::class,"afterpayment"])->name('checkout.credit-card');
    Route::get('proff-customer-reviews', [App\Http\Controllers\ProffController::class, 'review'])->name('proff-customer-reviews');
    Route::match(['get','post'],'edit-profile', [App\Http\Controllers\ProffController::class, 'edit_profile'])->name('edit-profile');
    Route::get('change-password', [App\Http\Controllers\ProffController::class, 'proff_change_password'])->name('proff-change-password');
    Route::post('proff-change-password-post', [App\Http\Controllers\ProffController::class, 'proff_change_password_post'])->name('proff-change-password-post');
    Route::get('terms-condition', [App\Http\Controllers\ProffController::class, 'terms_condition'])->name('terms-condition');
    Route::get('about', [App\Http\Controllers\ProffController::class, 'about'])->name('about');

    Route::get('booking-details/{id}',[App\Http\Controllers\ProffController::class,"bookingDetail"])->name('probookingDetail');
	Route::post('match',[App\Http\Controllers\ProffController::class,"startServices"]);
	Route::post('verify-otp-start',[App\Http\Controllers\ProffController::class,"verifyStartOtp"])->name('verify-start-otp');
	Route::post('otp-end',[App\Http\Controllers\ProffController::class,"endServices"]);
	Route::post('verify-otp-end',[App\Http\Controllers\ProffController::class,"verifyEndOtp"])->name('verify.end.otp');
    Route::post('cancel-booking',[App\Http\Controllers\ProffController::class,"proCancelBookings"])->name('verify.end.otp');

//     Route::get('estimate',[App\Http\Controllers\ProffController::class,'proestimate'])->name('pro-estimate');
// 	Route::get('estimate/{id}/{id2}',[App\Http\Controllers\ProffController::class,'offerDeatils'])->name('pro-estimate/{id}/{id2}');

//     Route::get('bidding',[App\Http\Controllers\ProffController::class,'proBidding'])->name('pro-bidding');
//     Route::post('bid/update',[App\Http\Controllers\ProffController::class,'proBiddingUpdate'])->name('pro-bid-update');

    Route::get('estimate',[App\Http\Controllers\ProffController::class,'proMultipleEstimate'])->name('multiple-pro-estimate');
    Route::get('direct-assign',[App\Http\Controllers\ProffController::class,'DirectAssign'])->name('DirectAssign');
    Route::get('ongoing-jobs',[App\Http\Controllers\ProffController::class,'ongoing_jobs'])->name('ongoing_jobs');

 


  
    Route::get('estimate/{id}/{id2}',[App\Http\Controllers\ProffController::class,'updateAssignStatus'])->name('pro-multiple-estimate/{id}/{id2}');
    
    Route::get('bidding',[App\Http\Controllers\ProffController::class,'proMestBidding'])->name('pro-multiple-bidding');
    Route::post('bid/update',[App\Http\Controllers\ProffController::class,'proMestBiddingUpdate'])->name('pro-multiple-bid-update');

    Route::get('stripe',[App\Http\Controllers\ProffController::class,'stripe'])->name('pro-stripe');
    Route::post('stripe',[App\Http\Controllers\ProffController::class,'stripepost'])->name('pro-stripe');
    // Route::post('bid/update',[App\Http\Controllers\ProffController::class,'proBiddingUpdate'])->name('pro-bid-update');
    
    
    Route::post('send-notes',[App\Http\Controllers\ProffController::class,'sendNotes']);
    Route::post('msg-customer',[App\Http\Controllers\ProffController::class,'msgCustomer']);
    
    //Messages
    Route::get('messages', [App\Http\Controllers\ProffController::class, 'AdminMessages'])->name('AdminMessages');
    Route::get('messages/delete/{id}', [App\Http\Controllers\ProffController::class, 'AdminMessageDelete'])->name('AdminMessageDelete');
    
    


});


// ---------------------------------------------New Admin template Start------------------------------------------
Route::group(['prefix'=>'admin','middleware'=>['prevent-back-history','adminLoginAuth']],function(){
    Route::get('login', [App\Http\Controllers\AdminControllerNew::class,'login']);//->name('admin-dashboard');
    Route::post('login/post', [App\Http\Controllers\AdminControllerNew::class,'login_post']);//->name('admin-dashboard');
});
Route::group(['prefix'=>'admin','middleware'=>['prevent-back-history','adminBasicAuth']],function(){

    Route::get('dashboard', [App\Http\Controllers\AdminControllerNew::class,'admin_dashboard']);
    // Users
    Route::get('user', [App\Http\Controllers\AdminControllerNew::class, 'user_index']);
    Route::get('delete-user/{id}', [App\Http\Controllers\AdminControllerNew::class, 'user_delete']);
    Route::get('view-user/{id}', [App\Http\Controllers\AdminControllerNew::class, 'user_view']);
    Route::post('user_status', [App\Http\Controllers\AdminControllerNew::class, 'user_status']);
    Route::post('user_state', [App\Http\Controllers\AdminControllerNew::class, 'user_state']);

    // Professional
    Route::get('professional', [App\Http\Controllers\AdminControllerNew::class, 'professional']);
    Route::get('view-professional/{id}', [App\Http\Controllers\AdminControllerNew::class, 'professional_view']);
    Route::get('delete-pro/{id}', [App\Http\Controllers\AdminControllerNew::class, 'professional_delete']);
    Route::get('edit-professional/{id}', [App\Http\Controllers\AdminControllerNew::class, 'professional_edit']);
    Route::post('update-professional', [App\Http\Controllers\AdminControllerNew::class, 'professional_update']);

    //Services
    Route::get('service', [App\Http\Controllers\AdminControllerNew::class, 'service_index']);
    Route::get('view-service/{id}', [App\Http\Controllers\AdminControllerNew::class, 'service_view']);
    Route::get('edit-service/{id}', [App\Http\Controllers\AdminControllerNew::class, 'service_edit']);
    Route::post('update-service', [App\Http\Controllers\AdminControllerNew::class, 'service_update']);
    Route::post('service_status', [App\Http\Controllers\AdminControllerNew::class, 'service_status']);
    Route::get('delete-service/{id}', [App\Http\Controllers\AdminControllerNew::class, 'service_delete']);
    Route::get('add-service', [App\Http\Controllers\AdminControllerNew::class, 'service_add']);
    Route::post('add-service-post', [App\Http\Controllers\AdminControllerNew::class, 'service_add_post']);

    // Bookings
    Route::get('bookings', [App\Http\Controllers\AdminControllerNew::class, 'bookings_index']);
    Route::get('view-booking/{id}', [App\Http\Controllers\AdminControllerNew::class, 'bookings_view']);
    Route::get('bookings/cancel/{id}', [App\Http\Controllers\AdminControllerNew::class, 'bookings_cancel']);
    //custom bookings
    Route::get('CustomBookings', [App\Http\Controllers\AdminControllerNew::class, 'CutomBookings_index'])->name('Custom.bookings');
    Route::get('view-Custombooking/{id}', [App\Http\Controllers\AdminControllerNew::class, 'CustomBookings_view']);
    
    //Messages
     Route::get('messages', [App\Http\Controllers\AdminControllerNew::class, 'ProMessages'])->name('ProMessages');
          Route::get('messages/delete/{id}', [App\Http\Controllers\AdminControllerNew::class, 'ProMessageDelete'])->name('ProMessageDelete');
         Route::get('customer_messages', [App\Http\Controllers\AdminControllerNew::class, 'customerMessage'])->name('customer_messages');


    // Promo
    Route::get('promo', [App\Http\Controllers\AdminControllerNew::class, 'promo_index']);
    Route::get('delete-promo/{id}', [App\Http\Controllers\AdminControllerNew::class, 'promo_delete']);
    Route::get('add-promo', [App\Http\Controllers\AdminControllerNew::class, 'promo_add']);
    Route::post('add-promo-post', [App\Http\Controllers\AdminControllerNew::class, 'promo_add_post']);
    Route::get('view-promo/{id}', [App\Http\Controllers\AdminControllerNew::class, 'promo_view']);
    Route::get('edit-promo/{id}', [App\Http\Controllers\AdminControllerNew::class, 'promo_edit']);
    Route::post('promo-edit-post', [App\Http\Controllers\AdminControllerNew::class, 'promo_edit_post']);
    Route::post('promo_status', [App\Http\Controllers\AdminControllerNew::class, 'promo_status']);

    // Testimonials
    Route::get('testimonials',[App\Http\Controllers\AdminControllerNew::class,'testimonial']);
    Route::get('add-testimonial',[App\Http\Controllers\AdminControllerNew::class,'testimonial_add']);
    Route::post('add-testimonial-post',[App\Http\Controllers\AdminControllerNew::class,'testimonial_add_post']);
    Route::get('view-testimonial/{id}', [App\Http\Controllers\AdminControllerNew::class, 'testimonial_view']);
    Route::get('edit-testimonial/{id}', [App\Http\Controllers\AdminControllerNew::class, 'testimonial_edit']);
    Route::post('edit-testimonial-post', [App\Http\Controllers\AdminControllerNew::class, 'testimonial_edit_post']);
    Route::get('delete-testimonial/{id}', [App\Http\Controllers\AdminControllerNew::class, 'testimonial_delete']);

    // Contact Us
    Route::get('contact',[App\Http\Controllers\AdminControllerNew::class,'contact']);
    Route::get('delete-contact/{id}',[App\Http\Controllers\AdminControllerNew::class,'contact_delete']);
    Route::get('view-contact/{id}',[App\Http\Controllers\AdminControllerNew::class,'view_contact']);

    // Edit Profile
    Route::get('edit-profile', [App\Http\Controllers\AdminControllerNew::class, 'edit_profile']);
    Route::post('edit-profile-post', [App\Http\Controllers\AdminControllerNew::class, 'edit_profile_post']);
    Route::get('change-password', [App\Http\Controllers\AdminControllerNew::class, 'changePassword']);
    Route::post('change-password-post', [App\Http\Controllers\AdminControllerNew::class, 'changePasswordPost']);

    // Blogs
    Route::get('blog',[App\Http\Controllers\AdminControllerNew::class,'blog']);
    Route::match(['get','post'],'add-blog',[App\Http\Controllers\AdminControllerNew::class,'addBlog']);
    Route::get('view-blog/{id}', [App\Http\Controllers\AdminControllerNew::class, 'view_blog']);
    Route::match(['get','post'],'edit-blog/{id}',[App\Http\Controllers\AdminControllerNew::class,'editBlog']);
    Route::get('delete-blog/{id}',[App\Http\Controllers\AdminControllerNew::class,'deleteBlog']);

    //
    Route::get('transaction', [App\Http\Controllers\AdminControllerNew::class, 'transaction_index']);
    Route::get('sales', [App\Http\Controllers\AdminControllerNew::class, 'sales_index']);
    
    
    Route::get('create-custom-booking', [App\Http\Controllers\AdminControllerNew::class, 'createCustomBooking'])->name('admin.createCustom');
    Route::post('create-custom-booking-post', [App\Http\Controllers\AdminControllerNew::class, 'createCustomBookingPost'])->name('admin.createCustomPost');

    // Estimate
    Route::get('multiple-estimate',[App\Http\Controllers\AdminControllerNew::class, 'multipleEstimate']);
    Route::get('create-multiple-estimate',[App\Http\Controllers\AdminControllerNew::class, 'createMultipleEstimate']);
    Route::post('create-multiple-estimate-post',[App\Http\Controllers\AdminControllerNew::class, 'createMultipleEstimatePost']);
    Route::get('multiple-estimate/view/{id}',[App\Http\Controllers\AdminControllerNew::class, 'multipleEstimateView']);
    Route::get('multiple-estimate/edit/{id}',[App\Http\Controllers\AdminControllerNew::class, 'multipleEstimateEdit']);
    Route::post('multiple-estimate/edit-post',[App\Http\Controllers\AdminControllerNew::class, 'multipleEstimateEditPost']);
    Route::get('multiple-estimate/delete/{id}',[App\Http\Controllers\AdminControllerNew::class, 'multipleEstimateDelete']);
    Route::get('services-view/{id}',[App\Http\Controllers\AdminControllerNew::class, 'servicesView']);
    Route::get('service-email-view/{id}/{booking_id}',[App\Http\Controllers\AdminControllerNew::class, 'servicesEmailView']);
    Route::get('assign-service/{id}/{booking_id}',[App\Http\Controllers\AdminControllerNew::class, 'assignService']);
    Route::post('assign-service-post',[App\Http\Controllers\AdminControllerNew::class, 'assignServicePost']);
    
    Route::get('multiple-estimate/service-edit/{id}/{service_id}',[App\Http\Controllers\AdminControllerNew::class, 'multipleEstimateServiceEdit']);
    Route::post('multiple-estimate/service-edit-post',[App\Http\Controllers\AdminControllerNew::class, 'multipleEstimateServiceEditPost']);
    
    Route::get('convertEstimate/{id}',[App\Http\Controllers\AdminControllerNew::class,"convertEstimate"]);
    Route::post('convertEstimate/post',[App\Http\Controllers\AdminControllerNew::class,"convertEstimatePost"]);
    
    Route::get('jobPhotos',[App\Http\Controllers\AdminControllerNew::class, 'jobPhoto']);
    Route::post('siteImgNumber',[App\Http\Controllers\AdminControllerNew::class, 'siteImgNumber']);
    Route::get('History',[App\Http\Controllers\AdminControllerNew::class, 'History']);

    Route::post('Send_Pro_Email',[App\Http\Controllers\AdminControllerNew::class, 'Send_Pro_Email'])->name('Send_Pro_Email');
    
    Route::get('multiple-estimate-bid/{service_id}/{booking_id}',[App\Http\Controllers\AdminControllerNew::class, 'multipleEstimateBidding'])->name('multiple_estimate_bidding');
	Route::post('multiple-bidding-post',[App\Http\Controllers\AdminControllerNew::class, 'multipleBiddingPost'])->name('multiple_bidding_post');
	
	Route::get('/service/details/{id}',[App\Http\Controllers\AdminControllerNew::class, 'view_service_details'])->name('mest_service_details');
	
	Route::get('accept-mest-bid-pro/{id}',[App\Http\Controllers\AdminControllerNew::class, 'acceptMestEstimateBidPost'])->name('acpt_mest_bid');
	Route::get('reject-mest-bid-pro/{id}',[App\Http\Controllers\AdminControllerNew::class, 'rejectMestEstimateBidPost'])->name('rjct_mest_bid');
	
	Route::get('/sales/mestconfirmStatus/{id}',[App\Http\Controllers\AdminControllerNew::class, 'confirmMestStatus_sales'])->name('mestconfirmStatus');
    Route::get('/sales/mestrejectStatus/{id}',[App\Http\Controllers\AdminControllerNew::class, 'rejectMestStatus_sales'])->name('mestrejectStatus');
	
	Route::get('multiple-booking-invoice-view/{id}',[App\Http\Controllers\AdminControllerNew::class, 'admin_multiple_booking_invoice'])->name('multiple-booking-invoice-view');
	
	
	
	Route::get('multiple-estimate-invoice-view/{id}/{booking_id}',[App\Http\Controllers\AdminControllerNew::class, 'admin_multiple_multiple_invoice'])->name('multiple-estimate-invoice-view');
	Route::get('create-multiple-estimate-invoice/{id}',[App\Http\Controllers\AdminControllerNew::class, 'admin_create_multiple_multiple_invoice'])->name('create-multiple-estimate-invoice');
	Route::post('create-multiple-estimate-invoice-post',[App\Http\Controllers\AdminControllerNew::class, 'admin_create_multiple_multiple_invoice_post'])->name('create-multiple-estimate-invoice-post');
	
	
	Route::post('msg-pro',[App\Http\Controllers\AdminControllerNew::class,'msgPro']);
	
	
	//Pro Data
    Route::get('pro-data', [App\Http\Controllers\AdminControllerNew::class, 'proData']);
    Route::get('pro-data/details/{id}', [App\Http\Controllers\AdminControllerNew::class, 'ProDataDetails']);
    Route::get('pro-data/delete/{id}', [App\Http\Controllers\AdminControllerNew::class, 'ProDataDelete'])->name('ProDataDelete');



    //User Data
    Route::get('users-data', [App\Http\Controllers\AdminControllerNew::class, 'userData']);
    Route::get('users-data/details/{id}', [App\Http\Controllers\AdminControllerNew::class, 'userDataDetails']);
    Route::get('users-data/delete/{id}', [App\Http\Controllers\AdminControllerNew::class, 'userDataDelete'])->name('userDataDelete');
    Route::get('users-data/index', [App\Http\Controllers\AdminControllerNew::class, 'userData_index'])->name('userData_index');
  
    
    //Service Calls
    Route::get('service-calls', [App\Http\Controllers\AdminControllerNew::class, 'serviceCalls']);
    
    //Job Photos Approval 
    Route::get('update-img-approval/{id}', [App\Http\Controllers\AdminControllerNew::class, 'jobPhotosApproval']);
    Route::get('service-details/{id}', [App\Http\Controllers\AdminControllerNew::class, 'ServiceDetails']);
    Route::post('photo_requirement_post', [App\Http\Controllers\AdminControllerNew::class, 'photoRequirementPost']);
    Route::get('mark-complete/{id}', [App\Http\Controllers\AdminControllerNew::class, 'markComplete']);
    Route::get('admin-mark-complete/{id}', [App\Http\Controllers\AdminControllerNew::class, 'adminMarkComplete']);
    Route::get('admin_mark_completed_notes', [App\Http\Controllers\AdminControllerNew::class, 'adminCompletednotes'])->name('admin_mark_completed_notes');
Route::get('delete-requirement', [App\Http\Controllers\AdminControllerNew::class, 'delRequirementDetails'])->name('delete-requirement');
    Route::get('fetchData', [App\Http\Controllers\AdminControllerNew::class, 'updateAndReturn'])->name('fetchData');
 Route::get('photo_requirement_get', [App\Http\Controllers\AdminControllerNew::class, 'photoRequirementGet'])->name('photo_requirement_get');
    
    // Bookings New
    Route::get('bookings/listing', [App\Http\Controllers\AdminControllerNew::class, 'bookings_index_new']);
    Route::get('view-booking/single/{id}', [App\Http\Controllers\AdminControllerNew::class, 'bookings_view_new']);
    Route::get('bookings/cancel/single/{id}', [App\Http\Controllers\AdminControllerNew::class, 'bookings_cancel_new']);
    
    // Estimate
    Route::get('estimate/listing', [App\Http\Controllers\AdminControllerNew::class, 'estimate_index_new']);


});
// ---------------------------------------------New Admin template END--------------------------------------------

Route::get('multiple-estimate-invoice-view-online/{id}/{booking_id}',[App\Http\Controllers\AdminControllerNew::class, 'admin_multiple_multiple_invoice_online'])->name('multiple-estimate-invoice-view-online');
Route::post('multiple-estimate-invoice-view-online-payment-post/{id}/{booking_id}',[App\Http\Controllers\AdminControllerNew::class, 'admin_multiple_multiple_invoice_online_payment_post'])->name('multiple-estimate-invoice-view-online-payment-post');
Route::get('invoiceTransactionSuccessfull/{id}/{booking_id}',[App\Http\Controllers\AdminControllerNew::class,'invoiceReceipt'])->name('invoiceTransactionSuccessfull');


// multiple estimate

Route::get('multiple-booking-invoice/{id}',[App\Http\Controllers\AdminControllerNew::class, 'multiple_booking_invoice'])->name('multiple-booking-invoice');
Route::get('paying-status', [App\Http\Controllers\AdminControllerNew::class, 'payingStatus'])->name('paying_status');

Route::get('online-pay-multiple-estimate/{id}',[App\Http\Controllers\AdminControllerNew::class, 'mest_pay'])->name('online-pay-multiple-estimate');

Route::post('multiple-estimate-payment-done/{id}',[App\Http\Controllers\AdminControllerNew::class, 'mest_pay_post'])->name('multiple-estimate-payment-done');
Route::get('multipleinvoicetransactionSuccessfull/{id}',[App\Http\Controllers\AdminControllerNew::class, 'estimate_invoice'])->name('multipletransactionSuccessfull');


// landing pages

Route::get('pro-landing', [App\Http\Controllers\HomeController::class,'proLanding'])->name('pro_landing');
Route::post('pro-landing-post', [App\Http\Controllers\HomeController::class,'proLandingPost'])->name('pro_landing_post');


Route::get('user-landing', [App\Http\Controllers\HomeController::class,'userLanding'])->name('user_landing');
Route::post('user-landing-post', [App\Http\Controllers\HomeController::class,'userLandingPost'])->name('user_landing_post');
Route::get('user-landing/details', [App\Http\Controllers\HomeController::class,'userLanding_Second_Step'])->name('user_landing_details');
Route::post('user-landing/details-post', [App\Http\Controllers\HomeController::class,'userLanding_Second_Step_Post'])->name('user_landing_Second_Step_Post');
Route::get('user-landing/final/step', [App\Http\Controllers\HomeController::class,'user_landing_Thirdstep'])->name('user_landing_Thirdstep');
Route::get('user-landing/AccountSetup', [App\Http\Controllers\HomeController::class,'AccountSetup'])->name('user_landing_AccountSetup');


Route::get('mississauga-pro-profile/{id}', [App\Http\Controllers\HomeController::class,'proProfile']);



//-------------------------------------------------------*******--------------------------------------------------
//-------------------------------------------------------*******--------------------------------------------------
//-------------------------------------------------------*******--------------------------------------------------
