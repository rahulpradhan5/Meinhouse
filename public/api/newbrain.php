<?php 
	
//echo 'Curl: ', function_exists('curl_version') ? 'Enabled' : 'Disabled';

 $handle = curl_init();
 
$url = "http://quantumits.online/erikhall/public/api/main.php";
 
// Set the url
curl_setopt($handle, CURLOPT_URL, $url);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 
$output = curl_exec($handle);
$jsonoutput = json_decode($output);
$clientToken = $jsonoutput->clientToken;
$clientId = $jsonoutput->clientId;
 
//curl_close($handle);

//die;

?>
<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="utf-8">
   <title>Checkout</title>
 </head>
 <body>
   <div id="dropin-container"></div>
   <button id="submit-button">Purchase</button>
   <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

   

   <script>
     var submitButton = document.querySelector('#submit-button');

     braintree.dropin.create({
          authorization: '<?php echo $clientToken; ?>',
          container: '#dropin-container',
          paypal: {
            flow: 'checkout',
            amount: '10.00',
            currency: 'USD'
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
           
                 console.log(payload.nonce);
                 data = payload.nonce
                 $.post("checkout.php", function(result){
                     
                     console.log(result)
                 });
            
           // Send payload.nonce to your server
         });
       });
     });
   </script>
 </body>
</html>