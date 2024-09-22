<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['order_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	 $order_id = $data['order_id'];
 $uid =  $data['uid'];
 
 
 
 $table="tbl_order";
  $field = array('o_status'=>'Cancelled','order_status'=>8,'comment_reject'=>'Cancelled By You');
  $where = "where uid=".$uid." and id=".$order_id."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
 $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order  Cancelled successfully!");
}
echo json_encode($returnArr);
?>