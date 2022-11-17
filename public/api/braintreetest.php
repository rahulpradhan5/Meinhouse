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
echo $jsonoutput->clientToken;
 
//curl_close($handle);

//die;

?>

<script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>

<script
  data-main="main.js"
  src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.1/require.min.js"
>
   
   var submitBtn = document.getElementById('my-submit');
var form = document.getElementById('my-sample-form');

braintree.client.create({
  authorization: <?php echo $jsonoutput->clientToken; ?>
}, clientDidCreate);

function clientDidCreate(err, client) {
  braintree.hostedFields.create({
    client: client,
    styles: {
      'input': {
        'font-size': '16pt',
        'color': '#3A3A3A'
      },

      '.number': {
        'font-family': 'monospace'
      },

      '.valid': {
        'color': 'green'
      }
    },
    fields: {
      number: {
        selector: '#card-number'
      },
      cvv: {
        selector: '#cvv'
      },
      expirationDate: {
        selector: '#expiration-date'
      }
    }
  }, hostedFieldsDidCreate);
}

function hostedFieldsDidCreate(err, hostedFields) {
  submitBtn.addEventListener('click', submitHandler.bind(null, hostedFields));
  submitBtn.removeAttribute('disabled');
}

function submitHandler(hostedFields, event) {
  event.preventDefault();
  submitBtn.setAttribute('disabled', 'disabled');

  hostedFields.tokenize(function (err, payload) {
    if (err) {
      submitBtn.removeAttribute('disabled');
      console.error(err);
    } else {
      form['payment_method_nonce'].value = payload.nonce;
      form.submit();
    }
  });
} 
    
</script>

<form action="/" id="my-sample-form">
  <input type="hidden" name="payment_method_nonce">
  <label for="card-number">Card Number</label>
  <div id="card-number"></div>

  <label for="cvv">CVV</label>
  <div id="cvv"></div>

  <label for="expiration-date">Expiration Date</label>
  <div id="expiration-date"></div>

  <input id="my-submit" type="submit" value="Pay" disabled/>
</form>