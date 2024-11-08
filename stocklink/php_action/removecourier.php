<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$courierId = $_REQUEST['courierId'];

// var_dump($_REQUEST);
if($courierId) { 


  $sql = "UPDATE stocklink_courier SET activityStatus = 'Deleted' WHERE id = {$courierId}";

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