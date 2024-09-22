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
	$v = array();
	$cp = array(); 
	$d = array();
	$pop = array();
	$sec = array();
	
	
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


	
	$banner = $service->query("select * from banner where status=1");
$vbanner = array();
while($row = $banner->fetch_assoc())
{
	$vbanner['id'] = $row['id'];
	$vbanner['img'] = $row['img'];
    $v[] = $vbanner;
}

$cato = $service->query("select * from tbl_category where status=1");
$cat = array();
while($row = $cato->fetch_assoc())
{
	$cat['id'] = $row['id'];
	$cat['title'] = $row['title'];
	$cat['cat_img'] = $row['img'];
    $cp[] = $cat;
}


$sql_distance = $service->query("select * FROM zones where ST_Contains(coordinates, ST_GeomFromText('POINT(".$longs." ".$lats.")')) and status=1");

$pop = array();
	$pol = array();

while($row = $sql_distance->fetch_assoc())
{
	
	$query = $service->query("select * from service_details where  zone_id=".$row['id']." and status=1 limit 5");
	
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
$sec = array();
$list = array();
$section = $service->query("select * from tbl_section where status=1");
while($row = $section->fetch_assoc())
{
	$counter = $service->query("select * from section_item where status=1 and section_id=".$row['id']." limit 4")->num_rows;
	if($counter != 0)
	{
	$sec['section_id'] = $row['id'];
	$sec['cat_id'] = $row['cat_id'];
	$sec['section_title'] = $row['title'];
	$po = array();
	$lo = array();
	$item = $service->query("select * from section_item where status=1 and section_id=".$row['id']." limit 5");
	while($ko = $item->fetch_assoc())
	{
		$lo['item_title'] = $ko['title'];
		$lo['item_img'] = $ko['img'];
		$po[] = $lo;
	}
	$sec['item_list'] = $po;
	$list[] = $sec;
	}
}

	

	
	
$tbwallet = $service->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
if($uid == 0)
{
	$wallet = 0;
}
else 
{
	$wallet = $tbwallet['wallet'];
}
$kp = array('Banner'=>$v,'Catlist'=>$cp,"currency"=>$set['currency'],"Refer_Credit"=>$set['rcredit'],"wallet"=>$wallet,"Provider_Data"=>$pop,"SectionData"=>$list);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Home Data Get Successfully!","HomeData"=>$kp);

}
echo json_encode($returnArr);
?>