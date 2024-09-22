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
	
	$count = $service->query("select * from service_details where id=".$vendor_id."");
	if($count->num_rows != 0)
	{
		$db = $count->fetch_assoc();
	$cy = $service->query("select * from tbl_category where  id IN(".$db['catid'].") and status=1");
	$p = array();
	$q = array();
	while($adata = $cy->fetch_assoc())
	{
		
		$p['cat_id'] = $adata['id'];
		$p['cat_name'] = $adata['title'];
		$q[] = $p;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Category List Get Successfully!!!","Catlist"=>$q);
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Category List Not Found!!");
	}
}
echo  json_encode($returnArr);
?>