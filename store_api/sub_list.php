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
	
	$count = $service->query("select * from tbl_subcategory where vendor_id=".$vendor_id."")->num_rows;
	if($count != 0)
	{
	$cy = $service->query("select * from tbl_subcategory where vendor_id=".$vendor_id."");
	$p = array();
	$q = array();
	while($adata = $cy->fetch_assoc())
	{
		$p['sub_id'] = $adata['id'];
		$p['cat_id'] = $adata['cat_id'];
		$cdata = $service->query("select * from tbl_category where id=".$adata['cat_id']."")->fetch_assoc();
		$p['cat_name'] = $cdata['title'];
		$p['sub_title'] = $adata['title'];
		$p['sub_img'] = $adata['img'];
		$p['status'] = $adata['status'];
		$p['is_approve'] = $adata['is_approve'];
		$q[] = $p;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Subcategory List Get Successfully!!!","Subcatlist"=>$q);
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Subcategory List Not Found!!");
	}
}
echo  json_encode($returnArr);


?>