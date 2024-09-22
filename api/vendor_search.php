<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
$keyword = $data['keyword'];
$lats = $data['lats'];
$longs = $data['longs'];
$cat_id = $data['cat_id'];
if($keyword == '' or $lats == '' or $longs == '' or $cat_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	$sql_distance = $service->query("select * FROM zones where ST_Contains(coordinates, ST_GeomFromText('POINT(".$longs." ".$lats.")')) and status=1");

$pop = array();
	$pol = array();

while($row = $sql_distance->fetch_assoc())
{
	if($cat_id != 0)
	{
		$query = $service->query("select * from service_details where  zone_id=".$row['id']." and catid REGEXP  '\\\b".$cat_id."\\\b' and title COLLATE utf8_general_ci like '%".$keyword."%' and status=1");
	}
	else 
	{
	$query = $service->query("select * from service_details where  zone_id=".$row['id']." and title COLLATE utf8_general_ci like '%".$keyword."%' and status=1");
	}
	while($lol = $query->fetch_assoc())
	{
   $check_service = $service->query("SELECT * FROM `tbl_service` where vendor_id=".$lol['id']." and is_approve=1 order by price limit 1");
   $servicedata = $check_service->fetch_assoc();
   if($check_service->num_rows != 0)
   {
    $pol['provider_id'] = $lol['id'];
	$pol['provider_img'] = $lol['rimg'];
	$pol['provider_title'] = $lol['title'];
	$pol['provider_rate'] = $lol['rate'];
	$pol['start_from'] = $servicedata['price'] - ($servicedata['price'] * $servicedata['discount']/100);
	$pop[] = $pol;
	}
	
}
}

	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Vendor Data Get Successfully!","VendorSearchData"=>$pop);	
}
	echo  json_encode($returnArr);
?>