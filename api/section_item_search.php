<?php 
require dirname( dirname(__FILE__) ).'/controller/serviceconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
$keyword = $data['keyword'];
$section_id = $data['section_id'];
if($section_id == '' or $keyword == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$sec = array();
	$list = array();
$section = $service->query("select * from tbl_section where status=1")->fetch_assoc();
	$sec['section_id'] = $section['id'];
	$sec['cat_id'] = $section['cat_id'];
	$sec['section_title'] = $section['title'];
	$item = $service->query("select * from section_item where status=1 and section_id=".$section_id." and title COLLATE utf8_general_ci like '%".$keyword."%'");
	$lo = array();
	$po = array();
	while($ko = $item->fetch_assoc())
	{
		$lo['item_title'] = $ko['title'];
		$lo['item_img'] = $ko['img'];
		$po[] = $lo;
	}
	$sec['item_list'] = $po;
	$list[] = $sec;
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Item Data Get Successfully!","ItemData"=>$list);
}
echo json_encode($returnArr);
?>