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
            
            <h6 class="card-price text-center" style="font-size:30px;font-weight:600">Monthly Package</h6>
            <hr>
            <ul class="fa-ul">
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Membership monthly charges<span class="period" style="float:right;
    color: #fda12b;font-weight: bold;">$79.99</span></li>
              <li><span class="fa-li"><i class="fas fa-check"></i></span>Per Additional service charges<span class="period" style="float:right;
    color: #fda12b;font-weight: bold;">$ {{$monthly_amount}}</span></li>
              <hr>
              <li style="list-style-type: none;">Total amount payable<span class="period" style="float:right;font-weight: bold;color: #fda12b;">$ {{$total_monthly}}</span></li>
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
            
             <input id="card-holder-name" class='form-control' placeholder="Enter Card Holder Name" type="text" style="margin-bottom:20px;">

<!-- Stripe Elements Placeholder -->
            <div id="card-element"></div>
            @php
            $user = Auth::user();
            if($user->stripe_id == ''){
            $user_id = $user->createAsStripeCustomer();
            }
            
            $intent = $user->createSetupIntent();
            use App\ProService;
            $services = ProService::where('pro_id',Auth::user()->id)->count();
            $price_id = 'price_1JHO4QJ5SREt5PwvndyCxm7a';
            if($services == 1){
                $price_id = 'price_1JHO4QJ5SREt5PwvndyCxm7a';
            }elseif($services == 2){
                
                $price_id = 'price_1JHO4QJ5SREt5PwvndyCxm7a';
            }else{
                
                $price_id = 'price_1JHO4QJ5SREt5PwvndyCxm7a';
            }
            @endphp
            <center><button type="button" class="btn" style="color:white;font-weight:bold;background:green;opacity:1" id="card-button" data-secret="{{ $intent->client_secret }}">
                Pay Now
            </button></center>
              
              <input type="hidden" name="name" id="name" value="{{$user->stripe_id}}">
                <input type="hidden" name="priceId" id="priceId" value="{{$price_id}}">
           
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
<script src="https://js.stripe.com/v3/"></script>

<script>
        const stripe = Stripe('pk_live_51H4ThcJ5SREt5PwvNVuthkswoxkMKololExDZy835JPptq4EyMexUtgltIaIt77Ft1m5Fs5tUgYGrnmzafRQGUl7002XHrLNsB');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        
    
        cardElement.mount('#card-element');
        
        
        </script>
        <script>
        
        const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    
    cardButton.addEventListener('click', async (e) => {
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );
    
        if (error) {
            // Display "error.message" to the user...
        } else {
            $.ajax('/create-subs', {
                type: 'POST',  // http method
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))
                  },
                data: { paymentMethod: paymentMethod.id },  // data to submit
                success: function (data, status, xhr) {
                location.href = "http://meinhaus.ca/approval";
                },
                error: function (jqXhr, textStatus, errorMessage) {
                        alert(errorMessage);
                        
                }
            });
            // The card has been verified successfully...
        }
    });
    
    
</script>

</html>