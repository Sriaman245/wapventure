<?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['email'] == ''  or $data['password'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $email = strip_tags(mysqli_real_escape_string($service,$data['email']));
    $password = strip_tags(mysqli_real_escape_string($service,$data['password']));
    
$chek = $service->query("select * from service_details where  email='".$email."' and status = 1 and password='".$password."'");
$status = $service->query("select * from service_details where status = 1");
if($status->num_rows !=0)
{
if($chek->num_rows != 0)
{
    $c = $service->query("select * from service_details where  email='".$email."'  and status = 1 and password='".$password."'")->fetch_assoc();
    
    $returnArr = array("storedata"=>$c,"currency"=>$set['currency'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Login successfully!");
}
else
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Invalid Email Address or Password!!!");
}
}
else  
{
	 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Your Status Deactivate!!!");
}
}

echo json_encode($returnArr);