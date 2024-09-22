<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
$uid =  $data['uid'];
 $vp = $service->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	 if($vp['wallet'] >= $data['wal_amt'])
	 {
$vendor_id = $data['vendor_id'];
$catid = $data['catid'];
$p_method_id = $data['p_method_id'];
$tax = $data['tax'];
$full_address = strip_tags(mysqli_real_escape_string($service,$data['full_address']));
$timestamp = date("Y-m-d");
$time = $data['time'];
$date = $data['date'];
$wal_amt = number_format((float)$data['wal_amt'], 2, '.', '');
$cou_amt = number_format((float)$data['cou_amt'], 2, '.', '');
$cou_id = $data['cou_id'];
$transaction_id = $data['transaction_id'];
$product_total = number_format((float)$data['product_total'], 2, '.', '');
$product_subtotal = number_format((float)$data['subtotal'], 2, '.', '');
$conv_fee = $data['conv_fee'];
$tip = $data['tip'];
$lats = $data['lats'];
$longs = $data['longs'];
$cdata = $service->query("select * from tbl_category where id=".$data['catid']."")->fetch_assoc();
		
		$cat_name = mysqli_real_escape_string($service,$cdata['title']);
		
		
$table="tbl_order";
  $field_values=array("cat_name","tax","vendor_id","uid","odate","p_method_id","address","o_total","subtotal","trans_id","catid","time","date","wal_amt","conv_fee","tip","cou_amt","cou_id","lats","longs");
  $data_values=array("$cat_name","$tax","$vendor_id","$uid","$timestamp","$p_method_id","$full_address","$product_total","$product_subtotal","$transaction_id","$catid","$time","$date","$wal_amt","$conv_fee","$tip","$cou_amt","$cou_id","$lats","$longs");
  
      $h = new Fixxy();
	  $oid = $h->serviceinsertdata_Api_Id($field_values,$data_values,$table);
	

	  $ProductData = $data['ProductData'];
for($i=0;$i<count($ProductData);$i++)
{

$title = mysqli_real_escape_string($service,$ProductData[$i]['title']);

$cost = $ProductData[$i]['cost'];
$qty = $ProductData[$i]['qty'];
$discount = $ProductData[$i]['discount'];
$pimg = $ProductData[$i]['pimg'];
$actual_discount = $ProductData[$i]['actual_discount'];

$table="tbl_order_product";
  $field_values=array("oid","pquantity","ptitle","pdiscount","pprice","actual_discount","pimg");
  $data_values=array("$oid","$qty","$title","$discount","$cost","$actual_discount","$pimg");
  
      $h = new Fixxy();
	   $h->serviceinsertdata_Api($field_values,$data_values,$table);	   
}
if($wal_amt != 0)
	   {
		   $timestamp = date("Y-m-d H:i:s");
		   $service->query("update tbl_user set wallet = wallet-".$wal_amt." where id=".$uid."");
	   $table="wallet_report";
  $field_values=array("uid","message","status","amt","tdate");
  $data_values=array("$uid",'Wallet Used!!','Debit',"$wal_amt","$timestamp");
   
      $h = new Fixxy();
	   $h->serviceinsertdata_Api($field_values,$data_values,$table);
	   }
	   
	   $udata = $service->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
$name = $udata['name'];

	   


$content = array(
       "en" => $name.', Your Order #'.$oid.' Has Been Received.'
   );
$heading = array(
   "en" => "Order Received!!"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid,"type"=>'normal'),
'filters' => array(array('field' => 'tag', 'key' => 'user_id', 'relation' => '=', 'value' => $uid)),
'contents' => $content,
'headings' => $heading
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['one_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
  
  $content = array(
       "en" => 'New Order #'.$oid.' Has Been Received.'
   );
$heading = array(
   "en" => "Order Received!!"
);

$fields = array(
'app_id' => $set['s_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid,"type"=>'normal'),
'filters' => array(array('field' => 'tag', 'key' => 'store_id', 'relation' => '=', 'value' => $vendor_id)),
'contents' => $content,
'headings' => $heading
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['s_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

$timestamp = date("Y-m-d H:i:s");

 $title_mains = "Order Received!!";
$descriptions = 'New Order #'.$oid.' Has Been Received.';

	   $table="tbl_snoti";
  $field_values=array("sid","datetime","title","description");
  $data_values=array("$vendor_id","$timestamp","$title_mains","$descriptions");
  
    $h = new Fixxy();
	   $h->serviceinsertdata_Api($field_values,$data_values,$table);
	   
	   
	   $title_mains = "Order Received!!";
$descriptions = 'New Order #'.$oid.' Has Been Received.';

	   $table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_mains","$descriptions");
  
    $h = new Fixxy();
	   $h->serviceinsertdata_Api($field_values,$data_values,$table);
	   
	$wallet = $service->query("select * from tbl_user where id=".$uid."")->fetch_assoc();   
$returnArr = array("wallet"=>$wallet['wallet'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Placed Successfully!!!","order_id"=>$oid);
}
else 
{
 $tbwallet = $service->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Wallet Balance Not There As Per Order Refresh One Time Screen!!!","wallet"=>$tbwallet['wallet']);	
}
}

echo json_encode($returnArr);