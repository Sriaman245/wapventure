<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';



$data = json_decode(file_get_contents('php://input'), true);
if($data['vendor_id'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$vendor_id =  $service->real_escape_string($data['vendor_id']);
    
    
    
$check = $service->query("select * from tbl_snoti where sid=".$vendor_id."");
$op = array();
while($row = $check->fetch_assoc())
{
		$op[] = $row;
}
$returnArr = array("NotificationData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Notification List Get Successfully!!");
}
echo json_encode($returnArr);