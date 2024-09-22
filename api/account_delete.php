<?php
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
 $uid = $data['uid'];
 $table="tbl_user";
  $field = array('status'=>'0');
  $where = "where id=".$uid."";
 
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
 $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"User Remove Successfully!!");
}
echo  json_encode($returnArr);
?>