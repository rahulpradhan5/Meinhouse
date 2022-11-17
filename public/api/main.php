<?php
	require_once("braintree_init.php");
	require_once("lib/Braintree.php");
    $email = isset($_POST['email'])?$_POST['email']:'';

    //$email = isset($_GET['email'])?$_GET['email']:'';

    $custId = isset($_POST['custId'])?$_POST['custId']:'';


	if(empty($custId)){
	$result = $gateway->customer()->create([
    'email' =>  $email
    ]);
    //print_r($result);

    if($result->success == true){
        $custId = $result->customer->id;
        $userdata['responsecode'] = "200";
        $userdata['clientToken'] = $gateway->clientToken()->generate(["customerId" => $custId]);
        $userdata['clientId'] = $custId;
    }else{
        $userdata['responsecode'] = "Error";
    }
	}else{
	    $userdata['responsecode'] = "200";
        $userdata['clientToken'] = $gateway->clientToken()->generate(["customerId" => $custId]);
        $userdata['clientId'] =$custId;
    }
    header('Content-Type: application/json');
	    echo json_encode($userdata);

	    error_reporting(E_ALL);
        ini_set('display_errors', 'On');

	    //var_dump($userdata, $email);

# true




   # Generated customer id

	//$response['clientToken'] = $gateway->clientToken()->generate(["customerId" => $aCustomerId]);



 ?>
