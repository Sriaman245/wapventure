<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';

header('Content-type: text/json');
$sel = $service->query("select * from tbl_code");
$myarray = array();
while($row = $sel->fetch_assoc())
{
			$myarray[] = $row;
}
$returnArr = array("CountryCode"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Country Code List Founded!");
echo json_encode($returnArr);
?>