<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];
$lats = $data['lats'];
$longs = $data['longs'];

if($uid == '' or $longs == '' or $lats == '')
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
	
	$query = $service->query("select * from service_details where  zone_id=".$row['id']." and status=1");
	
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
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Provider Data Get Successfully!","ProviderData"=>$pop);
}
echo json_encode($returnArr);
?>