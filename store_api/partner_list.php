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
	
	$count = $service->query("select * from  tbl_partner where vendor_id=".$vendor_id."")->num_rows;
	if($count != 0)
	{
	$cy = $service->query("select * from  tbl_partner where vendor_id=".$vendor_id."");
	$p = array();
	$q = array();
	while($adata = $cy->fetch_assoc())
	{
		$p['partner_id'] = $adata['id'];
		$p['partner_name'] = $adata['title'];
		$p['email'] = $adata['email'];
		$p['ccode'] = $adata['ccode'];
		$p['mobile'] = $adata['mobile'];
		$p['password'] = $adata['password'];
		$p['status'] = $adata['status'];
		$p['img'] = $adata['img'];
		$q[] = $p;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Partner List Get Successfully!!!","Partnerlist"=>$q);
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Partner List Not Found!!");
	}
}
echo  json_encode($returnArr);


?>