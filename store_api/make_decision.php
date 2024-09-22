 <?php
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';

$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
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
$status = $data['status'];
$comment_reject = $data['comment_reject'];
if ($oid =='' or $status =='' or $comment_reject == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
		
	$table="tbl_order";
	if($status == 1)
	{
  $field = array('a_status'=>'1','order_status'=>'1');
	}
	else 
	{
		 $field = array('a_status'=>'2','order_status'=>'2','o_status'=>'Cancelled','comment_reject'=>$comment_reject);
	} 
  $where = "where id=".$oid."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	  
	  if($status == 1)
	  {
		   $checks = $service->query("select * from tbl_order where id=".$oid."")->fetch_assoc(); 
	  $uid = $checks['uid'];
			$udata = $service->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['name'];

	  
	  $timestamp = date("Y-m-d H:i:s");

$title_main = "Order Confirmed!!";
$description = $name.', Your Order #'.$oid.' Has Been Confirmed.';
	   
$content = array(
       "en" => $name.', Your Order #'.$oid.' Has Been Confirmed.'
   );
$heading = array(
   "en" => "Order Confirmed!!"
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
       "en" => 'New Order Arrival!!'
   );
$heading = array(
   "en" => "Check Order And Accept!!"
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
	  
	  }
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");    
}
echo json_encode($returnArr);
?>