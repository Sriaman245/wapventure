<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if($data['pid'] == '' or $data['img'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
 $pid =  $service->real_escape_string($data['pid']);
 $img = $data['img'];
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$path = 'images/partner/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;

file_put_contents($fname, $data);
 
 $table="tbl_partner";
  $field = array('img'=>$path);
  $where = "where id=".$pid."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	  $c = $service->query("select * from tbl_partner where id=".$pid."")->fetch_assoc();
 $returnArr = array("partnerdata"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Image Upload Successfully!!");
}
echo  json_encode($returnArr);
?>