<?php
require_once 'core.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$sql = "SELECT product.id, product.product_name, product.serialNumber, product.availabilityStatus
        FROM stocklink_inventory product 
		WHERE product.activityStatus = 'Active'";




// echo $sql ; 
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {

	// $row = $result->fetch_array();
	$active = "";

	while ($row = $result->fetch_assoc()) {
		$productId = $row['id'];
		$product_name = $row['product_name'];
		$serialNumber = $row['serialNumber'];
		$availabilityStatus = $row['availabilityStatus'];

		// active 
		if ($availabilityStatus == 'available') {
			// activate member
			$active = "<label class='label label-success'>Available</label>";
		} else {
			$active = "<label class='label label-danger'>Not Available</label>";
		} // /else



		

		$output['data'][] = array(
			$product_name,
			$serialNumber,
            $active
		);
	} // /while 

} // if num_rows

$connect->close();

echo json_encode($output);
