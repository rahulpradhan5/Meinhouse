<?php
	session_start();
	require_once("lib/autoload.php");


/*	Braintree_Configuration::environment("sandbox");
	Braintree_Configuration::merchantId("rt4wg69wkx4xtfy5");
	Braintree_Configuration::publicKey("b787wzpvj34z5gbz");
	Braintree_Configuration::privateKey("e696be8bf9dab32a968e98886c96d66e");*/


// 	$gateway = new Braintree_Gateway([
//     'environment' => 'sandbox',
//     'merchantId' => 'rt4wg69wkx4xtfy5',
//     'publicKey' => 'b787wzpvj34z5gbz',
//     'privateKey' => 'e696be8bf9dab32a968e98886c96d66e']);


	$gateway = new Braintree_Gateway([
  'environment' => 'sandbox',
  'merchantId' => 'zdxj4bwc8yhfwq22',
  'publicKey' => '58bhcymjsfy9yv8d',
  'privateKey' => 'ee9abbd2fa3ce323d3dc0d2a99b7b042'
]);


    //print($gateway);

 ?>
