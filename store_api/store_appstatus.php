<?php
require 'db.php';

require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

$vendor_id = $data['vendor_id'];
$status = $data['status'];
if ($vendor_id =='')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$table="service_details";
  $field = array('rstatus'=>$status);
  $where = "where id=".$vendor_id."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	  
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");	
}
echo json_encode($returnArr);
mysqli_close($service);
?>