<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';



$data = json_decode(file_get_contents('php://input'), true);
if($data['rider_id'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$rider_id =  $service->real_escape_string($data['rider_id']);
    
    
    
$check = $service->query("select * from tbl_rnoti where rid=".$rider_id."");
$op = array();
while($row = $check->fetch_assoc())
{
		$op[] = $row;
}
$returnArr = array("NotificationData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Notification List Get Successfully!!");
}
echo json_encode($returnArr);