<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['vendor_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
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

	$vendor_id =  $service->real_escape_string($data['vendor_id']);
	$type =  $service->real_escape_string($data['type']);
	if($type == 'past')
	{
	$sel = $service->query("select * from tbl_order where vendor_id=".$vendor_id." and (o_status='Completed' or o_status='Cancelled')  order by id desc "); 	
	}
	else 
	{
  $sel = $service->query("select * from tbl_order where vendor_id=".$vendor_id." and o_status !='Completed' and o_status !='Cancelled' order by id desc "); 
	}
  $g=array();
  $po= array();
  if($sel->num_rows != 0)
  {
  while($row = $sel->fetch_assoc())
  {
	  $vdata = $service->query("select * from service_details where id=".$vendor_id."")->fetch_assoc();
	  $udata = $service->query("select * from tbl_user where id=".$row['uid']."")->fetch_assoc();
      $g['id'] = $row['id'];
      $g['status'] = $row['o_status'];
      $g['order_date'] = $row['odate'];
	  $g['total'] = $row['o_total'];
	  $g['customer_address'] = $row['address'];
	  $g['store_address'] = $vdata['full_address'];
	  $g['distance'] = number_format((float)distance($row['lats'], $row['longs'], $vdata['lats'], $vdata['longs'], "K"), 2, '.', '').' Kms';
      $po[] = $g;
	  
      
  }
  $returnArr = array("OrderHistory"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order History  Get Successfully!!!");
  }
  else 
  {
	  $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order  Not Found!!!");
  }
}
echo json_encode($returnArr);

?>