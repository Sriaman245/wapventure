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
	
	$count = $service->query("select * from  tbl_service where vendor_id=".$vendor_id."")->num_rows;
	if($count != 0)
	{
	$cy = $service->query("select * from  tbl_service where vendor_id=".$vendor_id."");
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
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Service List Get Successfully!!!","Servicelist"=>$q);
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Service List Not Found!!");
	}
}
echo  json_encode($returnArr);


?>