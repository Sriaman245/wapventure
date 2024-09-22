<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
require dirname( dirname(__FILE__) ).'/controller/fixxy.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['title'] == '' or $data['password'] == '' or $data['mobile'] == '' or $data['pid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $title = strip_tags(mysqli_real_escape_string($service,$data['title']));
   
   $mobile = strip_tags(mysqli_real_escape_string($service,$data['mobile']));
     $password = strip_tags(mysqli_real_escape_string($service,$data['password']));
	 $pid =  strip_tags(mysqli_real_escape_string($service,$data['pid']));
$checkimei = $service->query("select * from tbl_partner where  `id`=".$pid."")->num_rows;

if($checkimei == 0)
    {
		     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Not Exist!!!!");  
	}

else 
{	
	   $table="tbl_partner";
  $field = array('title'=>$title,'password'=>$password,'mobile'=>$mobile);
  $where = "where id=".$pid."";
$h = new Fixxy();
	  $check = $h->serviceupdateData_Api($field,$table,$where);
	  
            $c = $service->query("select * from tbl_partner where  `id`=".$pid."")->fetch_assoc();
        $returnArr = array("partnerdata"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Update successfully!");
        
    
	}
    
}

echo json_encode($returnArr);