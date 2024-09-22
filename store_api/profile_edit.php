<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['title'] == '' or $data['password'] == '' or $data['pid'] == '' or $data['dtime'] == '' or $data['lcode'] == '' or $data['store_charge'] == '' or $data['sdesc'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $title = strip_tags(mysqli_real_escape_string($service,$data['title']));
   
   $dtime = strip_tags(mysqli_real_escape_string($service,$data['dtime']));
   $lcode = strip_tags(mysqli_real_escape_string($service,$data['lcode']));
   $store_charge = strip_tags(mysqli_real_escape_string($service,$data['store_charge']));
     $password = strip_tags(mysqli_real_escape_string($service,$data['password']));
	  $sdesc = strip_tags(mysqli_real_escape_string($service,$data['sdesc']));
	 
$pid =  strip_tags(mysqli_real_escape_string($service,$data['pid']));
$checkimei = $service->query("select * from service_details where  `id`=".$pid."")->num_rows;

if($checkimei == 0)
    {
		     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Not Exist!!!!");  
	}

else 
{	
	   $table="service_details";
  $field = array('title'=>$title,'password'=>$password,'dtime'=>$dtime,'lcode'=>$lcode,'store_charge'=>$store_charge,'sdesc'=>$sdesc);
  $where = "where id=".$pid."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	  
            $c = $service->query("select * from service_details where  `id`=".$pid."")->fetch_assoc();
        $returnArr = array("storedata"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Update successfully!");
        
    
	}
    
}

echo json_encode($returnArr);