<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <title>Meinhaus</title>
    <link  rel="shortcut icon" type="image/png" href="https://meinhausca.com/public/theme/images/favi.png" sizes="32x32">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.48), rgba(0, 0, 0, 0.48)), url('{{url('public/pro_landing_assets/img/pexels-binyamin-mellish-186077.jpg')}}');
        background-repeat:no-repeat;
        height: 100vh;
        background-attachment: fixed;
        background-size: cover;
    }
    .OnlineGeneral {
        font-size: 34px;
        margin-left: auto;
        color: orange;
        margin-top: 38px;
    }
    
</style>
</head>

<body>
    <script>
        function show() {
            document.getElementById("more").style.display = "block"
            document.getElementById("5more").style.display = "none"
            document.getElementById("image").style.display = "block"
        }
    </script>
   <div  class="modal"  tabindex="-1" role="dialog" id="imagepreview">
    <div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Image preview</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
        <div class="ekko-lightbox-container" >
        <div class="ekko-lightbox-item fade"></div><div class="ekko-lightbox-item fade in show">
            <img  class="img-fluid" id="imgViewer" style="width: 150%; height:70%">
        </div><div class="ekko-lightbox-nav-overlay">
            <a href="#">
                <span></span></a><a href="#"><span></span></a></div></div></div><div class="modal-footer hide" style="display: none;">&nbsp;</div>
            </div>
        </div>
    </div>
    
      <section class="container-lg container-fluid mt-4">
        <div class="d-lg-flex d-md-flex d-sm-flex align-items-center">
            <div class="justify-content-center d-flex">
                <img src="http://meinhaus.ca/test/public/logo-img-removebg-preview.png" style="width: 20rem;" alt=""
                    class="img-fluid my-1">
            </div>

            <div class="OnlineGeneral text-center" style="margin-left:auto;color:orange;font-weight:700px;">
                <span class="text-center"style="font-weight:700;" >Online General
                    Contractor </span>
            </div>
        </div>
        <div class="text-white" style="font-weight: 500;font-size: 22px;color:#fff;">You have received this link because we have
            deemed you
            an eligible
            contractor to join our Qualified Contractors Network.</div>
        <div class="row my-4">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="p-3" style="background: rgb(211 211 211 / 42%); border-radius: 20px;box-shadow: 0px 0px 4px 3px #efa228">
                    <div class="d-flex">
                        <div class="text-white" style="font-weight: 700;font-size: 25px;">Project Details:</div>
                        <div class="text-white px-4 py-2" style="border-radius: 10px;font-size: 17px; margin-left: auto;background-color: #0b5ed7;">
                            <div class=""style="font-weight: 700;">Project Rate:</div>
                            <div class="text-center" style="font-weight: 700;">${{number_format($service_detail->pro_trade_amount,2)}} + HST</div>
                        </div>
                    </div>
                    <div class="text-white font-bold">
                        <div class="d-flex my-4">
                            <div style="padding-right:50px;font-weight: 700;">Project Type:</div>
                            <div style="margin-left:auto;font-weight: 700;">{{$service_name}}</div>
                        </div>
                        <div class="d-flex my-4">
                            <div style="padding-right:50px;font-weight: 700;">Project Area:</div>
                            <div style="margin-left:auto;font-weight: 700;">{{$estimate->address}}</div>
                        </div>
                        <div class="d-flex my-4">
                            <div style="padding-right:50px;font-weight: 700;">Project to be started:</div>
                            <div style="margin-left:auto;font-weight: 700;">{{$service_detail->date ?Carbon\Carbon::parse($service_detail->date)->format('d M Y') :'NA' }}</div>
                        </div>
                        <div class="d-flex my-4">
                            <div style="padding-right:50px;font-weight: 700;">Project Description:</div>
                            <div style="margin-left:auto; text-align: justify;font-weight: 700;">{{$service_detail->description}}</div>
                        </div>
                    </div>
                    <div class="">
                        <div class="text-white" style="font-weight: 700;">Photos</div>
                        <div class="row mt-2">
                            @if($estimate->img1!=NULL)
                            <div class="col-3">
                                 <a href="#" data-toggle="modal" onclick="preview(this); return false;"  data-id='{{ url("public/estimate_image/$estimate->img1")}}' data-target="#imagepreview"  data-gallery="gallery">
                                <img src="{{ url("public/estimate_image/$estimate->img1") }}" class="img-fluid"
                                    style="border-radius:15px;height: 110px;width: 100%;" />
                                    </a>
                            </div>
                            @endif
                            @if($estimate->img2!=NULL)
                            <div class="col-3">
                                 <a href="#" data-toggle="modal" onclick="preview(this); return false;"  data-id='{{ url("public/estimate_image/$estimate->img2")}}' data-target="#imagepreview"  data-gallery="gallery">
                                <img src="{{ url("public/estimate_image/$estimate->img2") }}" class="img-fluid" style="border-radius:15px;height: 110px;width: 100%;" />
                            </a>
                            </div>
                            @endif
                            @if($estimate->img3!=NULL)
                            <div class="col-3">
                                 <a href="#" data-toggle="modal" onclick="preview(this); return false;"  data-id='{{ url("public/estimate_image/$estimate->img3")}}' data-target="#imagepreview"  data-gallery="gallery">
                                <img src="{{ url("public/estimate_image/$estimate->img3") }}" class="img-fluid" style="border-radius:15px;height: 110px;width: 100%;" />
                                   </a>
                            </div>
                            <!-- <div class="col-3" id="image" style="display: none;">
                                <img src="" class="img-fluid" style="border-radius:15px;height: 110px;width: 100%;" />
                            </div> -->
                            @endif
                            @if($estimate->img4!=NULL)
                            <div class="col-3 justify-content-center d-flex align-items-center position-relative">
                                 <a href="#" data-toggle="modal" onclick="preview(this); return false;"  data-id='{{ url("public/estimate_image/$estimate->img4")}}' data-target="#imagepreview"  data-gallery="gallery">
                                <img src="{{ url("public/estimate_image/$estimate->img4") }}" class="img-fluid" style="border-radius:15px;height: 110px;width: 100%;" />
                                </a>
                                
                                <div id="5more" class="text-white position-absolute"
                                    style="font-weight: 700; cursor: pointer; color:#fff" onclick="show()">@if($estimate->img5!=NULL) 1 + more @endif</div>
                            </div>
                            @endif
                            <div class="" id="more" style="display: none;">
                                <div class="row mt-2">
                                    @if($estimate->img5!=NULL)
                                    <div class="col-3">
                                         <a href="#" data-toggle="modal" onclick="preview(this); return false;"  data-id='{{ url("public/estimate_image/$estimate->img5")}}' data-target="#imagepreview"  data-gallery="gallery">
                                        <img src="{{ url("public/estimate_image/$estimate->img5") }}" class="img-fluid"
                                            style="border-radius:15px;height: 110px;width: 100%;" />
                                        </a>    
                                    </div>
                                    @endif
                                    <!--<div class="col-3">-->
                                    <!--    <img src="" class="img-fluid"-->
                                    <!--        style="border-radius:15px;height: 110px;width: 100%;" />-->
                                    <!--</div>-->
                                    <!--<div class="col-3">-->
                                    <!--    <img src="" class="img-fluid"-->
                                    <!--        style="border-radius:15px;height: 110px;width: 100%;" />-->
                                    <!--</div>-->
                                    <!--<div class="col-3">-->
                                    <!--    <img src="" class="img-fluid"-->
                                    <!--        style="border-radius:15px;height: 110px;width: 100%;" />-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 mt-lg-0 mt-md-0 mt-3">
                <div class="text-white font-bold">
                    <div class="" style="font-weight: 700;font-size: 25px;">How we work:</div>

                    <ul class="list-unstyled" style="font-weight: 500 padding-left: 20px;">
                        <li style="font-size:18px;"class="py-2">Register membership today and receive this project as your first MeinHaus Contract</li>
                        <li style="font-size:18px;"class="py-2">No project fees, rate agreed is the rate paid !</li>
                        <li style="font-size:18px;"class="py-2">Submit documents (Government ID, Insurance)</li>
                        <li style="font-size:18px;"class="py-2">Do the job, get paid right away !</li>
                    </ul>
                </div>
                <div class="my-3">


                    <form action="{{url('purchase-job-payment-post')}}" method="POST" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="" id="payment-form">
                        @csrf
                        <div class="text-white" style="font-weight: 500;font-size: 25px;">Pay with credit or debit card</div>

                        <div class="d-flex align-items-center">
                            <div class="mt-3" style="font-weight: bold; color: #ff8600;font-size: 17px;">$ 249.99 + Tax
                                for 6 Months
                                membership !
                            </div>
                            
                            <?php $check_purch_job = DB::table('trader_purchased_job')->where('estimate_id',$service_detail->estimate_id)->where('service_id',$service_id)->first();?>
                            
                            @if($check_purch_job)
                            
                            @else
                            <button type="submit" id="card-button" data-secret="" class="btn btn-primary px-lg-3 px-2"
                                style="margin-left: auto; font-size: 15px;border-radius: 8px;box-shadow: 0px 1px 2px 1px silver;">Accept
                                Project</button>
                            @endif
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                                <input type="email" class="form-control rounded-0" style="outline: none;border: 1px solid #7f7e7d85;"
                                    id="card-holder-name" name="email" placeholder="Enter Email" required />
                                <input type="text" name="month" class="form-control rounded-0 card-expiry-month"
                                    onkeypress="if(event.which < 48 || event.which > 57 ) if(event.which != 8) return false;"
                                    placeholder="MM" maxlength="2" style="border: 1px solid #7f7e7d85;outline: none;"
                                    pattern="[0-9]{2}" required />
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12 mt-lg-0 mt-md-0 mt-sm-0 mt-3">

                                <input class="form-control rounded-0 card-number" id="card" name="card" style="outline: none;border: 1px solid #7f7e7d85;"
                                    placeholder="Card Number" required />
                                <input type="text" class="form-control rounded-0 card-expiry-year"
                                    onkeypress="if(event.which < 48 || event.which > 57 ) if(event.which != 8) return false;"
                                    placeholder="YYYY" maxlength="4" style="border: 1px solid #7f7e7d85;outline: none;"
                                    required />
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12 mt-lg-0 mt-md-0 mt-sm-0 mt-3">
                                <input type="text" class="form-control rounded-0 card-cvc" name="cvv"
                                    style="outline: none;border: 1px solid #7f7e7d85;" placeholder="CVV"
                                    onkeypress="if(event.which < 48 || event.which > 57 ) if(event.which != 8) return false;"
                                    maxlength="3" required />
                                <input type="text" class="form-control rounded-0" placeholder="$ {{number_format($service_detail->pro_trade_amount,2)}}" disabled
                                    style="border: 1px solid #7f7e7d85;outline: none;" required />
                                    <input type="hidden" name="pro_trade_amount" value="{{$service_detail->pro_trade_amount}}">
                                    <input type="hidden" name="service_id" value="{{$service_id}}">
                                    <input type="hidden" name="estimate_id" value="{{$service_detail->estimate_id}}">
                            </div>

                        </div>
                        <div class="d-flex mt-2"> <input type="checkbox" style="cursor: pointer;width: 16px;"
                                class="form-check text-white " /><label class="text-white"> &nbsp;Save this
                                card
                                info and allow MeinHaus</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <div class="my-3 justify-content-end d-flex">
            <div style="font-size: 20px;color: #ff8d0e;font-weight:700;">We place more ads, for you. Your area . Your sevices.</div>
        </div>    
    </section>
    
 @include('user_landing.footer')
</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
<script>
  
  
    function preview(e){
        //console.log(1);
    var id = e.getAttribute('data-id');
      //console.log(id);
    document.getElementById('imgViewer').src=id;
    
    //document.getElementById('viewImg').style.display='block';


}
</script>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>


  


  <script type="text/javascript">

     $(function() {

   var $form = $(".require-validation");

   $('form.require-validation').bind('submit', function(e) {

       var $form = $(".require-validation"),

           inputSelector = ['input[type=email]', 'input[type=password]',

               'input[type=text]', 'input[type=file]', 'input[type=number]',

               'textarea'

           ].join(', '),

           $inputs = $form.find('.required').find(inputSelector),

           $errorMessage = $form.find('div.error'),

           valid = true;

       $errorMessage.addClass('hide');

       $('.has-error').removeClass('has-error');

       $inputs.each(function(i, el) {

           var $input = $(el);

           if ($input.val() === '') {

               $input.parent().addClass('has-error');

               $errorMessage.removeClass('hide');

               e.preventDefault();

           }

       });

       if (!$form.data('cc-on-file')) {

           e.preventDefault();

           Stripe.setPublishableKey('pk_test_51LZVObSBB4uLDn3soOtn35F6RzvKHwZL5l367GvWWD0EV2k5M0i1d1uWH8TG10X6YQNLI5liWMgqRhzI1uVa4Jby00By4FBbLw');

           Stripe.createToken({

               number: $('.card-number').val(),

               cvc: $('.card-cvc').val(),

               exp_month: $('.card-expiry-month').val(),

               exp_year: $('.card-expiry-year').val()



           }, stripeResponseHandler);

       }

   });

   function stripeResponseHandler(status, response) {

       if (response.error) {

           $('.error')



               .removeClass('hide')

               .find('.alert')

               .text(response.error.message);

       } else {

           /* token contains id, last4, and card type */

          var token = response['id'];



           $form.find('input[type=text]').empty();

           $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

           $form.get(0).submit();

       }

   }

});

  </script>

</html>