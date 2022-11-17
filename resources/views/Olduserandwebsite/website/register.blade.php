@extends('website.layout.layout')

@section('content')
<div class="site-main" style="margin-top: 163px;">
    <div class="pro_user_form" style="background-image: linear-gradient(#fff, #adada357);">
       <div class="container">
          <div class="row">
             <div class="col-md-1"></div>
             <div class="col-md-10 card">
                <div class="login_form">
                   <h2 class="text-center pro_login_title" style="margin-bottom: 5%;">CREATE YOUR ACCOUNT TO GET STARTED</h2>
                  <form method="POST" action="{{route('user_register')}}">
                     @csrf 
                     @if(\Session::has('success'))
                        <div class="alert alert-success">
                           {{\Session::get('success')}}
                        </div>
                     @endif
                     {!! session()->get('error') !!}
                     @if(Session::has('message'))
                        <p    class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                     @endif  
                     @if ($errors->any())
                        <div class="alert alert-danger">
                           <ul>
                                 @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                 @endforeach
                           </ul>
                        </div>
                     @endif
                      <div class="row">
                            <div class="col-6">
                               <div class="form-group">
                                  <h5 class="pull-center form-title" >FIRST NAME</h5>
                                  <input type="text" name="first_name" id="first_name" class="form-control input-box" placeholder="First Name">
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
                                     <label class="form-check-label">By signing up with MeinHaus, you are agreeing to Meinhaus <a href="http://meinhausca.com/public/termsandconditions"><u> Terms and Conditions<u></a></label>
                                  </div>
                                  <label style="color: red;">
                                  <label id="terms-error" class="error" for="terms" style="display: inline-block;"></label></label>
                               </div>
                         <div>
                            <input type="submit" class="btn btn-md btn-primary btn-block" value="SIGN UP">
                         </div>
                
                   </form>
                </div>
             </div>
             <div class="col-md-1"></div>
          </div>
       </div>
    </div>
 </div>

@endsection
