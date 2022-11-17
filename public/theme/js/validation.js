$.validator.methods.emailVal = function(value) {
           var reg = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if(reg.test(value) != true)
                ab = false;
            else 
                ab = true;
            return ab; 
};

$.validator.methods.customValidation = function (value, element) {

    if (/^\s/.test(value) == !0) ab = !1;
    else ab = !0;
    return ab
};

$.validator.methods.PhoneValidation = function (value, element) {
    if (/^(?!(\d)\1{9})(?!0123456789|1234567890|0987654321|9876543210)\d{8,15}$/.test(value) != !0) 
        ab = !1;
    else 
        ab = !0;
    return ab
};
$.validator.methods.expVal = function (value, element) {
   if (/^[1-9]*$/.test(value) != !0)
        ab = !1;
    else 
        ab = !0;
    return ab
};
$.validator.methods.pwdVal = function(value){
  var reg = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
    if(reg.test(value) != true)
        ab = !1;
    else
        ab = !0;
    return ab;
};
$.validator.methods.postCode = function(value){
  var reg = /^(?![DFIOQUWZ])[A-Z]{1}[0-9]{1}(?![DFIOQU])[A-Z]{1}[ ]{1}[0-9]{1}(?![DFIOQU])[A-Z]{1}[0-9]{1}$/;
  if(reg.test(value) != true)
        ab = !1;
    else
        ab = !0;
    return ab;
};
$.validator.methods.alphabetsOnly = function (value, element) {
    if (/^[a-zA-Z ]*$/.test(value) != !0) 
        ab = !1;
    else 
        ab = !0;
    return ab
};

var public_url = $('meta[name="base_url"]').attr('content');

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Validation of login form

$("#login").validate({

  rules:{

    email:{
        required:true,
        emailVal:true,
    },
    password: {
      required:!0,
      minlength:8,
      maxlength:16
     },

  },

  messages:{

    email:{
        required:"*Please enter email address",
        emailVal:"*Please enter valid email address",
    },
    password: {
        required:"*Please enter password",
        minlength:"*Password contains atleast 8 characters.",
        maxlength:"*Passwod contains maximum 16 characters."
    },

  },
 errorElement: "label",
        wrapper: "label",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});


// Validation of register form

$("#register").validate({

  rules:{

    first_name: {
        required: !0,
        customValidation:!0,
        alphabetsOnly:!0,
        minlength:2,
        maxlength:255
    },
    last_name: {
        required: !0,
        customValidation:!0,
        alphabetsOnly:!0,
        minlength:2,
        maxlength:255
    },
    email:{
        required:true,
        emailVal:true,
        remote:{
          url: public_url+'/user/checkmail',
          type: "post"
        },
    },
    password: {
      required:!0,
      minlength:8,
      maxlength:16
     },
     confirm_password: {
        required:!0,
        minlength:8,
        maxlength:16  ,
        equalTo:'#password'
    },
      phone_no: {
        required:!0,
        customValidation:!0,
        PhoneValidation:!0,
        minlength:7,
        maxlength:14
    },
    terms:{
        required:!0
    },

  },

  messages:{

    first_name: {
        required: "*Please enter your first name.",
      customValidation: "*First Name cannot be prefix by a space.",
        alphabetsOnly:"*First Name contains only alphabets.",
        minlength:"*First Name contains minimum 2 characters",
        maxlength:"*First Name contains maximum 255 characters."
    },
    last_name: {
        required: "*Please enter your last name.",
      customValidation: "*Last Name cannot be prefix by a space.",
        alphabetsOnly:"*Last Name contains only alphabets.",
        minlength:"*Last Name contains minimum 2 characters",
        maxlength:"*Last Name contains maximum 255 characters."
    },
    email:{
        required:"*Please enter email address.",
        emailVal:"*Please enter valid email address.",
        remote:"*Email already exists."
    },
    password: {
        required:"*Please enter password",
        minlength:"*Password contains atleast 8 characters.",
        maxlength:"*Password contains maximum 16 characters."
    },
    confirm_password: {
        required:"Please enter confirm password.",
        minlength:"*Confirm password contains atleast 8 characters.",
        maxlength:"*Confirm password contains maximum 16 characters.",
        equalTo: "Confirm password must be same as password."
    },
    phone_no: {
        required: "*Please enter phone number",
        PhoneValidation:"*Please enter a valid phone number",
      customValidation: "*Phone number cannot be prefix by a space.",
        minlength:"*Phone number contains minimum 7 digits",
        maxlength:"*Phone number contains maximum 14 digits"
    },
    terms:{
        required:"*Please accept terms and conditions to continue"
    }

  },
 errorElement: "label",
        wrapper: "label",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});


$("#bookings").validate({

  rules:{

    address_type:{
        required:true
    },
    name:{
        required:true,
        minlength:2,
        maxlength:255,
        alphabetsOnly:!0

    },
    address:{
        required:true,
        minlength:2,
        maxlength:255
    },
    locality:{
        required:true,
        minlength:2,
        maxlength:255
    },
    city:{
        required:true,
        minlength:2,
        maxlength:255,
        alphabetsOnly:!0
    },
    pin_code:{
        required:true,
        minlength:2,
        maxlength:255
    },
    state:{
        required:true,
        minlength:2,
        maxlength:255,
         alphabetsOnly:!0
    },
    address_id:{
        required:true
    },
    date:{
        required:true
    },
    time:{
        required:true
    },
    phone_no:{
        required:true,
        customValidation:!0,
        PhoneValidation:!0,
    },
    timing_constraints:{  
        required:true
    },
    description:{  
        required:true
    },
    est_area:{
        required: true
    }


  },

  messages:{

    address_type:{
        required:"*Please select type of address."
    },
    name:{
        alphabetsOnly:"*Name contains only alphabets.",
        required:"*Please enter the name.",
        minlength:"*Name contains atleast 2 characters.",
        maxlength:"*Name contains maximum 255 characters.",
    },
    address:{
        required:"*Please enter the address.",
        minlength:"*Address contains atleast 2 characters.",
        maxlength:"*Address contains maximum 255 characters.",
    },
    locality:{
        required:"*Please enter the locality.",
         minlength:"*Locality contains atleast 2 characters.",
        maxlength:"*Locality contains maximum 255 characters.",
    },
    city:{
        required:"*Please enter the City/Municipality.",
         minlength:"*City/Municipality contains atleast 2 characters.",
        maxlength:"*City/Municipality contains maximum 255 characters.",
        alphabetsOnly:"*City/Municipality contains only alphabets.",

    },
    pin_code:{
        required:"*Please enter the Postal Code.",
         minlength:"*Postal Code contains atleast 2 characters.",
        maxlength:"*Postal Code contains maximum 255 characters.",
    },
    state:{
        required:"*Please enter the Province.",
         minlength:"*Province contains atleast 2 characters.",
        maxlength:"*Province contains maximum 255 characters.",
        alphabetsOnly:"*Province contains only alphabets.",

    },
    address_id:{
        required:"*Please select the address."
    },
    date:{
        required:"*Please select the available date."
    },
    time:{  
        required:"*Please select the available time."
    },
    phone_no:{  
        required:"*Please enter your contact number.",
        PhoneValidation:"*Please enter a valid contact number",
        customValidation: "*Contact number cannot be prefix by a space."
    },
    timing_constraints:{  
        required:"*Please enter the timing constraints."
    },
    description:{  
        required:"*Please enter the brief description of the job."
    },
    est_area:{
        required:"*Please enter the esitmated area."
    },


  },
 errorElement: "label",
        wrapper: "label",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});


$("#reset-pass").validate({

  rules:{

    password:{
        required:!0,
        minlength:8,
        maxlength:16
    },
    confirm_password: {
        required:!0,
        minlength:8,
        maxlength:16,
        equalTo:'#password'
     },

  },

  messages:{

    password:{
        required:"*Please enter password",
        minlength:"*Password contains atleast 8 characters.",
        maxlength:"*Passwod contains maximum 16 characters."
    },
    confirm_password: {
        required:"*Please enter confirm password",
        minlength:"*Password contains atleast 8 characters.",
        maxlength:"*Passwod contains maximum 16 characters.",
        equalTo:"Confirm Password must be same as new password."
    },

  },
 errorElement: "span",
        wrapper: "span",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});


$("#update-profile").validate({

  rules:{

    name:{
        required: !0,
        customValidation:!0,
        alphabetsOnly:!0,
        minlength:2,
        maxlength:255
    },
    phone_no: {
        required:!0,
        customValidation:!0,
        PhoneValidation:!0,
        minlength:7,
        maxlength:14
     },

  },

  messages:{

    name:{
        required: "*Please enter your name.",
        customValidation: " Name cannot be prefix by a space.",
        alphabetsOnly:" Name contains only alphabets.",
        minlength:" Name contains minimum 2 characters",
        maxlength:" Name contains maximum 255 characters."
    },
    phone_no: {
        required: "*Please enter phone number",
        PhoneValidation:"*Please enter a valid phone number",
        customValidation: "*Phone number cannot be prefix by a space.",
        minlength:"*Phone number contains minimum 7 digits",
        maxlength:"*Phone number contains maximum 14 digits"
    },

  },
 errorElement: "span",
        wrapper: "span",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});


$('#ttm-contactform').validate({ // initialize the plugin

        rules: {
            phone: {
                required: true,
                digits: true,
                PhoneValidation: true
            },
            email: {
                required: true,
                emailVal:true
           
            },
            name:
            {
                required:true,
            },
            message:
            {
                required:true,
            },
            venue:
            {
                required:true
            }



    },
     messages:{

    email:{
        required:"*Please enter email address",
        emailVal:"*Please enter valid email address",
    },
    phone: {
        required: "*Please enter phone number",
        PhoneValidation:"*Please enter a valid phone number",
        customValidation: "*Phone number cannot be prefix by a space.",
        minlength:"*Phone number contains minimum 7 digits",
        maxlength:"*Phone number contains maximum 14 digits"
    },
    venue:
    {
        required:"*Please enter the Venue",
    },
    message:{
        required:"*Please enter the Message",
    },
    name:
    {
        required:"*Please enter the Name",
    },
},


 errorElement: "span",
        wrapper: "span",
            errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
          submitHandler: function(form) {
      form.submit();
    }
});


$("#banking").validate({

  rules:{

    account_no:{
        customValidation:!0,
        required:true,

    },
    routing_no:{
        required:true,
        customValidation:!0        
    },
    

  },
   messages:{

    account_no:{
        customValidation: "*Account number cannot be prefix by a space.",
        required:"*Please enter the Account Number.",
    },
    routing_no:{  
        required:"*Please enter your Routing number.",
        customValidation: "*Routing number cannot be prefix by a space."
    },
    

  },
 errorElement: "label",
        wrapper: "label",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});


$("#documents").validate({

  rules:{

    license_no:{
        customValidation:!0,
        required:true

    },
       

  },
   messages:{

    license_no:{
        required:"*Please enter the License Number.",
        customValidation: "*License number cannot be prefix by a space."
    },
         

  },
 errorElement: "label",
        wrapper: "label",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});

$("#updateServices").validate({

  rules:{

    "services[]":{
        
        required:true

    },
       

  },
   messages:{

    "services[]":{
        required:"*Please Select the Services",
        
    },
         

  },
 errorElement: "label",
        wrapper: "label",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});

$(".nextBtCls").click(function(){
        var form = $("#business_listing");
    form.validate({
          errorElement: 'label',
          errorClass: 'help-block',
          highlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').addClass("has-error");
            $(errorClass).css('color','red');
          },
          unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass("has-error");
          },
          rules: {
            company_name: {
              required: true,
              minlength: 2,
            },
            business_address : {
              required: true,
            },
            phone_no : {
              required: true,
              customValidation:!0,
              PhoneValidation:!0,
              minlength:7,
              maxlength:14
            },
            company:{
              required: true,
            },
            terms:{
              required: true,
            },
            term:{
              required: true,
            },
            name:{
              required: true,
              minlength: 2,
              alphabetsOnly: !0,
            },
            address:{
                required: true,
            },
            city:{
                required: true,
            },
            province:{
                required: true,
            },
            postal_code:{
                required: true,
                postCode: !0,
            },
            experience:{
                required: true,
                expVal: !0,
            },
            vehicle_owner:{
                required: true,
            },
            
            distance:{
                required: true,
            },
            criminal_offence:{
                required: true,
            },
           
            "services[]": {
              required: true,
            },
            license_no : {
              required: true,
              customValidation:!0
            },
            license_doc: {
                required:true,
                extension:"jpg|pdf|jpeg|png|doc|docx",
            },
            ein_no:{
                required:true,
                customValidation:!0,
                digits: !0,
            },
            first_name:{
                required:true,
                alphabetsOnly: !0,
            },
            last_name:{
                required:true,
                alphabetsOnly: !0,
            },
            dob:{
                required:true,
            },
            ssn_no:{
                required:true,
                customValidation:!0,
                digits: !0,
            },
            routing_no:{
                required:true,
                customValidation:!0,
                digits: !0,
            },
            account_no:{
                required:true,
                customValidation:!0,
                digits: !0,
            },
          },
             messages:{

            company_name: {
              required: "Please enter the company name.",
              minlength: "The minimum length should be two characters.",
            },
            business_address : {
              required:"Please enter the Business Address",
            },
            phone_no : {
              required:"*Please enter your Business Phone Number.",
                customValidation: "*Business Phone Number cannot be prefix by a space.",
                PhoneValidation:"*Please enter a valid Business Phone Number",
                 minlength:"*Business Phone Number contains minimum 7 digits",
                 maxlength:"*Business Phone Number contains maximum 14 digits"
            },
            company:{
              required:"Please enter the Company Name." ,
            },
            terms:{
              required: "Select the terms and conditions.",
            },
            term:{
              required: "Select the banking terms and conditions.",
            },
            name:{
             required: "Please enter name.",
             minlength: "The minimum length should be two characters.",
            },
            address:{
                 required: "Please enter address.",
            },
            city:{
                 required: "Please enter city.",
            },
            province:{
                 required: "Please enter province.",
            },
            postal_code:{
                 required: "Please enter postal code.",
                 postCode: "Please enter the correct post code (example: A1B 2C3).",
            },
            experience:{
                 required: "Please enter experience.",
                 expVal: "Minimum experience is of 1 year.",
            },
            vehicle_owner:{
                 required: "Please select vehicle owner.",
            },
           
            distance:{
                 required: "Please enter distance to home.",
            },
            criminal_offence:{
                 required: "Please select checkbox for non-criminal offence .",
            },
            "services[]": {
              required: "Please Select the Services.",  
            },
            license_no : {
              required:"*Please enter your License Number .",
                customValidation: "*License Number cannot be prefix by a space."
            },
            license_doc: {
                required:"Please upload you License Document.",
                extension:"Please upload image or document format only.",
            },
            ein_no:{
                required:"*Please enter your EIN Number.",
                customValidation: "*EIN Number cannot be prefix by a space.",
                digits:"*Please enter digits only.",

            },
            first_name:{
                required:"Please enter your First Name",
                alphabetsOnly: "The first name contains alphabets only.",
            },
            last_name:{
                required:"*Please enter your Last Name .",
                alphabetsOnly: "The last name contains alphabets only.",
                
            },
            dob:{
                required:"*Please enter the date of birth",
            },
            ssn_no:{
                required:"*Please enter the SSN Number",
                customValidation:"*SSN Number cannot be prefix by a space.",
                digits:"*Please enter digits only",
            },    

            account_no:{
                customValidation: "*Account number cannot be prefix by a space.",
                required:"*Please enter the Account Number.",
                digits:"*Please enter digits only",
            },
            routing_no:{  
                required:"*Please enter your Routing number.",
                customValidation: "*Routing number cannot be prefix by a space.",
                digits:"*Please enter digits only",
            }
    

            },
    });
    if (form.valid() === true){
          if ($('#business_info').is(":visible")){
            current_fs = $('#business_info');
            next_fs = $('#additional_info');
          }else if($('#additional_info').is(":visible")){
            current_fs = $('#additional_info');
            next_fs = $('#services_info');
          }else if($('#services_info').is(":visible")){
            current_fs = $('#services_info');
            next_fs = $('#license_info');
          }else if($('#license_info').is(":visible")){
            current_fs = $('#license_info');
            next_fs = $('#working_info');
          }else if($('#working_info').is(":visible")){
            current_fs = $('#working_info');
            next_fs = $('#company_info');
          }
          
          next_fs.show(); 
          current_fs.hide();
    }
 $('#previous').click(function(){
     if($('#additional_info').is(":visible")){
    current_fs = $('#additional_info');
    next_fs = $('#business_info');     
     }
   else if($('#services_info').is(":visible")){
    current_fs = $('#services_info');
    next_fs = $('#additional_info');
    }
    else if ($('#license_info').is(":visible")){
    current_fs = $('#license_info');
    next_fs = $('#services_info');
    }
    else if ($('#working_info').is(":visible")){
    current_fs = $('#working_info');
    next_fs = $('#license_info');
    }
    next_fs.show(); 
    current_fs.hide();
    });    
});

$("#change-password").validate({

  rules:{

    current_password:{
        required:!0,
        minlength:8,
        maxlength:16
    },
    new_password:{
        required:!0,
        minlength:8,
        maxlength:16
    },
    confirm_password: {
        required:!0,
        minlength:8,
        maxlength:16,
        equalTo:'#new_password'
     },

  },

  messages:{

    current_password:{
        required:"*Please enter current password",
        minlength:"*Current Password contains atleast 8 characters.",
        maxlength:"*Current Password contains maximum 16 characters."
    },
    new_password:{
        required:"*Please enter new password",
        minlength:"*New Password contains atleast 8 characters.",
        maxlength:"*New Password contains maximum 16 characters."
    },
    confirm_password: {
        required:"*Please enter confirm password",
        minlength:"*Password contains atleast 8 characters.",
        maxlength:"*Password contains maximum 16 characters.",
        equalTo:"Confirm Password must be same as new password."
    },

  },
 errorElement: "span",
        wrapper: "span",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});

$('#add-address').validate({

    rules:{

        address_name:{
            required:true,
            minlength:2,
            maxlength:255,
            alphabetsOnly:!0

        },
        address:{
            required:true,
            minlength:2,
            maxlength:255
        },
        locality:{
            required:true,
            minlength:2,
            maxlength:255
        },
        city:{
            required:true,
            minlength:2,
            maxlength:255,
            alphabetsOnly:!0
        },
        pin_code:{
            required:true,
            minlength:2,
            maxlength:255
        },
        state:{
            required:true,
            minlength:2,
            maxlength:255,
             alphabetsOnly:!0
        }
    },

    messages:{

        address_name:{
            alphabetsOnly:"*Name contains only alphabets.",
            required:"*Please enter the name.",
            minlength:"*Name contains atleast 2 characters.",
            maxlength:"*Name contains maximum 255 characters.",
        },
        address:{
            required:"*Please enter the address.",
            minlength:"*Address contains atleast 2 characters.",
            maxlength:"*Address contains maximum 255 characters.",
        },
        locality:{
            required:"*Please enter the locality.",
             minlength:"*Locality contains atleast 2 characters.",
            maxlength:"*Locality contains maximum 255 characters.",
        },
        city:{
            required:"*Please enter the city.",
             minlength:"*City contains atleast 2 characters.",
            maxlength:"*City contains maximum 255 characters.",
            alphabetsOnly:"*City contains only alphabets.",

        },
        pin_code:{
            required:"*Please enter the pincode.",
             minlength:"*Pincode contains atleast 2 characters.",
            maxlength:"*Pincode contains maximum 255 characters.",
        },
        state:{
            required:"*Please enter the state.",
             minlength:"*State contains atleast 2 characters.",
            maxlength:"*State contains maximum 255 characters.",
            alphabetsOnly:"*State contains only alphabets.",

        }
    },
    errorElement: "span",
        wrapper: "span",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
});
$("#user-rating-form").validate({

  rules:{

    reviews:{
        required:true,
        
    },
    
  },

  messages:{

    reviews:{
        required:"*Please enter the review",
           },
    
  },
 errorElement: "label",
        wrapper: "label",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});

$("#change-password-user").validate({

  rules:{

    current_password:{
        required:!0,
        minlength:8,
        maxlength:16
    },
    new_password:{
        required:!0,
        minlength:8,
        maxlength:16
    },
    new_password_confirmation: {
        required:!0,
        minlength:8,
        maxlength:16,
        equalTo:'#new_password'
     },

  },

  messages:{

    current_password:{
        required:"*Please enter current password",
        minlength:"*Current Password contains atleast 8 characters.",
        maxlength:"*Current Password contains maximum 16 characters."
    },
    new_password:{
        required:"*Please enter new password",
        minlength:"*New Password contains atleast 8 characters.",
        maxlength:"*New Password contains maximum 16 characters."
    },
    new_password_confirmation: {
        required:"*Please enter confirm password",
        minlength:"*Password contains atleast 8 characters.",
        maxlength:"*Password contains maximum 16 characters.",
        equalTo:"Confirm Password must be same as new password."
    },

  },
 errorElement: "span",
        wrapper: "span",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});
 
 
$("#custom_bookings").validate({

  rules:{
    "service_id[]":{
        required:true
    },
    address_type:{
        required:true
    },
    name:{
        required:true,
        minlength:2,
        maxlength:255,
        alphabetsOnly:!0

    },
    address:{
        required:true,
        minlength:2,
        maxlength:255
    },
    locality:{
        required:true,
        minlength:2,
        maxlength:255
    },
    city:{
        required:true,
        minlength:2,
        maxlength:255,
        alphabetsOnly:!0
    },
    pin_code:{
        required:true,
        minlength:2,
        maxlength:255
    },
    state:{
        required:true,
        minlength:2,
        maxlength:255,
         alphabetsOnly:!0
    },
    address_id:{
        required:true
    },
    date:{
        required:true
    },
    time:{
        required:true
    },
    phone_no:{
        required:true,
        customValidation:!0,
        PhoneValidation:!0,
    },
    email_id:{
        required:true,
        emailVal:true,
    },
    price:{
        required:true,
    },
    description:{  
        required:true,
    },
    "images[]":{
       required:true,
    }


  },

  messages:{
     "service_id[]":{
        required:"*Please select services."
    },
    address_type:{
        required:"*Please select type of address."
    },
    name:{
        alphabetsOnly:"*Name contains only alphabets.",
        required:"*Please enter the name.",
        minlength:"*Name contains atleast 2 characters.",
        maxlength:"*Name contains maximum 255 characters.",
    },
    address:{
        required:"*Please enter the address.",
        minlength:"*Address contains atleast 2 characters.",
        maxlength:"*Address contains maximum 255 characters.",
    },
    locality:{
        required:"*Please enter the locality.",
         minlength:"*Locality contains atleast 2 characters.",
        maxlength:"*Locality contains maximum 255 characters.",
    },
    city:{
        required:"*Please enter the City/Municipality.",
         minlength:"*City/Municipality contains atleast 2 characters.",
        maxlength:"*City/Municipality contains maximum 255 characters.",
        alphabetsOnly:"*City/Municipality contains only alphabets.",

    },
    pin_code:{
        required:"*Please enter the Postal Code.",
         minlength:"*Postal Code contains atleast 2 characters.",
        maxlength:"*Postal Code contains maximum 255 characters.",
    },
    state:{
        required:"*Please enter the Province.",
         minlength:"*Province contains atleast 2 characters.",
        maxlength:"*Province contains maximum 255 characters.",
        alphabetsOnly:"*Province contains only alphabets.",

    },
    address_id:{
        required:"*Please select the address."
    },
    date:{
        required:"*Please select the available date."
    },
    time:{  
        required:"*Please select the available time."
    },
    phone_no:{  
        required:"*Please enter your contact number.",
        PhoneValidation:"*Please enter a valid contact number",
        customValidation: "*Contact number cannot be prefix by a space."
    },
    email_id:{
        required:"*Please enter the email id.",
        emailVal:"Please enter valid email id.",
    },
    price:{
        required:"*Please select custom amount.",
    },
    description:{  
        required:"*Please enter the brief description of the job."
    },
    "images[]":{
       required:"*Please select the images.",
    }


  },
 errorElement: "label",
        wrapper: "label",
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
        },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }

});