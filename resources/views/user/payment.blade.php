<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        section.pricing {
    background: #007bff;
    background: linear-gradient(to right, #0062E6, #33AEFF);
  }

  .pricing .card {
    border: none;
    border-radius: 1rem;
    transition: all 0.2s;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
  }

  .pricing hr {
    margin: 1.5rem 0;
  }

  .pricing .card-title {
    margin: 0.5rem 0;
    font-size: 0.9rem;
    letter-spacing: .1rem;
    font-weight: bold;
  }

  .pricing .card-price {
    font-size: 3rem;
    margin: 0;
  }

  .pricing .card-price .period {
    font-size: 0.8rem;
  }

  .pricing ul li {
    margin-bottom: 3rem;
  }

  .pricing .text-muted {
    opacity: 0.7;
  }

  .pricing .btn {
    font-size: 80%;
    border-radius: 5rem;
    letter-spacing: .1rem;
    font-weight: bold;
    padding: 1rem;
    opacity: 0.7;
    transition: all 0.2s;
  }

  /* Hover Effects on Card */

  @media (min-width: 992px) {
    .pricing .card:hover {
      margin-top: -.25rem;
      margin-bottom: .25rem;
      box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
    }
    .pricing .card:hover .btn {
      opacity: 1;
    }
  }

  #card-element {
    border: 1px solid silver;
    border-radius: 4px;
    height: 35px;
    background: #fff;
    margin-bottom: 20px;
    padding-top: 10px;
  }
    </style>
  </head>
  <body>
  <section class="pricing py-5" style='height:auto'>
    <div class="container">
      <div class="row" style="margin-top: 25px;">
        <!-- Free Tier -->
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="card mb-5 mb-lg-0">
            <div class="card-body">

              <h6 class="card-price text-center" style="font-size:30px;font-weight:600">Service Charge</h6>
              <hr>
              <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-check"></i></span>Total Service Time<span class="period" style="float:right;
      color: #fda12b;font-weight: bold;"> {{$service_time}}</span></li>
               
                <li><span class="fa-li"><i class="fas fa-check"></i></span>Total Amount<span class="period" style="float:right;
      color: #fda12b;font-weight: bold;">$ {{ $amount }}</span></li>
        <?php

                            $regtotal = $amount * 0.13;

                            $rtotal = $amount + $regtotal;

                            ?>
       <li><span class="fa-li"><i class="fas fa-check"></i></span>HST 13%<span class="period" style="float:right;
      color: #fda12b;font-weight: bold;">$ {{ number_format($regtotal, 2)  }}</span></li>
                <hr>
                <li style="list-style-type: none;">Total amount payable<span class="period" style="float:right;font-weight: bold;color: #fda12b;">$ {{ number_format($rtotal,2)}}</span></li>
              </ul>



          </div>
        </div>

            </div>
            <div class="col-lg-2"></div>
        </div>



        <!-- Plus Tier -->
        <div class="row" style="margin-top:25px;">
             <div class="col-lg-2"></div>
             <div class="col-lg-8"  >
                   <div class="card mb-5 mb-lg-0" style="padding:10px;">
                          <h6 class="text-center" style="font-size:25px;font-weight:600">Complete Your Payment</h6>
              <div class="card-body">

               <form action="{{url('payment-make-post')}}" method="POST" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="" id="payment-form">
                   @csrf
                <input id="card-holder-name" name="holder_name" class='form-control' placeholder="Enter Card Holder Name" type="text" style="margin-bottom:20px;">

                <input type="number" id="card" name="card" placeholder="Card Number" class="form-control card-number">
                <div class="row mt-3">
                    <div class="col-lg-4"><input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" maxlength="3" id="cvv" name="cvv" placeholder="CVV" class="form-control card-cvc"></div>
                    <div class="col-lg-4"><input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" maxlength="2" id="mm" name="mm" placeholder="MM" class="form-control card-expiry-month"></div>
                    <div class="col-lg-4"><input type="text" onkeypress="if(event.which &lt; 48 || event.which &gt; 57 ) if(event.which != 8) return false;" id="yy" maxlength="4" name="yy" placeholder="YYYY" class="form-control card-expiry-year"></div>
                </div>

                <input type="hidden" name="service_amount" value="{{ number_format($rtotal,2)}}">
                <input type="hidden" name="booking_id" value="{{ $id }}">
          <br>



              <center>
                  <button type="submit" class="btn" style="color:white;font-weight:bold;background:green;opacity:1" id="card-button" data-secret="">
                    Pay Now
                  </button>
              </center>
               </form>

                {{-- <input type="hidden" name="name" id="name" value="{{$user->stripe_id}}">
                  <input type="hidden" name="priceId" id="priceId" value="{{$price_id}}"> --}}

            </div>
             </div>
             <div class="col-lg-2"></div>
            </div>

      </div>
    </div>
  </section>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>

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

           Stripe.setPublishableKey('pk_live_51H4ThcJ5SREt5PwvNVuthkswoxkMKololExDZy835JPptq4EyMexUtgltIaIt77Ft1m5Fs5tUgYGrnmzafRQGUl7002XHrLNsB');

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
