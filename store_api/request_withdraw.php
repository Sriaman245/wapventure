<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['vendor_id'] == '' or $data['amt'] == '' or $data['r_type'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$vendor_id = $data['vendor_id'];
	$amt = $data['amt'];
	$r_type = $data['r_type'];
	
	$sales  = $service->query("select sum((o_total-(tax+conv_fee)) - (o_total-(tax+conv_fee)) * pcommission/100) as full_total from tbl_order where o_status='Completed'  and  vendor_id=".$vendor_id."")->fetch_assoc();
            $payout =   $service->query("select sum(amt) as full_payout from payout_setting where vendor_id=".$vendor_id."")->fetch_assoc();
                 $bs = 0;
				
				
				 if($sales['full_total'] == ''){}else {$bs = number_format((float)($sales['full_total'])- $payout['full_payout'], 2, '.', ''); }
				 
				 
				 if(floatval($amt) > floatval($set['pstore']))
				 {
					$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"You can't Withdraw Above Your Withdraw Limit!"); 
				 }
				 else if(floatval($amt) > floatval($bs))
				 {
					 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"You can't Withdraw Above Your Earning!"); 
				 }
				 else 
				 {
					 $timestamp = date("Y-m-d H:i:s");
					 $table="payout_setting";
  $field_values=array("vendor_id","amt","status","r_date","r_type");
  $data_values=array("$vendor_id","$amt","pending","$timestamp","$r_type");
  
      $h = new Fixxy();
	  $check = $h->serviceinsertdata_Api_Id($field_values,$data_values,$table);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Payout Request Submit Successfully!!");
				 }
}
echo json_encode($returnArr);
?>