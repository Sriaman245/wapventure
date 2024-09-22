<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['orderid'] == ''   or $data['provider_rate'] == ''  or $data['provider_text'] == '' or $data['rider_rate'] == '' or $data['rider_text'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$uid = $data['uid'];
	$orderid = $data['orderid'];
	$provider_rate = $data['provider_rate'];
	$provider_text = $data['provider_text'];
	$rider_rate = $data['rider_rate'];
	$rider_text = $data['rider_text'];
	
	$table="tbl_order";
  $field = array('provider_rate'=>$provider_rate,'provider_text'=>$provider_text,'rider_rate'=>$rider_rate,'rider_text'=>$rider_text,'is_rate'=>'1');
  $where = "where uid=".$uid." and id=".$orderid."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Rate Updated Successfully!!!");
}
echo json_encode($returnArr);