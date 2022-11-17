@extends('website.layouts.master')
@section('after-style')
<style type="text/css">
   .pro_image{
         height: auto   ;
         background-image:url("{{asset('theme/images/row-bgimage-11.jpg')}}");
         background-repeat: no-repeat;
         background-size: cover;
         background-position: center;

    }

    .card_pro{
    border-radius: 3px;
 
    border: none;
    margin: 35px;
    }
    .login_form_pro {
    padding: 6% 11%;
    background: #13121242;
    margin: 15px;
        width: 99%;
     }
    .img-fluid-pro {
        max-width: 100%;
        height: auto;
        margin: 14%;
    }

    img.advantage-icon {
        height: 100px;
    }
    .pro_user_form {
      padding-bottom: 0px;
    }

</style>
@endsection
@section('content')
<div class="container-fluid" style="padding-top:160px;">
<div class="row home_slider_image pro_image" >
   <div class="col-md-4">
       <div class="ttm_single_image-wrapper mb-35">
         <img class="img-fluid-pro" src="{{asset('theme/images/single-img-eight.png')}}" alt="">
                        </div>

   </div>
   <div class="col-md-8">
      <div class="pro_user_form">
      <div class="container">
         <div class="row">
            <div class="col-md-1">
              
            </div>
            <div class="col-md-10 card_pro">
               <div class="login_form_pro">
                  <h4 class="text-center pro_login_title" style="margin-bottom: 5%;">SIGN UP FOR  PRO USER ACCOUNT</h4>
                   @if (session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
                  @if (session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif
                  <form method="POST" action="{{route('pro-register-post')}}" name="register" id="register">
                     @csrf

                     <fieldset>
                        <div class="row">
                           <div class="col-6">
                              <div class="form-group">
                                 <h5 class="pull-center form-title" >FULL NAME</h5>
                                 <input type="text" name="first_name" id="first_name" class="form-control input-box" placeholder="Full Name">
                              </div>
                           </div>
                           <div class="col-6 text-left">
                              <div class="form-group">
                                 <h5 class="pull-center form-title" >LAST NAME</h5>
                                 <input type="text" name="last_name" id="last_name" class="form-control input-box" placeholder="Last Name">
                              </div>
                           </div>

                        </div>
                        <div class="row">
                           <div class="col-6">
                              <div class="form-group">
                                 <h5 class="pull-center form-title" >EMAIL</h5>
                                 <input type="text" name="email" id="email" class="form-control input-box" placeholder="Email">
                              </div>
                           </div>
                           <div class="col-6 text-left">
                              <div class="form-group">
                                 <h5 class="pull-center form-title" >PHONE NUMBER</h5>
                                 <input type="text" name="phone_no" id="phone_no" class="form-control input-box" placeholder="Phone Number">
                              </div>
                           </div>
                        </div>
						
						 <div class="row">
                           <div class="col-6">
                              <div class="form-group">
                                 <h5 class="pull-center form-title" >TRADE OCCUPATION</h5>
                                 <input type="text" name="trade_occupation" id="trade_occupation" class="form-control input-box" placeholder="TRADE OCCUPATION">
                              </div>
                           </div>
                           <div class="col-6 text-left">
                              <div class="form-group">
                                 <h5 class="pull-center form-title" >Business Address</h5>
                                 <input type="text" name="professional_availability" id="professional_availability" class="form-control input-box" placeholder="BUSINESS ADDRESS">
                              </div>
                           </div>

                        </div>
						
                        <div class="row">
                           <div class="col-6">
                              <div class="form-group">
                                 <h5 class="pull-center form-title" >PASSWORD</h5>
                                 <input type="password" name="password" id="password" class="form-control input-box" placeholder="Password">
                              </div>
                           </div>
                           <div class="col-6 text-left">
                              <div class="form-group">
                                 <h5 class="pull-center form-title" >CONFIRM PASSWORD</h5>
                                 <input type="password" name="confirm_password" id="confirm_password" class="form-control input-box" placeholder="Confirm Password">
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                                 <div class="form-check">
                                    <input class="form-check-input" name="terms" id="terms" type="checkbox">
                                    <label class="form-check-label">By signing up with MeinHaus, you are agreeing to Meinhaus <a href="{{url('termsandconditions')}}"><u> Terms and Conditions</u></a></label>
                                 </div>
                                 <label style="color: red;">
                                 <label id="terms-error" class="error" for="terms" style="display: inline-block;"></label></label>
                              </div>
                        <div>
                           <input type="submit" class="btn btn-md btn-primary btn-block" value="SIGN UP">
                        </div>
                     </fieldset>
                  </form>
               </div>
            </div>
            <div class="col-md-1"></div>
         </div>
      </div>
   </div>
      
   </div>

</div>

</div>
<!--services2-section end
        <section class="ttm-row services2-section clearfix"> -->
            <div class="container" >
                <!-- row -->
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <!-- section title -->
                        <div class="section-title with-desc title-style-center_text clearfix">
                            <div class="title-header">
                                <h2 class="title">Here's why you should sign up:</h2>
                            </div>
                            <!-- section title end -->
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="featured-icon-box style9 text-left">
                            <div class="featured-icon">
                                   <img class="advantage-icon" src="{{asset('theme/images/network-b27c9403ff96c1a4764b818a30b38c9b315fdca8a56067264ffbf0f1b1a5e7fa.png')}}">
                            </div>
                            <div class="featured-content">
                                <div class="featured-title">
                                    <h5>ACCESS OUR NETWORK</h5>
                                </div>
                                <div class="featured-desc">
                                    <p>With 24 job categories, MeinHaus acts as a one stop shop for all our clients' home maintenance needs. Our promise to deliver quality professionals from reputable companies keep them coming back!</p>
                                </div>
                            </div>
                           </div>
                    </div>
                    <div class="col-md-3">
                        <div class="featured-icon-box style9 text-left">
                            <div class="featured-icon">
                             <img class="advantage-icon" src="{{asset('theme/images/alert-c3c91c39eb2d36f10820576a8f1611d4db3aa1fc587db0c04a8f0ede7e844d60.png')}}">   
                            </div>
                            <div class="featured-content">
                                <div class="featured-title">
                                    <h5>JOB ALERTS TO YOUR PHONE</h5>
                                </div>
                                <div class="featured-desc">
                                    <p>Instead of sending leads, MeinHaus notifies you of firm jobs from clients in need of your services. Each customer already has their credit card information on file and you'll never have to compete with multiple quotes as all MeinHaus jobs follow a straightforward rate card.</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="featured-icon-box style9 text-left">
                            <div class="featured-icon">
                                <img class="advantage-icon" src="{{asset('theme/images/invoice-85dfafae54bea15fc2c790259e5d27c11b8f6b90850dd1e1d45b8e033e93b7ab.png')}}">
                            </div>
                            <div class="featured-content">
                                <div class="featured-title">
                                    <h5>EFFORTLESS INVOICING</h5>
                                </div>
                                <div class="featured-desc">
                                    <p>After the job is complete, simply enter the job details in the app, and an invoice is automatically generated with their payment deposited to your account 4 days later.</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="featured-icon-box style9 text-left">
                            <div class="featured-icon">
                               <img class="advantage-icon" src="{{asset('theme/images/fees-dc8948721bd1feb5317fa9f9fea3f69302f869e9bfc503ec627d63a9de7620cc.png')}}">
                            </div>
                            <div class="featured-content">
                                <div class="featured-title">
                                    <h5>NO UPFRONT FEES</h5>
                                </div>
                                <div class="featured-desc">
                                    <p>It's absolutely free to join the platform - MeinHaus only takes a nominal percentage of each job you bill through, so you only pay for jobs you choose to take on</p>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
               
            </div>
         </div>

@endsection