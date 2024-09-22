<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['order_id'] == '' or $data['uid'] == '')
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

	$order_id =  $service->real_escape_string($data['order_id']);
	$uid =  $service->real_escape_string($data['uid']);
	$count = $service->query("select * from tbl_order where id=".$order_id." and uid=".$uid."")->num_rows;
	if($count != 0)
	{
  $sel = $service->query("select * from tbl_order where id=".$order_id." and uid=".$uid."")->fetch_assoc(); 
  $g=array();
 
  
	  $vdata = $service->query("select * from service_details where id=".$sel['vendor_id']."")->fetch_assoc();
	  $udata = $service->query("select * from tbl_user where id=".$sel['uid']."")->fetch_assoc();
	  $pdata = $service->query("select * from tbl_payment_list where id=".$sel['p_method_id']."")->fetch_assoc();
      $g['id'] = $sel['id'];
      $g['status'] = $sel['o_status'];
      $g['order_date'] = $sel['odate'];
	  $g['total'] = $sel['o_total'];
	  $g['tax'] = $sel['tax'];
	  $g['subtotal'] = $sel['subtotal'];
	  $g['trans_id'] = $sel['trans_id'];
	  $g['conv_fee'] = $sel['conv_fee'];
	  $g['tip'] = $sel['tip'];
	  $g['cou_id'] = $sel['cou_id'];
	  $g['cou_amt'] = $sel['cou_amt'];
	  $g['wall_amt'] = $sel['wal_amt'];
	  $g['comment_reject'] = $sel['comment_reject'];
	  $g['payment_title'] = $pdata['title'];
	  $g['payment_img'] = $pdata['img'];
	  $g['job_start'] = $sel['job_start'];
	  $g['job_end'] = $sel['job_end'];
	  $g['store_mobile'] = $vdata['mobile'];
	  $g['customer_address'] = $sel['address'];
	   $g['store_name'] = $vdata['title'];
	   $g['is_rate'] = $sel['is_rate'];
	   $g['provider_rate'] = $sel['provider_rate'];
	   $g['provider_text'] = $sel['provider_text'];
	   $g['rider_rate'] = $sel['rider_rate'];
	   $g['rider_text'] = $sel['rider_text'];
	   $g['store_address'] = $vdata['full_address'];
	  $g['order_flow_id'] = $sel['order_status'];
	  $g['lats'] = $sel['lats'];
	  $g['a_status'] = $sel['a_status'];
	  $g['longs'] = $sel['longs'];
	  $g['service_date'] = $sel['date'];
	  $g['service_time'] = $sel['time'];
	  $g['partner_rate'] = 4.5;
	  $g['customer_pmobile'] = $udata['ccode'].$udata['mobile'];
	  $g['distance'] = number_format((float)distance($sel['lats'], $sel['longs'], $vdata['lats'], $vdata['longs'], "K"), 2, '.', '').' Kms';
	  if($sel['rid'] == 0)
		{
		 $g['rider_name'] = '';
		$g['rider_mobile'] = '';	
		$g['rider_img'] = '';	
		}
		else 
		{
			$riderdata = $service->query("select * from tbl_partner where id=".$sel['rid']."")->fetch_assoc();
			$g['rider_name'] = $riderdata['title'];
		$g['rider_mobile'] = $riderdata['mobile'];	
		$g['rider_img'] = $riderdata['img'];	
		}
	   $fetchpro = $service->query("select *  from tbl_order_product where oid=".$sel['id']."");
		$kop = array();
		$pdata = array();
		$total_price = 0;
		$total_discount = 0;
		while($jpro = $fetchpro->fetch_assoc())
		{
			$kop['Product_quantity'] = $jpro['pquantity'];
			$kop['Product_name'] = $jpro['ptitle'];
			$kop['Product_image'] = $jpro['pimg'];
			$kop['Product_discount'] = $jpro['actual_discount'];
			
			$kop['Product_price'] = $jpro['pprice'];
			
			$discount = $jpro['pprice'] * $jpro['actual_discount']*$jpro['pquantity'] /100;
			$total_discount = $total_discount + $discount;
			$kop['Product_total'] = ($jpro['pprice'] * $jpro['pquantity']) - $discount;
			$total_price = $total_price + $kop['Product_total'];
			$pdata[] = $kop;
		}
		$g['total_discount'] = $total_discount;
		$g['Order_Product_Data'] = $pdata;
	  
  
  $returnArr = array("OrderDetails"=>$g,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Details  Get Successfully!!!");
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order Not Found On Your Collections!");    
	}
}
echo json_encode($returnArr);

?>