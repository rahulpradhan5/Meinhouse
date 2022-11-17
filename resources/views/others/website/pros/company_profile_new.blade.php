@extends('website.layouts.master')
@section('after-style')
<!--multiform-->
<style>
* {
	margin: 0;
	padding: 0
}
html {
	height: 100%
}
button.btn.btn-default {
    background: white!important;
    color: black!important;
}
.hidden{
	display: none;
}
.simplepicker-btn:hover {
    color: #000!important;
    }
 input#date {
    padding: 3px;
    width: 96%;
    font-size: 17px;
    font-family: Raleway;
    border: 2px solid #aaaaaa;
    color: black;
}
#grad1 {
 background-color: : #9C27B0;
	background-image: linear-gradient(120deg, #1e9bd0, #1096d4);
	margin-top: 6%;
}
#msform fieldset .form-card-one {
	background: none !important;
	border: 0 none;
	border-radius: 0px;
	box-shadow: none !important;
	padding: 20px 40px 30px 40px;
	box-sizing: border-box;
	width: 94%;
	margin: 0 3% 20px 3%;
	position: relative;
}
#msform {
	text-align: center;
	position: relative;
	margin-top: 20px
}
#msform fieldset .form-card {
	border: 1px solid #E9E9E9;
	border-radius: 0px;
	background-color: #fff;
	padding: 20px 40px 30px 40px;
	box-sizing: border-box;
	width: 100%;
	/* margin: 0 3% 20px 3%; */
	position: relative;
}
#msform fieldset {
	background: white;
	border: 0 none;
	border-radius: 0.5rem;
	box-sizing: border-box;
	width: 100%;
	float: left;
	height: 500px;
	margin: 0;
	overflow-y: scroll;
	padding-bottom: 20px;
	position: relative;
}
#msform fieldset{
  scrollbar-color:#000 !important;
}
#msform fieldset:not(:first-of-type) {
	display: none
}
#msform fieldset .form-card {
	text-align: left;
	color: #9E9E9E;
}
#msform input, textarea {
	padding: 15px 8px 4px 8px;
	border: none;
	border-bottom: 1px solid #ccc;
	border-radius: 0px;
	margin-bottom: 25px;
	margin-top: 2px;
	font-weight: bold;
	width: 100%;
	/* box-sizing: border-box; */
	font-family: "Poppins", Arial, Helvetica, sans-serif;
	color: #2C3E50;
	font-size: 12px;
	letter-spacing: 1px;
	letter-spacing:1px;
}

#msform input[placeholder], [placeholder], *[placeholder] {
    color: #000 !important;
}

#msform .new-radio {
	/* padding-top: 39% !important; */
	position: relative;
	/* top: 55%; */
	/* float: left; */
	width: 44%;
	/* flex-direction: row; */
	/* flex-wrap: wrap; */
	/* display: flex !important; */
	/* display: flex; */
	margin: 5px;
	margin-top: 4%;
}
#msform .new-radio-1 {/* padding-top: 39% !important; */
	position: relative;
	top: 52%;/* padding-left: 16%; */
	float: left;
	left: 27%;
	display: flex;
	margin: 0;/* margin-top: 6%; */
}
#msform .small-width {
	padding: 0px 8px 4px 8px;
	border: none;
	border-bottom: 1px solid #ccc;
	border-radius: 0px;
	margin-bottom: 25px;
	margin-top: 2px;
	width: 100%;
	box-sizing: border-box;
		font-family: "Poppins", Arial, Helvetica, sans-serif;
	color: #2C3E50;
	font-size: 12px;
	letter-spacing: 1px;
}
#msform input:focus, #msform textarea:focus {
	-moz-box-shadow: none !important;
	-webkit-box-shadow: none !important;
	box-shadow: none !important;
	border: none;
	font-weight: bold;
	border-bottom: 2px solid skyblue;
	outline-width: 0;
	color:#000;
}
.text-head {
	/* float: left; */
	/* width: 83%; */
	text-align: center;
	font-size: 13px;
	line-height: 20px;
}
#msform .action-button {
	width: 142px;
	background: #1e9bd0;
	font-weight: bold;
	color: white;
	border-radius: 4px;
	/* border-radius: 0px; */
    /* border-radius: 0px; */
	cursor: pointer;
	padding: 10px 5px;
	margin: 10px 5px;
}
#msform .action-button:hover, #msform .action-button:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
}
button {
	background-color: #fdc13a !important;
	border: 1px solid #e0dada !important;
}
#msform .action-button-previous {
	width: 100px;
	background: #616161;
	font-weight: bold;
	color: white;
	border: 0 none;
	border-radius: 0px;
	cursor: pointer;
	padding: 10px 5px;
	margin: 10px 5px
}
#msform .action-button-previous:hover, #msform .action-button-previous:focus {
	box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
}
select {
	float: left;
	font-family: inherit;
	-webkit-transition: border linear .2s, box-shadow linear .2s;
	font-family: monospace;
	margin-bottom: 4%;
	-moz-transition: border linear .2s, box-shadow linear .2s;
	-o-transition: border linear .2s, box-shadow linear .2s;
	transition: border linear .2s, box-shadow linear .2s;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 0;
	vertical-align: middle;
	width: 100%;
	color: #dedede;
	padding: 9px 0px;
	/* margin-right: 7%; */
	border: #fff;
	font-weight: bold !important;
	background-color: none;
	text-transform: inherit;
	border-bottom: 1px solid #dedede;
	font-size: 15px;
	outline: none;
	line-height: inherit;
}
#msform .side-radio {
	position: relative;
	display: flex;
	right: 43%;
	margin: 0px;
	top: 21%;
	
}
.para-align {
	/* float:left; */
	text-align: justify;
	clear: both;
	line-height: 25px;
	padding-left: 17%;
	font-size: 12px;
	padding-top: 7px;
	padding-top: -6% !important;
	padding-bottom: -1%;
}
.para-align-1 {
	/* float:left; */
	text-align: justify;
	clear: both;
	line-height: 25px;
	padding-left: 8%;
	font-size: 12px;
	padding-top: 7px;
	margin: 0;
	padding-top: -6% !important;
	padding-bottom: -1%;
}
select.list-dt {
	border: none;
	outline: 0;
	border-bottom: 1px solid #ccc;
	padding: 2px 5px 3px 5px;
	margin: 2px
}
.left-form {
	float:left;
	position: relative;
	width: 100%;
	/* left: -37px; */
	right: 6%;
	padding-top: 0%;
}
.top-form-head {
	float: left;
	margin: 0px;
	line-height: 21px;
	font-size: 13px;
	/* width: 100%; */
	padding-bottom: -5%;
	/* margin-top: -4%; */
		/* margin-bottom: 1%; */
	padding-top: -14% !important;
	padding-top: -10% !important;
	padding-left: 17%;
}
.service {
	float: left;
	min-height: 0px;
	border-radius: 3px;
	width: 100%;
	border: 1px solid #a09e9e3b;
}
.border {
	float: left;
	height: 33px;
	width: 33px;
	border-radius: 60px;
	padding-top: 1px;
	margin-top: 5px;
	margin-left: 3px;
	background-color: #ffa500;
	color: #fff;
}
.side-right {
	float: left;
	font-size: 14px;
	padding-top: 11px;
	padding-left: 6px;
	margin: 0;
}
#msform .small-width-main {
	float: left;
	width: 60%;
	margin-left: 6%;
	/* margin: 0; */
	margin-top: 6px;
}
select.list-dt:focus {
	border-bottom: 2px solid skyblue
}
.card {
	z-index: 0;
	border: none;
	border: 8px solid #f99024;
	border-radius: 0.5rem;
	position: relative;
}
.fs-title {
	font-size: 25px;
	color: #2C3E50;
	margin-bottom: 10px;
	font-weight: bold;
	text-align: left
}
.fs-title-1 {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: center;
}
#progressbar {
	margin-bottom: 30px;
	overflow: hidden;
	color: lightgrey;
	padding: 0;
}
#progressbar .active {
	color: #000000
}
#progressbar li {
	list-style-type: none;
    font-size: 12px;
    width: 33.3%;
    float: left;
    position: relative;
}
#progressbar #account:before {
	font-family: FontAwesome;
	content: "\f023"
}
#progressbar #personal:before {
	font-family: FontAwesome;
	content: "\f007"
}
#progressbar #payment:before {
	font-family: FontAwesome;
	content: "\f09d"
}
#progressbar #confirm:before {
	font-family: FontAwesome;
	content: "\f00c"
}
#progressbar li:before {
	width: 50px;
	height: 50px;
	line-height: 45px;
	display: block;
	font-size: 18px;
	color: #ffffff;
	background: lightgray;
	border-radius: 50%;
	margin: 0 auto 10px auto;
	padding: 2px
}
#progressbar li:after {
	content: '';
	width: 100%;
	height: 2px;
	background: lightgray;
	position: absolute;
	left: 0;
	top: 25px;
	z-index: -1
}
#progressbar li.active:before, #progressbar li.active:after {
	background: #1e9bd0;
}
.radio-group {
	position: relative;
	margin-bottom: 25px
}
.radio {
	display: inline-block;
	width: 204;
	height: 104;
	border-radius: 0;
	background: lightblue;
	box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
	box-sizing: border-box;
	cursor: pointer;
	margin: 8px 2px
}
.radio:hover {
	box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
}
.radio.selected {
	box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
}
.fit-image {
	width: 100%;
	object-fit: cover
}
/***********************btn checkbox**************/
*:focus {
	outline: none !important;
}
.input-group-btn .btn {
	width: 100%;
}
:not(:first-child):not(:last-child).input-group-btn.button-checkbox .btn {
	border-radius: 0px;
}
label {
    color: #484444 !important;
}
.side-label{
  font-size: 12px;
  text-align: center;
  display: block;
  /* float: left; */
  font-weight: 400;
  /* padding-left: 3%; */
  letter-spacing: 1px;
  color: #000000 !important;
 }


</style>
@endsection
@section('content')

<div class="section-title ">
    <div class="title-header">
      <h2 class="title">Become a MEINHAUS Pro</h2>
    </div>
</div>
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
      <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
          <h2><strong style="font-size:20px;">Setup your Mein Haus company profile</strong></h2>
          <p>Fill all form field to go to next step</p>
          <div class="row">
            <div class="col-md-12 mx-0">
                <form id="msform" name="msform" action="{{route('pro-onboarding-post')}}" method="POST" enctype="multipart/form-data">
   @csrf
   <h3></h3>
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
                  
                  
                <!-- progressbar -->
                <ul id="progressbar">
                  <li class="active" id="account"><strong>Business Listing</strong></li>
                  <li id="personal"><strong>Add working hours</strong></li>
                  <li id="payment"><strong>Payment</strong></li>
                </ul>
                <!-- fieldsets -->
               
                <fieldset>
                  <div class="form-card">
                    <h2 class="fs-title">Business Listing</h2>
                    <div class="col-md-12 pl-0">
                      <input type="company_name" name="company_name" placeholder="Company Name" id="company_name" />
                      <span id="err_company_name" class="text-danger text-left"></span>
                    </div>
                    <div class="col-md-12 pl-0">
                      <input type="text" name="business_address" placeholder="Full Business Address" id="business_address" />
                      <span id="err_business_address" class="text-danger text-left"></span>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <input type="text" name="city" id="city" placeholder="City" class="small-width" />
                        <span id="err_city" class="text-danger text-left"></span>
                      </div>
                      <div class="col-md-6">
                        <input type="text" name="province" id="province" placeholder="Provience" class="small-width" />
                        <span id="err_province" class="text-danger text-left"></span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <input type="text" name="postal_code" id="postal_code" placeholder="Postal Code" class="small-width" />
                        <span id="err_postal_code" class="text-danger text-left"></span>
                      </div>
                      <div class="col-md-6">
                        <input type="text"  placeholder="Business Phone Number" class="small-width" name="phone_no" id="phone_no" />
                        <span id="err_phone_no" class="text-danger text-left"></span>
                      </div>
                    </div>
                
                    
          
            
                     <div class="form-group">
                        <span id="err_service" class="text-danger text-left"></span>
                        <b>Services</b>
                         <select class="js-example-responsive" name="services[]" id="services" multiple placeholder="Choose Services" required>
                            @foreach($services as $key => $service)  
                            <option id="ser_{{$key}}" value="{{$service->id}}">{{$service->name}}</option>
                            @endforeach
                        </select>
                      
                    </div>
            
                    <span id="err_abt_services" class="text-danger text-left"></span>
                    <input type="text" name="abt_services" id="abt_services" placeholder="Tell us about your services (50 words max)" />
                    
                    <span id="err_experience" class="text-danger text-left"></span>
                    <input type="text" name="experience" id="experience" placeholder="Experience (In Years)" />
                    
                    
                    
                    
                    <label>How many kilometers You are willing to travel to <br>
                      provide service from home.</label>
                    <input type="text" name="distance" id="distance" placeholder="E.g 10 Kms" />
                    <span id="err_distance" class="text-danger text-left"></span>
                    
                    <div class="row">
                      <label style="padding-left:2%;">Do You Own and operate your own vehicle that you can get two projects with</label>
                      
                      <div class="col-md-6">
                        <input type="radio" id="yes" name="vehicle_owner" value="1" checked="" class="new-radio">
                        Yes </div>
                      <div class="col-md-6">
                        <input type="radio" id="no" name="vehicle_owner" value="0" class="new-radio">
                        No </div>
                    </div>
                    <div class="col-md-12 mt-4">
                      <div class="row">
                        <div class="left-form">
                          <input type="checkbox" name="vehicle1" id="vehicle21" value="Bike" class="side-radio">
                          
                          <label>
                         
                          <h6 class="top-form-head">Terms and Uses</h6>
                           <p id="err_vehicle21" class="text-danger text-left"></p>
                          <p class="para-align">By checking this box you represent and warrant that you hold all the required or industry standard.</p>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="left-form">
                          <input type="checkbox" name="vehicle2" id="vehicle22" value="Bike" class="side-radio">
                          
                          <label>
                          
                          <h6 class="top-form-head">Terms and Conditions for logistics services and payment services<br>
                            service and payment services</h6>
                          <p id="err_vehicle22" class="text-danger text-left"></p>
                          <p class="para-align">If you have any question, email jerry at info@meinhaus.ca or text him at (+1)6479-309-066</p>
                          <p class="para-align">For monthly membership charge $49.99<br>
                          For additional service charge $28.99<br>
                          For yearly membership charge $250.00<br>
                          For additional yearly service charge $143.00</p>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--<input type="button" name="next" class="next action-button" value="Save & Next" />-->
                  <input type="hidden" name="next" id="next1" class="next action-button mt-4" value="Save & Next" />
                  <input type="button"  onclick="return validate();" class="action-button " value="Next" />
                </fieldset>
                
                
                
                
                <fieldset>
                  <div class="form-card">
                    <h2 class="fs-title-1">Add Working Hours</h2>
                    <label class="side-label">Select Your Day Availabliity</label>
                    <div class="row">
                      <div class="col-md-6">
                        <input type="radio" id="customRadio1" name="all_day" checked="" class="new-radio">
                        Enter Hours </div>
                      <div class="col-md-6">
                        <input type="radio" id="all_day" name="all_day" class="new-radio">
                        Open all days </div>
                    </div>

                   <div class="col-md-12 mt-4">
                      <h5>Monday</h5>
                      <span id="err_monday" class="text-danger text-left"></span>
                      <div class="row">
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>
                          <input type="checkbox" id="monday" value="mon_1" name="monday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>
                          <input type="checkbox" value="mon_2" name="monday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>
                          <input type="checkbox" value="mon_3" name="monday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>
                          <input type="checkbox" value="mon_4" name="monday[]" class="hidden availability"  />
                          </span> </div>
                      </div>
                    </div>
                    <div class="col-md-12 mt-4">
                      <h5>Tuesday</h5>
                       <span id="err_tuesday" class="text-danger text-left"></span>
                      <div class="row">
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>
                          <input type="checkbox" value="mon_1" name="tuesday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>
                          <input type="checkbox" value="mon_2" name="tuesday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>
                          <input type="checkbox" value="mon_3" name="tuesday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>
                          <input type="checkbox" value="mon_4" name="tuesday[]" class="hidden availability"  />
                          </span> </div>
                      </div>
                    </div>
                    <div class="col-md-12 mt-4">
                      <h5>Wednesday</h5>
                       <span id="err_wednesday" class="text-danger text-left"></span>
                      <div class="row">
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>
                          <input type="checkbox" value="mon_1" name="wednesday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>
                          <input type="checkbox" value="mon_2" name="wednesday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>
                          <input type="checkbox" value="mon_3" name="wednesday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>
                          <input type="checkbox" value="mon_4" name="wednesday[]" class="hidden availability"  />
                          </span> </div>
                      </div>
                    </div>
                    <div class="col-md-12 mt-4">
                      <h5>Thursday</h5>
                       <span id="err_thrusday" class="text-danger text-left"></span>
                      <div class="row">
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>
                          <input type="checkbox" value="mon_1" name="thursday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>
                          <input type="checkbox" value="mon_2" name="thursday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>
                          <input type="checkbox" value="mon_3" name="thursday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>
                          <input type="checkbox" value="mon_4" name="thursday[]" class="hidden availability"  />
                          </span> </div>
                      </div>
                    </div>
                    <div class="col-md-12 mt-4">
                      <h5>Friday</h5>
                       <span id="err_friday" class="text-danger text-left"></span>
                      <div class="row">
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>
                          <input type="checkbox" value="mon_1" name="friday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>
                          <input type="checkbox" value="mon_2" name="friday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>
                          <input type="checkbox" value="mon_3" name="friday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>
                          <input type="checkbox" value="mon_4" name="friday[]" class="hidden availability"  />
                          </span> </div>
                      </div>
                    </div>
                    <div class="col-md-12 mt-4">
                      <h5>Saturday</h5>
                       <span id="err_saturday" class="text-danger text-left"></span>
                      <div class="row">
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>
                          <input type="checkbox" value="mon_1" name="saturday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>
                          <input type="checkbox" value="mon_2" name="saturday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>
                          <input type="checkbox" value="mon_3" name="saturday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>
                          <input type="checkbox" value="mon_4" name="saturday[]" class="hidden availability"  />
                          </span> </div>
                      </div>
                    </div>
                    <div class="col-md-12 mt-4">
                      <h5>Sunday</h5>
                       <span id="err_sunday" class="text-danger text-left"></span>
                      <div class="row">
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">08:00-11:00AM</button>
                          <input type="checkbox" value="mon_1" name="sunday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">11:00-02:00PM</button>
                          <input type="checkbox" value="mon_2" name="sunday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">02:00-05:00PM</button>
                          <input type="checkbox" value="mon_3" name="sunday[]" class="hidden availability"  />
                          </span> </div>
                        <div class="input-group col-md-3"> <span class="button-checkbox input-group-btn">
                          <button type="button" class="btn" data-color="primary">05:00-08:00PM</button>
                          <input type="checkbox" value="mon_4" name="sunday[]" class="hidden availability"  />
                          </span> </div>
                      </div>
                    </div>
                  </div>
                  <input type="submit" onclick="return validate4();" class="action-button" value="Finish" />
                </fieldset>
                
                
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<!--multistep jquery--> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script> -->
<!--multistep form--> 
<script>
   $(document).ready(function() {
    $('.js-example-responsive').select2({
    placeholder: "Select services",
    allowClear: true,
    width: 'resolve',
    theme: "classic"
});
});
</script>

<script>
    function validate() 
    {
        if(jQuery('#company_name').val() == "" ) {
			jQuery('#err_company_name').html( "Please Enter Company Name" );
            jQuery('#company_name').focus() ;
		    setTimeout(function(){jQuery('#err_company_name').html(''); }, 4000);
		    return false;
        }
        else
		{
			jQuery('#err_company_name').html('');
		}
		
		if(jQuery('#business_address').val() == "" ) {
			jQuery('#err_business_address').html( "Please Enter Business Address" );
            jQuery('#business_address').focus() ;
		    setTimeout(function(){jQuery('#err_business_address').html(''); }, 4000);
		    return false;
        }
        else
		{
			jQuery('#err_business_address').html('');
		}
		
		if(jQuery('#city').val() == "" ) {
			jQuery('#err_city').html( "Please Enter City Name" );
            jQuery('#city').focus() ;
		    setTimeout(function(){jQuery('#err_city').html(''); }, 4000);
		    return false;
        }
        else
		{
			jQuery('#err_city').html('');
		}
		
		if(jQuery('#province').val() == "" ) {
			jQuery('#err_province').html( "Please Enter Province Name" );
            jQuery('#province').focus() ;
		    setTimeout(function(){jQuery('#err_province').html(''); }, 4000);
		    return false;
        }
        else
		{
			jQuery('#err_province').html('');
		}
		
		
		if(jQuery('#postal_code').val() == "" ) {
			jQuery('#err_postal_code').html( "Please Enter Postal Code" );
            jQuery('#postal_code').focus() ;
		    setTimeout(function(){jQuery('#err_postal_code').html(''); }, 4000);
		    return false;
        }
        else
		{
			jQuery('#err_postal_code').html('');
		}
		
		if(jQuery('#phone_no').val() == "" ) {
			jQuery('#err_phone_no').html( "Please Enter Phone Number" );
            jQuery('#phone_no').focus() ;
		    setTimeout(function(){jQuery('#err_phone_no').html(''); }, 4000);
		    return false;
        }
        else
		{
			jQuery('#err_phone_no').html('');
		}
		
// 		Services
// 		if(jQuery("input[type='checkbox'][name='services']").is( 
//                       ":checked")){
// 		    jQuery('#err_service').html('');
// 		}else{
            
//             jQuery('#err_service').html( "Please Choose Services" );
//             jQuery('#ser_1').focus() ;
// 		    setTimeout(function(){jQuery('#err_experience').html(''); }, 4000);
// 		    return false;
// 		}


//         var checkCount = $("input[name='services[]']:checked").length;
//         console.log('services:'+checkCount);
//         if( checkCount == 0 ){
//             jQuery('#err_service').html( "Please Choose Services" );
//             jQuery('#service_1').focus() ;
// 		    setTimeout(function(){jQuery('#err_service').html(''); }, 4000);
// 		    return false;
// 		}else{
//             jQuery('#err_service').html('');
// 		}
        
		
		
		if(jQuery('#experience').val() == "" ) {
			jQuery('#err_experience').html( "Please Enter Experience" );
            jQuery('#experience').focus() ;
		    setTimeout(function(){jQuery('#err_experience').html(''); }, 4000);
		    return false;
        }
        else
		{
			jQuery('#err_experience').html('');
		}
		
		if(jQuery('#distance').val() == "" ) {
			jQuery('#err_distance').html( "Please Enter Distance" );
            jQuery('#distance').focus() ;
		    setTimeout(function(){jQuery('#err_distance').html(''); }, 4000);
		    return false;
        }
        else
		{
			jQuery('#err_distance').html('');
		}
		
		if(jQuery("input[type='checkbox'][name='vehicle1']").is( 
                      ":checked")){
		    jQuery('#err_vehicle21').html('');
		}else{
            jQuery('#err_vehicle21').html( "Please Select" );
            jQuery('#vehicle21').focus() ;
		    setTimeout(function(){jQuery('#err_vehicle21').html(''); }, 4000);
		    return false;
		}
		
		if(jQuery("input[type='checkbox'][name='vehicle2']").is( 
                      ":checked")){
		    jQuery('#err_vehicle22').html('');
		}else{
            jQuery('#err_vehicle22').html( "Please Select" );
            jQuery('#vehicle22').focus() ;
		    setTimeout(function(){jQuery('#err_vehicle22').html(''); }, 4000);
		    return false;
		}
		
		jQuery('#next1').click();
    }
    
    function validate2()
    {
        
  
        
        $("#msform").submit();
    }
    
    
   
</script>

<script type="text/javascript">
$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".next").click(function(){

current_fs = $(this).parent();
next_fs = $(this).parent().next();

//Add Class Active
$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

//show the next fieldset

next_fs.show();
//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
next_fs.css({'opacity': opacity});
},
duration: 600
});
});

$(".previous").click(function(){

current_fs = $(this).parent();
previous_fs = $(this).parent().prev();

//Remove class active
$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

//show the previous fieldset
previous_fs.show();

//hide the current fieldset with style
current_fs.animate({opacity: 0}, {
step: function(now) {
// for making fielset appear animation
opacity = 1 - now;

current_fs.css({
'display': 'none',
'position': 'relative'
});
previous_fs.css({'opacity': opacity});
},
duration: 600
});
});

$('.radio-group .radio').click(function(){
$(this).parent().find('.radio').removeClass('selected');
$(this).addClass('selected');
});

$(".submit").click(function(){
return false;
})

});
</script> 
<script type="text/javascript">
  jQuery('#all_day').click(function(){  
     
    jQuery('.availability').attr('checked', true); 
    $("button").removeClass("btn-default");
    $("button").addClass("btn-primary active");
     
});

  jQuery('#customRadio1').click(function(){      
    jQuery('.availability').prop('checked', false); 
    $("button").removeClass("btn-primary active");
    $("button").addClass("btn-default");
});
</script> 
<script>
  var today = new Date();
  var tomorrow = new Date();
  tomorrow.setDate(today.getDate()+1);
   flatpickr("#date", {
    clickOpens:true,
    dateFormat:"d-m-Y",
    maxDate: tomorrow,
   });
  </script> 

<!------btn chckbox--> 
<script type="text/javascript">
  $(function () {
  $('.button-checkbox').each(function () {

    // Settings
    var $widget = $(this),
        $button = $widget.find('button'),
        $checkbox = $widget.find('input:checkbox'),
        color = $button.data('color'),
        settings = {
          on: {
            icon: ''//'glyphicon glyphicon-check'
          },
          off: {
            icon: ''//'glyphicon glyphicon-unchecked'
          }
        };

    // Event Handlers
    $button.on('click', function () {
      $checkbox.prop('checked', !$checkbox.is(':checked'));
      $checkbox.triggerHandler('change');
      updateDisplay();
    });
    $checkbox.on('change', function () {
      updateDisplay();
    });

    // Actions
    function updateDisplay() {
      var isChecked = $checkbox.is(':checked');

      // Set the button's state
      $button.data('state', (isChecked) ? "on" : "off");

      // Set the button's icon
      $button.find('.state-icon')
        .removeClass()
        .addClass('state-icon ' + settings[$button.data('state')].icon);

      // Update the button's color
      if (isChecked) {
        $button
          .removeClass('btn-default')
          .addClass('btn-' + color + ' active');
      }
      else {
        $button
          .removeClass('btn-' + color + ' active')
          .addClass('btn-default');
      }
    }

    // Initialization
    function init() {

      updateDisplay();

      // Inject the icon if applicable
      if ($button.find('.state-icon').length == 0) {
        $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
      }
    }
    init();
  });
});
  </script>
@endsection