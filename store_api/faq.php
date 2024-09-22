<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['vendor_id'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $vendor_id = strip_tags(mysqli_real_escape_string($service,$data['vendor_id']));
    
    
$check = $service->query("select * from tbl_faq where status=1");
$op = array();
while($row = $check->fetch_assoc())
{
		$op[] = $row;
}
$returnArr = array("FaqData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Faq List Get Successfully!!");
}
echo json_encode($returnArr);