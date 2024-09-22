<?php 
require 'serviceconfig.php';
$GLOBALS['service'] = $service;
class Fixxy {
 

	function servicelogin($username,$password,$tblname) {
		
		if($tblname == 'admin')
		{
		$q = "select * from ".$tblname." where username='".$username."' and password='".$password."'";
	return $GLOBALS['service']->query($q)->num_rows;
		}
		else 
		{
			$q = "select * from ".$tblname." where email='".$username."' and password='".$password."'";
	return $GLOBALS['service']->query($q)->num_rows;
		}
		
	}
	
	function serviceinsertdata($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['service']->query($sql);
  return $result;
  }
  
  

  
  function insmulti($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['service']->multi_query($sql);
  return $result;
  }
  
  function serviceinsertdata_id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['service']->query($sql);
  return $GLOBALS['service']->insert_id;
  }
  
  function serviceinsertdata_Api($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['service']->query($sql);
  return $result;
  }
  
  function serviceinsertdata_Api_Id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['service']->query($sql);
  return $GLOBALS['service']->insert_id;
  }
  
  function serviceupdateData($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
			
           $cols[] = "$key = '$val'"; 
			
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['service']->query($sql);
    return $result;
  }
  
  
 
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['service']->query($sql);
    return $result;
  }
  
   function serviceupdateData_Api($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
           $cols[] = "$key = '$val'"; 
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['service']->query($sql);
    return $result;
  }
  
  
  
  
  function serviceupdateData_single($field,$table,$where){
$query = "UPDATE $table SET $field";

$sql =  $query.' '.$where;
$result=$GLOBALS['service']->query($sql);
  return $result;
  }
  
  function serviceDeleteData($where,$table){

    $sql = "Delete From $table $where";
    $result=$GLOBALS['service']->query($sql);
  return $result;
  }
  
  function serviceDeleteData_Api($where,$table){

    $sql = "Delete From $table $where";
    $result=$GLOBALS['service']->query($sql);
  return $result;
  }
 
}
?>