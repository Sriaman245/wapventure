<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];
header('Content-type: text/json');
if($uid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	$count = $service->query("select * from tbl_address where uid=".$uid."")->num_rows;
	if($count != 0)
	{
	$cy = $service->query("select * from tbl_address where uid=".$uid."");
	$p = array();
	$q = array();
	while($adata = $cy->fetch_assoc())
	{
		$p['id'] = $adata['id'];
		$p['uid'] = $adata['uid'];
		$p['hno'] = $adata['houseno'];
		$p['address'] = $adata['address'];
		$p['c_name'] = $adata['c_name'];
		$p['c_number'] = $adata['c_number'];
		$p['lat_map'] = $adata['lat_map'];
		$p['long_map'] = $adata['long_map'];
		$p['landmark'] = $adata['landmark'];
		$p['type'] = $adata['type'];
		$q[] = $p;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address List Get Successfully!!!","AddressList"=>$q);
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Address List Not Found!!");
	}
}
echo  json_encode($returnArr);


?>