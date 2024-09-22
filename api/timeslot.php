<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
header('Content-type: text/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
$vendor_id = $data['vendor_id'];
$cat_id = $data['cat_id'];
function current_date($dbs)
{
	$date = date('Y-m-d',strtotime('-1 day'));
$weekOfdays = array();
for($i =0; $i < $dbs; $i++){
    $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
    $weekOfdays[] = date('D d', strtotime($date));
}
return $weekOfdays;
}

function next_date($dbs)
{
	$date = date('Y-m-d');
$weekOfdays = array();
for($i =0; $i < $dbs; $i++){
    $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
    $weekOfdays[] = date('D d', strtotime($date));
}
return $weekOfdays;
}

if($vendor_id == '' or $cat_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$sel = $service->query("select * from tbl_timeslot where cat_id=".$cat_id."  and vendor_id=".$vendor_id."");
	$c = array();$p=array();
	while($row = $sel->fetch_assoc())
	{
		if($row['day_type'] == 0)
		{
			$c['status'] = 'current';
		$c['days'] = current_date($row['total_days']);	
		}
		else 
		{
			$c['status'] = 'next';
			$c['days'] = next_date($row['total_days']);;
		}
		$c['timeslot'] = explode(',',$row['timeslot']);
		$p[] = $c;
	}
	if(empty($p))
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Timeslot List Not Found !!");
	}
	else 
	{
	$returnArr = array("TimeslotData"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"TimeSloat And Date Get Successfully!!");
}
}
echo json_encode($returnArr);
?>