<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="utf-8">
   <title>Checkout</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

 </head>
 <body>
   <div id="dropin-container"></div>
   <button class="btn btn-primary text-center" id="submit-button" style="margin-left: 586px;
    margin-top: 30px;">Pay Now</button>
   <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>



   <script>
     var submitButton = document.querySelector('#submit-button');
     braintree.dropin.create({
          authorization: '{{$clientToken}}',
          container: '#dropin-container',
          paypal: {
            flow: 'vault',
          }
        }, function (err, dropinInstance) {
       if (err) {
         // Handle any errors that might've occurred when creating Drop-in
         console.error(err);
         return;
       }
       submitButton.addEventListener('click', function () {
         dropinInstance.requestPaymentMethod(function (err, payload) {
           if (err) {
             // Handle errors in requesting payment method
           }

                //  console.log(err);
                //  console.log(payload);
                 data = payload.nonce
                 $.post("https://meinhaus.ca/public/api/checkout.php",{nonce:data,amount:'<?php echo $amount ?>',custId:'<?php echo $clientId ?>'} ,function(result){
                     console.log(result)
                     if(result['success']){
                            $.post("{{route('pro.busines.save')}}",{_token: "{{ csrf_token() }}",transaction_id:result['transaction']['id'],amount:'<?php echo $amount ?>',custId:'<?php echo $clientId ?>'} ,function(result1){
                                location.href = "{{route('pro-business')}}";
                            });
                     }else{
                         console.log('jjjj')
                     }
                 });

           // Send payload.nonce to your server
         });
       });
     });
   </script>
 </body>
</html>
