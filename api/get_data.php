<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
header('Content-type: text/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
$vendor_id = $data['vendor_id'];
if($vendor_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$pol = array();
	$pol['cov_fees'] = $set['cov_fees'];
	$pol['tax'] = 10;
$returnArr = array("CartData"=>$pol,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Get Required Data Founded!");
}
echo json_encode($returnArr);
?>