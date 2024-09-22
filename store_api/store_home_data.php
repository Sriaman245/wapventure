<?php
require 'db.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$vendor_id = $data['vendor_id'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
      return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
  } else {
      return $miles;
  }
}

if($vendor_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$report = array();
	$report['total_service'] = $service->query("select * from tbl_service where vendor_id=".$vendor_id."")->num_rows;
	$report['total_timeslot'] = $service->query("select * from tbl_timeslot where vendor_id=".$vendor_id."")->num_rows;
	$report['total_subcat'] = $service->query("select * from tbl_subcategory where vendor_id=".$vendor_id."")->num_rows;
	$sales  = $service->query("select sum((o_total-(tax+conv_fee)) - (o_total-(tax+conv_fee)) * pcommission/100) as full_total from tbl_order where o_status='Completed'  and  vendor_id=".$vendor_id."")->fetch_assoc();
            $payout =   $service->query("select sum(amt) as full_payout from payout_setting where vendor_id=".$vendor_id."")->fetch_assoc();
                 $bs = 0;
				
				
				 if($sales['full_total'] == ''){}else {$bs = number_format((float)($sales['full_total']) - $payout['full_payout'], 2, '.', ''); }
	$report['total_earning'] = $bs;
	
	$checkrate = $service->query("SELECT *  FROM tbl_order where vendor_id=".$vendor_id." and o_status='Completed' and provider_rate !=0")->num_rows;
	$bv=0;
		if($checkrate !=0)
		{
			$rdata_rest = $service->query("SELECT sum(provider_rate)/count(*) as rate_rest FROM tbl_order where vendor_id=".$vendor_id." and o_status='Completed' and provider_rate !=0")->fetch_assoc();
			$bv =  number_format((float)$rdata_rest['rate_rest'], 2, '.', '');
		}
		else 
		{
			$sdata = $service->query("SELECT * FROM `service_details` where id=".$vendor_id."")->fetch_assoc();
		   $bv = floatval($sdata['rate']);
		}
		
	$report['review'] = $bv;
	$report['payout'] = 0;
	$report['withdraw_limit'] = intval($set['pstore']);
	$report['total_coupon'] = $service->query("select * from tbl_coupon where vendor_id=".$vendor_id."")->num_rows;
	$report['total_partner'] = $service->query("select * from tbl_partner where vendor_id=".$vendor_id."")->num_rows;
	$report['total_image'] = $service->query("select * from tbl_cover where vendor_id=".$vendor_id."")->num_rows;
	$report['total_orders'] = $service->query("select * from tbl_order where vendor_id=".$vendor_id."")->num_rows;
	
	$cy = $service->query("select * from  tbl_service where vendor_id=".$vendor_id." order by id desc limit 4");
	$p = array();
	$q = array();
	while($adata = $cy->fetch_assoc())
	{
		$p['service_id'] = $adata['id'];
		$p['cat_id'] = $adata['cat_id'];
		$p['sub_id'] = $adata['sub_id'];
		$cdata = $service->query("select * from tbl_category where id=".$adata['cat_id']."")->fetch_assoc();
		$sdata = $service->query("select * from tbl_subcategory where id=".$adata['sub_id']."")->fetch_assoc();
		$p['cat_name'] = $cdata['title'];
		$p['subcat_name'] = $sdata['title'];
		$p['img'] = $adata['img'];
		$p['video'] = $adata['video'];
		$p['service_type'] = $adata['service_type'];
		$p['title'] = $adata['title'];
		$p['take_time'] = $adata['take_time'];
		$p['max_quantity'] = $adata['max_quantity'];
		$p['price'] = $adata['price'];
		$p['discount'] = $adata['discount'];
		$p['service_desc'] = $adata['service_desc'];
		$p['status'] = $adata['status'];
		$p['is_approve'] = $adata['is_approve'];
		$q[] = $p;
	}
	$sel = $service->query("select * from tbl_order where vendor_id=".$vendor_id." and o_status !='Completed' and o_status !='Cancelled' order by id desc limit 1")->fetch_assoc(); 
	$order = array();
	if(empty($sel['id']))
	{
	}
	else 
	{
	$vdata = $service->query("select * from service_details where id=".$sel['vendor_id']."")->fetch_assoc();
	  $udata = $service->query("select * from tbl_user where id=".$sel['uid']."")->fetch_assoc();
      $order['id'] = $sel['id'];
      $order['status'] = $sel['o_status'];
      $order['order_date'] = $sel['odate'];
	  $order['total'] = $sel['o_total'];
	  $order['customer_address'] = $sel['address'];
	  $order['store_address'] = $vdata['full_address'];
	  $order['distance'] = number_format((float)distance($sel['lats'], $sel['longs'], $vdata['lats'], $vdata['longs'], "K"), 2, '.', '').' Kms';
	}
	if(empty($order))
	{
		$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Home List Get Successfully!!!","Servicelist"=>$q,"currency"=>$set['currency'],"report_data"=>$report,"recent_order"=>NULL);
	}
	else 
	{
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Home List Get Successfully!!!","Servicelist"=>$q,"currency"=>$set['currency'],"report_data"=>$report,"recent_order"=>$order);
}
}
echo  json_encode($returnArr);


?>