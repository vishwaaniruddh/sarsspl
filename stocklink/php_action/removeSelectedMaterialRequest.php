<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$matId = $_REQUEST['matId'];

// var_dump($_REQUEST);
if($matId) { 


  $sql = "UPDATE generatefaultymaterialrequestdetails SET materialStatus = 'Deleted' WHERE id = {$matId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST