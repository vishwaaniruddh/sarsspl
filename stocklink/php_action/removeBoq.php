<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$boqId = $_REQUEST['boqId'];

// var_dump($_REQUEST);
if($boqId) { 


  $sql = "UPDATE stocklink_boq SET status = 'Deleted' WHERE id = {$boqId}";

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