<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
$keyword = $data['keyword'];
$vendor_id = $data['vendor_id'];
if($keyword == '' or $vendor_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
$vbpos = array();
	$plist = array();
	if($vendor_id != 0)
	{
		$services = $service->query("select * from tbl_service where title COLLATE utf8_general_ci like '%".$keyword."%' and vendor_id=".$vendor_id."  and is_approve=1 and status=1");
	while($kls = $services->fetch_assoc())
	{
		$vbpos['service_id'] = $kls['id'];
		$vbpos['img'] = $kls['img'];
		$vbpos['video'] = $kls['video'];
		$vbpos['service_type'] = $kls['service_type'];
		$vbpos['title'] = $kls['title'];
		$vbpos['take_time'] = $kls['take_time'];
		$vbpos['max_quantity'] = $kls['max_quantity'];
		$vbpos['price'] = $kls['price'];
		$vbpos['discount'] = $kls['discount'];
		$vbpos['service_desc'] = $kls['service_desc'];
		$vbpos['status'] = $kls['status'];
		$vbpos['is_approve'] = $kls['is_approve'];
		$plist[] = $vbpos;
	}
	}
	else 
	{
	$services = $service->query("select * from tbl_service where title COLLATE utf8_general_ci like '%".$keyword."%'  and is_approve=1 and status=1");
	while($kls = $services->fetch_assoc())
	{
		$vbpos['service_id'] = $kls['id'];
		$vbpos['img'] = $kls['img'];
		$vbpos['video'] = $kls['video'];
		$vbpos['service_type'] = $kls['service_type'];
		$vbpos['title'] = $kls['title'];
		$vbpos['take_time'] = $kls['take_time'];
		$vbpos['max_quantity'] = $kls['max_quantity'];
		$vbpos['price'] = $kls['price'];
		$vbpos['discount'] = $kls['discount'];
		$vbpos['service_desc'] = $kls['service_desc'];
		$vbpos['status'] = $kls['status'];
		$vbpos['is_approve'] = $kls['is_approve'];
		$plist[] = $vbpos;
	}
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Service Data Get Successfully!","ServiceSearchData"=>$plist);	
}
	echo  json_encode($returnArr);
?>