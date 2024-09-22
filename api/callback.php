<?php
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
$curl = curl_init();
header('Content-type: text/json');
$kb = $service->query("SELECT * FROM `tbl_payment_list` where id=9")->fetch_assoc();
$kk = explode(',',$kb['attributes']);;
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
  die('No reference supplied');
}

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer ".$kk[1],
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
    // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response);

if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  // Give value
  
  echo "Transaction was successful";
}
else 
{
	echo "Transaction was Cancelled";
}