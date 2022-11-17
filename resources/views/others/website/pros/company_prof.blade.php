@extends('website.layouts.master')
@section('after-style')
<style type="text/css">
  * {
      box-sizing: border-box;
  }

  body {
    background-color: #f1f1f1;
  }

  #business_listing {
    background-color: #ffffff;
    margin: 31px auto;
    font-family: Raleway;
    padding: 40px;
    width: 44%;
    min-width: 300px;
    color: #090115;
  }

  h1 {
    text-align: center;  
  }

  input {
    padding: 3px;
    width: 96%;
    font-size: 17px;
    font-family: Raleway;
    border: 2px solid #aaaaaa;
    color: black;
  }

  input#date {
    padding: 3px;
    width: 96%;
    font-size: 17px;
    font-family: Raleway;
    border: 2px solid #aaaaaa;
    color: black;
}

  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;

  }

  button {
    background-color: #1e9bd0;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
  }

  button:hover {
    opacity: 0.8;
  }

  #prevBtn {
    background-color: #bbbbbb;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;  
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  .step.active {
      opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #1e9bd0;
  }
  div label input {
    margin-right:100px;

                    }

 #ck-button {
    margin:4px;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
   
    float:left;
  }

  #ck-button:hover {
      background:red;
  }

  #ck-button label {
      float:left;
      width: 8em;
      margin-bottom: -0.5rem;
  }

  #ck-button label span {
      text-align:center;
      padding:3px 0px;
      display:block;
  }

  #ck-button label input {
      position:absolute;
      top:-20px;
      display: none;
  }

  #ck-button input:checked + span {
      background-color:#f30606cc;
      color:#fff;
  }
  .section-title h2.title {
    color: #1e9bd0;
    text-align: center;
    font-family: "Poppins",Arial,Helvetica,sans-serif;
    font-weight: 600;
    font-size: 36px;
    line-height: 46px;
    margin-bottom: 9px;
    margin-top: 39px;
    margin-left: -185px;
  }
  .simplepicker-btn:hover {
    color: #000!important;
    }
    .preBtCls{
        margin-left: -28%;
    }
    #services_info,
    #license_info,
    #company_info,
    #working_info,
    #additional_info{
      display:none;
    }
    .help-block {
    color: red;
    }
</style>
@endsection
@section('content')

<div class="section-title ">
   <div class="title-header">
      <h2 class="title">Become a MEINHAUS Pro</h2>
   </div>
</div>
<form id="business_listing" name="business_listing" action="{{route('pro-onboarding-post')}}" method="POST" enctype="multipart/form-data">
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
    <fieldset id="business_info">
      <div class="tab">
        <h4>Business Listing</h4>
        <b>Set up your MainHaus Company Profile</b><br>
        <p><label for="company_name">Company Name</label>
         <input placeholder="Company name..." name="company_name" id="company_name">
        </p>
        <p><label for="business_address">Full Business Address</label>
           <input placeholder="Full Business Address..." name="business_address" id="business_address">
        </p>
        <p><label for="phone_no">Business Phone Number</label>
           <input placeholder="Business Phone Number..." name="phone_no" id="phone_no">
        </p>
        <div class="form-group mb-0">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="terms" class="custom-control-input" id="terms">
            <label class="custom-control-label" for="terms"><b>Terms And Use </b>
            <br>By checking this box you represent and warrant that you hold all required or industry standard.</label>
            <label id="terms-error" class="help-block" for="terms"></label>
          </div>
        </div>
      </div>
      <div style="overflow:auto;margin-top: 40px;">
        <div style="float:right;">
            <p><a class="nextBtCls btn btn-primary" id="nextBtn">Next</a></p>

        </div>
     </div>      
    </fieldset>
        <fieldset id="additional_info">
      <div class="tab">
        <h4>Business Listing</h4>
        <b>Set up your MeinHaus Additional Profile</b><br>
        <!--<p><label for="name">Name</label>-->
        <!-- <input placeholder="Name..." name="name" id="name">-->
        <!--</p>-->
        <!--<p><label for="address">Address</label>-->
        <!--   <input placeholder="Address..." name="address" id="address">-->
        <!--</p>-->
        <p><label for="city">City</label>
           <input placeholder="City..." name="city" id="city">
        </p>
        <p><label for="province">Province</label>
           <input placeholder="Province..." name="province" id="province">
        </p>
        <p><label for="postal_code">Postal Code</label>
           <input placeholder="Postal Code..." name="postal_code" id="postal_code">
        </p>
        <p><label for="experience">Experience</label>
           <input placeholder="Experience..." name="experience" id="experience">
        </p>
        <p>
         <div class="form-group">
         <div class="custom-control custom-radio"><B>Do you own and operate your ownn vehicle that you can get two projects?</B><br>
            <input class="custom-control-input" type="radio" id="yes" name="vehicle_owner" value="1" checked="">
            <label for="yes" class="custom-control-label">Yes</label>
         </div>
         <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="no" name="vehicle_owner" value="0">
            <label for="no" class="custom-control-label">No</label>
         </div>
      </div>
        </p>
        <p><label for="insurance">Insurance</label>
           <!--<input placeholder="Insurance Number..." name="insurance">-->
        
        <div class="field_wrapper">
           <div>
              <input type="file"  name="insurance" value=""/>
           </div>
        </div>
        </p>
        <p><label for="distance">How many Kilometers are you willing to travel to provide service from home.</label>
           <input placeholder="Distance..." name="distance" id="distance">
        </p>
        
        <div class="form-group mb-0">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="criminal_offence" class="custom-control-input" id="criminal_offence">
            <label class="custom-control-label" for="criminal_offence"><b>No Criminal Offence </b>
            <br>By checking this box you represent and warrant that you are not involved in any criminal offence.</label>
            <label id="terms-error" class="help-block" for="criminal_offence"></label>
          </div>
        </div>
      </div>
      <div style="overflow:auto;margin-top: 40px;">
        <div style="float:right;">
            <p><a class="nextBtCls btn btn-primary" id="nextBtn">Next</a></p>

        </div>
     </div>      
    </fieldset>
    <fieldset id="services_info">
     <div class="tab">
        <H4>Services</H4>
        <div class="form-group">
           <b>Choose Your Service</b>
           @foreach($services as $key => $service)
           <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="ser_{{$key}}" value="{{$service->id}}" name = "services[]" >
              <label for="ser_{{$key}}" class="custom-control-label">{{$service->name}}</label>
              
           </div>
           @endforeach
           <label id="services[]-error" class="help-block" for="services[]"></label>
        </div>

     </div>
     <div style="overflow:auto;margin-top: 40px;">
        <div style="float:right;display:flex;">
            <p><a class="nextBtCls btn btn-primary" id="nextBtn">Next</a></p>
            &nbsp<p><a class="btn btn-primary" id="previous" >Previous</a></p>
        </div>
     </div>
   </fieldset>
   <fieldset id="license_info">
     <div class="tab">
        <h4>Add License/Certification</h4>
        <br>If your category requires a valid license/certification, please enter the details here.
        <p><label for="license_no">Service</label>
           <input placeholder="Service Number..." name="license_no" >
        </p>
        <div class="field_wrapper">
           <div>
              <input type="file"  name="license_doc" value=""/>
           </div>
        </div>
        <br>
     </div>
     <div style="overflow:auto;margin-top: 40px;">
        <div style="float:right;display:flex;">
            <p><a class="nextBtCls btn btn-primary" id="nextBtn">Next</a></p>
             &nbsp<p><a class="btn btn-primary" id="previous" >Previous</a></p>
        </div>
     </div>
   </fieldset>
   <fieldset id="working_info">
     <div class="tab">
        <h4>Add Working Hours</h4>
        <br>
        <h5>Select your day availability</h5>
        <p>
        <div class="form-group">
           <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" id="customRadio1" name="all_day" checked="" >
              <label for="customRadio1" class="custom-control-label">Enter Hours</label>
           </div>
           <div class="custom-control custom-radio">
              <input class="custom-control-input" type="radio" id="all_day" name="all_day" >
              <label for="all_day" class="custom-control-label">Open all days</label>
           </div>
        </div>
        </p>
        <p>Monday
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_1" name="monday[]"><span> 08:00 - 11:00AM </span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_2" name="monday[]"><span>11:00-02:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_3" name="monday[]"><span>02:00-05:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_4" name="monday[]"><span>05:00-08:00PM</span>
           </label>
        </div>
        </p>
        <p>Tuesday
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_1" name="tuesday[]"><span>08:00-11:00AM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_2" name="tuesday[]"><span>11:00-02:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_3" name="tuesday[]"><span>02:00-05:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_4" name="tuesday[]"><span>05:00-08:00PM</span>
           </label>
        </div>
        <br>
        </p>
        <p>Wednesday
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_1" name="wednesday[]"><span>08:00-11:00AM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_2" name="wednesday[]"><span>11:00-02:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_3" name="wednesday[]"><span>02:00-05:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_4" name="wednesday[]"><span>05:00-08:00PM</span>
           </label>
        </div>
        <br></p>
        <p>Thursday
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_1" name="thursday[]"><span>08:00-11:00AM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_2" name="thursday[]"><span>11:00-02:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_3" name="thursday[]"><span>02:00-05:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_4" name="thursday[]"><span>05:00-08:00PM</span>
           </label>
        </div>
        <br></p>
        <p>Friday
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_1" name="friday[]"><span>08:00-11:00AM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_2" name="friday[]"><span>11:00-02:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_3" name="friday[]"><span>02:00-05:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_4" name="friday[]"><span>05:00-08:00PM</span>
           </label>
        </div>
        <br></p>
        <p>Saturday
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_1" name="saturday[]"><span>08:00-11:00AM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_2" name="saturday[]"><span>11:00-02:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_3" name="saturday[]"><span>02:00-05:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_4" name="saturday[]"><span>05:00-08:00PM</span>
           </label>
        </div>
        <br>
        </p>
        <p>Sunday
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_1" name="sunday[]"><span>08:00-11:00AM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_2" name="sunday[]"><span>11:00-02:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_3" name="sunday[]"><span>02:00-05:00PM</span>
           </label>
        </div>
        <div id="ck-button">
           <label>
           <input type="checkbox" class="availability" value="mon_4" name="sunday[]"><span>05:00-08:00PM</span>
           </label>
        </div>
        <br>
        </p>
     </div>
     <div style="overflow:auto;margin-top: 40px;">
        <div style="float:right;display:flex;">
            <p><a class="nextBtCls btn btn-primary" id="nextBtn">Next</a></p>
             &nbsp<p><a class="btn btn-primary" id="previous" >Previous</a></p>
        </div>
     </div>
   </fieldset>
   <fieldset id="company_info">
    <div class="tab">
      <h5> Account/Company Information</h5>
      <div class="form-group">
         <div class="custom-control custom-radio"><B>Are you a company or an individual?</B><br>
            <input class="custom-control-input" type="radio" id="individual" name="company_individual" value="individual" checked="">
            <label for="individual" class="custom-control-label">Individual</label>
         </div>
         <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" id="company" name="company_individual" value="company">
            <label for="company" class="custom-control-label">Company</label>
         </div>
      </div>
      <br>
      <label for="open">EIN Number</label>
      <input placeholder="EIN..." name="ein_no" id="ein_no" >
      <p><label for="name"><B>Key Account Holder Information</B></label>
         <br>
         <label for="first_name">First Name</label>
         <input placeholder="First Name..." name="first_name" id="first_name">
         <br>
         <label for="last_name">Last Name</label>
         <input placeholder="Last Name..." name="last_name" id="last_name">
         <br>
         <label for="ssn_no" style="display: block;">SSN</label>
         <input placeholder="SSN..." name="ssn_no" id="ssn_no" >
         <br>
         <label for="date">Date of Birth</label>
        <input placeholder="Date Of Birth..." class="" name="dob" id="date" >
      </p>
      <p><br><B>Banking Information</B>
         <br>
         <label for="routing_no">Routing Number</label>
         <input placeholder="Routing Number..." name="routing_no" id="routing_no" >
         <br>
         <label for="account_no">Account Number</label>
         <input placeholder="Account Number..." name="account_no" id="account_no" >
      </p>
       <div class="form-group mb-0">
         <div class="custom-control custom-checkbox">
            <input type="checkbox" name="term" class="custom-control-input" id="term" >
            <label class="custom-control-label" for="term">By adding your banking information. you agree to our Terms and Conditions and the Stripe Connected Account Agreement Payment processing is provided by Stripe and we do not store your banking information;.</label>
         </div>
         <label id="term-error" class="help-block" for="term"></label>
      </div>
    </div>
    <div style="overflow:auto;margin-top: 40px;">
        <div style="float:right;display:flex;">
             <p><a class="btn btn-primary" id="previous" >Previous</a></p>
            &nbsp<p><button class="nextBtCls btn btn-primary" id="nextBtn">Submit</button></p>
        </div>
     </div>
  </fieldset>
</form>
@endsection
@section('script')
<script type="text/javascript">
  
</script>

<script type="text/javascript">
	jQuery('#all_day').click(function(){      
    jQuery('.availability').prop('checked', true); 

     
});

	jQuery('#customRadio1').click(function(){      
    jQuery('.availability').prop('checked', false); 
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
@endsection