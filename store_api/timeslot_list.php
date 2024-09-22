<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
$vendor_id = $data['vendor_id'];
header('Content-type: text/json');
if($vendor_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	$count = $service->query("select * from  tbl_timeslot where vendor_id=".$vendor_id."")->num_rows;
	if($count != 0)
	{
	$cy = $service->query("select * from  tbl_timeslot where vendor_id=".$vendor_id."");
	$p = array();
	$q = array();
	while($adata = $cy->fetch_assoc())
	{
		$p['time_id'] = $adata['id'];
		$p['cat_id'] = $adata['cat_id'];
		$p['sub_id'] = $adata['sub_id'];
		$cdata = $service->query("select * from tbl_category where id=".$adata['cat_id']."")->fetch_assoc();
		$p['cat_name'] = $cdata['title'];
		$p['day_type'] = $adata['day_type'];
		$p['total_days'] = $adata['total_days'];
		$p['timeslot'] = $adata['timeslot'];
		$q[] = $p;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Timeslot List Get Successfully!!!","Timeslotlist"=>$q);
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Timeslot List Not Found!!");
	}
}
echo  json_encode($returnArr);


?>