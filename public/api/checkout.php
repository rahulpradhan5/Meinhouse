<?php 
	require_once("braintree_init.php");
	require_once "lib/Braintree.php";
    
 	$nonce=$_POST['nonce'];
 	$amount=$_POST['amount'];
 	$custId=$_POST['custId'];
 	
    //die;
	
	//$nonce = "test";
	//$amount = "10.00"
	
	$result=$gateway->transaction()->sale([
  'amount' => $amount,
   'customerId' => $custId,
  'paymentMethodNonce' => $nonce,
  'options' => [
     'storeInVaultOnSuccess' => true,
    'submitForSettlement' => True
  ]
]);
	
	
	/*$result=Braintree_Transaction::sale([
		'amount'=>$amount,
		'paymentMethodNonce'=>$nonce,
		'options'=>	[
			'submitForSettlement'=>True
		]
	]);*/
	
	header('Content-Type: application/json');
	echo json_encode($result);
	
	
 ?>