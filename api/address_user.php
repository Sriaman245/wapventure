<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['uid'] == '' or $data['address'] == ''  or $data['houseno']==''   or $data['type'] == '' or $data['lat_map'] == '' or $data['long_map'] == '' or $data['aid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$uid = $data['uid'];
	$address = $data['address'];
	$c_name = $data['c_name'];
	$c_number = $data['c_number'];
	$houseno = $data['houseno'];
	$landmark = $data['landmark'];
	$type = $data['type'];
	$lat_map = $data['lat_map'];
	$long_map = $data['long_map'];
	$aid = $data['aid'];
	
	$count = $service->query("select * from tbl_user where id=".$uid." and status = 1")->num_rows;
	if($count != 0)
	{
	if($aid == 0)
	{
		$counter_address = $service->query("select * from tbl_address where type='".$type."' and uid=".$uid."")->num_rows;
		if($counter_address  != 0)
		{
		$adatas = $service->query("select * from tbl_address where type='".$type."' and uid=".$uid."")->fetch_assoc();
$table="tbl_address";
  $field = array('address'=>$address,'houseno'=>$houseno,'landmark'=>$landmark,'type'=>$type,'lat_map'=>$lat_map,'long_map'=>$long_map,'c_name'=>$c_name,'c_number'=>$c_number);
  $where = "where id=".$adatas['id']."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	  
		}
		else 
		{
	$table="tbl_address";
  $field_values=array("uid","address","houseno","landmark","type","lat_map","long_map","c_name","c_number");
  $data_values=array("$uid","$address","$houseno","$landmark","$type","$lat_map","$long_map","$c_name","$c_number");
  $h = new Fixxy();
  $check = $h->serviceinsertdata_Api($field_values,$data_values,$table);
		}
  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Saved Successfully!!!");
	
	
	}
	else 
	{
		
		$table="tbl_address";
  $field = array('address'=>$address,'houseno'=>$houseno,'landmark'=>$landmark,'type'=>$type,'lat_map'=>$lat_map,'long_map'=>$long_map,'c_name'=>$c_name,'c_number'=>$c_number);
  $where = "where id=".$aid."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	  
		$adata = $service->query("select * from tbl_address where id=".$aid."")->fetch_assoc();
		$p = array();
		$p['id'] = $adata['id'];
		$p['uid'] = $adata['uid'];
		$p['hno'] = $adata['houseno'];
		$p['address'] = $adata['address'];
		$p['c_name'] = $adata['c_name'];
		$p['c_number'] = $adata['c_number'];
		$p['lat_map'] = $adata['lat_map'];
		$p['long_map'] = $adata['long_map'];
		$p['landmark'] = $adata['landmark'];
		$p['type'] = $adata['type'];
		
		$returnArr = array("AddressData"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address Updated Successfully!!!");

	}
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Either Not Exit OR Deactivated From Admin!");
	}
}
echo  json_encode($returnArr);
