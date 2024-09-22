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
	
	$count = $service->query("select * from  tbl_coupon where vendor_id=".$vendor_id."")->num_rows;
	if($count != 0)
	{
	$cy = $service->query("select * from  tbl_coupon where vendor_id=".$vendor_id."");
	$p = array();
	$q = array();
	while($adata = $cy->fetch_assoc())
	{
		$p['coupon_id'] = $adata['id'];
		$p['coupon_img'] = $adata['coupon_img'];
		$p['title'] = $adata['title'];
		$p['coupon_code'] = $adata['coupon_code'];
		$p['subtitle'] = $adata['subtitle'];
		$p['expire_date'] = $adata['expire_date'];
		$p['min_amt'] = $adata['min_amt'];
		$p['coupon_val'] = $adata['coupon_val'];
		$p['description'] = $adata['description'];
		$p['status'] = $adata['status'];
		$q[] = $p;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Coupon List Get Successfully!!!","Couponlist"=>$q);
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Coupon List Not Found!!");
	}
}
echo  json_encode($returnArr);


?>