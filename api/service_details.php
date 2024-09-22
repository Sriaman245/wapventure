<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
$vendor_id = $data['vendor_id'];
$cat_id = $data['cat_id'];
header('Content-type: text/json');
if($vendor_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$v = array();
	$pol = array();
	$usb = array();
	$ser = array();
	$coupon = array();
	$banner = $service->query("select * from tbl_cover where cat_id=".$cat_id." and vendor_id=".$vendor_id."")->fetch_assoc();
	if(empty($banner['id']))
	{
	}
	else 
		
		{
	$getlist = $service->query("select * from tbl_cover_images where cover_id=".$banner['id']."");
while($row = $getlist->fetch_assoc())
{
	
    $v[] = $row['text'];
}
		}
		
		$timestamp = date("Y-m-d");	
	$sel = $service->query("select * from tbl_coupon where status=1 and vendor_id =".$vendor_id."");
while($row = $sel->fetch_assoc())
{
    if($row['expire_date'] < $timestamp)
	{
		$service->query("update tbl_coupon set status=0 where id=".$row['id']." and vendor_id =".$vendor_id."");
	}
	else 
	{
		$pol['id'] = $row['id'];
		$pol['coupon_img'] = $row['coupon_img'];
		
		$pol['expire_date'] = $row['expire_date'];
		
		$pol['description'] = $row['description'];
		$pol['subtitle'] = $row['subtitle'];
		$pol['coupon_val'] = $row['coupon_val'];
		$pol['coupon_code'] = $row['coupon_code'];
		$pol['title'] = $row['title'];
		$pol['min_amt'] = $row['min_amt'];
		$coupon[] = $pol;
	}	
	
}


$query = $service->query("select * from service_details where  id=".$vendor_id." and status=1")->fetch_assoc();
$check_service = $service->query("SELECT * FROM `tbl_service` where vendor_id=".$vendor_id." and is_approve=1 and status=1 order by price limit 1");
   $servicedata = $check_service->fetch_assoc();
$pol['provider_id'] = $query['id'];
	$pol['provider_img'] = $query['rimg'];
	$pol['provider_title'] = $query['title'];
	$pol['provider_rate'] = $query['rate'];
	$pol['start_from'] = $servicedata['price'] - ($servicedata['price'] * $servicedata['discount']/100);


	$getlist = $service->query("select * from tbl_subcategory where cat_id=".$cat_id." and vendor_id=".$vendor_id." and is_approve=1 and status=1");
while($row = $getlist->fetch_assoc())
{
	$check_service = $service->query("select * from tbl_service where cat_id=".$cat_id." and sub_id=".$row['id']." and vendor_id=".$vendor_id." and is_approve=1 and status=1")->num_rows;
	if($check_service != 0)
	{
    $usb[] = $row;
	}
}

$getlist = $service->query("select * from tbl_subcategory where cat_id=".$cat_id." and vendor_id=".$vendor_id." and is_approve=1");
$vbanner = array();
while($row = $getlist->fetch_assoc())
{
	$check_service = $service->query("select * from tbl_service where cat_id=".$cat_id." and sub_id=".$row['id']." and vendor_id=".$vendor_id." and is_approve=1 and status=1")->num_rows;
	if($check_service != 0)
	{
    $vbanner['sub_id'] = $row['id'];
	$vbanner['sub_title'] = $row['title'];
	$vbpos = array();
	$plist = array();
	$services = $service->query("select * from tbl_service where cat_id=".$cat_id." and sub_id=".$row['id']." and vendor_id=".$vendor_id." and is_approve=1 and status=1");
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
	$vbanner['servicelist'] = $plist;
     	$ser[] = $vbanner;
	}
}



$kp = array('Cover'=>$v,'Provider'=>$pol,'Subcategory'=>$usb,'SubWiseServiceData'=>$ser,'CouponList'=>$coupon);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Home Data Get Successfully!","ServiceData"=>$kp);	
}
echo  json_encode($returnArr);
?>