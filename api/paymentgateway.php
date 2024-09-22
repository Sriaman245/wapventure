<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
header('Content-type: text/json');
$sel = $service->query("select * from tbl_payment_list where id!=3");
$myarray = array();
while($row = $sel->fetch_assoc())
{
	$myarray[] = $row;
}
$returnArr = array("paymentdata"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Payment Gateway List Founded!");
echo json_encode($returnArr);
?> 