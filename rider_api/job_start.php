 <?php
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

$getkey = $service->query("select * from tbl_setting")->fetch_assoc();
define('ONE_KEY',$getkey['one_key']);
define('ONE_HASH',$getkey['one_hash']);


function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

$oid = $data['oid'];
$rider_id = $data['rider_id'];
if ($oid =='' or $rider_id =='')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
		
	$table="tbl_order";
	$timestamp = date("Y-m-d H:i:s");
		 $field = array('order_status'=>6,'o_status'=>'Job_start','job_start'=>$timestamp);
  $where = "where id=".$oid." and rid=".$rider_id."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	  
	  
		  $checks = $service->query("select * from tbl_order where id=".$oid."")->fetch_assoc(); 
	  $uid = $checks['uid'];
			$udata = $service->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['fname'].' '.$udata['lname'];

	  
	  $timestamp = date("Y-m-d H:i:s");

$title_main = "Job Start!!";
$description = $name.', Your Job #'.$oid.'Start Successfully.';
	   
$content = array(
       "en" => $name.', Your Job #'.$oid.' Start Successfully.'
   );
$heading = array(
   "en" => "Job Start!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'user_id', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.ONE_HASH));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

$content = array(
       "en" => 'Job Start!!'
   );
$heading = array(
   "en" => "Job Start!!"
);

$fields = array(
'app_id' => $set['d_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'store_id', 'relation' => '=', 'value' => $checks['vendor_id'])),
'contents' => $content,
'headings' => $heading
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['d_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
	   
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Job Start Successfully!!!!!");    
}
echo json_encode($returnArr);
?>