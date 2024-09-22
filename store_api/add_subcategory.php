<?php
require 'db.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

$vendor_id = $data['vendor_id'];
$status = $data['status'];
$cat_id = $data['cat_id'];
$title = $service->real_escape_string($data['title']);
$type = $data['type'];
$record_id = $data['record_id'];
$img = $data['img'];
if ($vendor_id =='' or $status == '' or $cat_id == '' or $title == '' or $type == '' or $img == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
 if($type == 'Add')
 {
	 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$path = 'images/subcategory/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;

file_put_contents($fname, $data);
$check = $service->query("select * from tbl_subcategory where vendor_id=".$vendor_id." and title='".$title."'")->num_rows;
if($check != 0)
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Already Added Subcategory!!");
}
else 
{
  $table="tbl_subcategory";
  $field_values=array("cat_id","title","img","status","vendor_id");
  $data_values=array("$cat_id","$title","$path","$status","$vendor_id");
  
      $h = new Fixxy();
	  $check = $h->serviceinsertdata_Api_Id($field_values,$data_values,$table);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Subcategory Upload Successfully Wait For Approvals!");
}
 }
 else
 {
	 
	 if($img == '0')
	 {
		 $table="tbl_subcategory";
  $field = array('cat_id'=>$cat_id,'title'=>$title,'status'=>$status);
  $where = "where id=".$record_id." and vendor_id=".$vendor_id."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	 }
	 else 
	 {
		
		 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$path = 'images/subcategory/'.uniqid().'.png';
$fname = dirname( dirname(__FILE__) ).'/'.$path;

file_put_contents($fname, $data);

	  $table="tbl_subcategory";
  $field = array('cat_id'=>$cat_id,'title'=>$title,'img'=>$path,'status'=>$status);
  $where = "where id=".$record_id." and vendor_id=".$vendor_id."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	 }
	 $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Subcategory Update Successfully!");
 }
}
echo json_encode($returnArr);
mysqli_close($service);
?>