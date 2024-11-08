<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

	$productName 		= $_POST['productName'];
	// $productImage 	= $_POST['productImage'];
	$quantity 			= $_POST['quantity'];
	$rate 					= $_POST['rate'];
	$brandName 			= $_POST['brandName'];
	$productStatus 	= $_POST['productStatus'];
	$serialNumber = $_POST['serialNumber'];

	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type) - 1];
	$url = '../assests/images/stock/' . uniqid(rand()) . '.' . $type;
	if (in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if (is_uploaded_file($_FILES['productImage']['tmp_name'])) {
			if (move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {

				$totalAmount = $quantity * $rate ; 
				$sql = "INSERT INTO stocklink_product (product_name, product_image, brand_id, quantity, rate, active, status,totalAmount) 
				VALUES ('$productName', '$url', '$brandName', '$quantity', '$rate', '$productStatus', 1, '$totalAmount')";

				if ($connect->query($sql) === TRUE) {

					$product_id = $connect->insert_id;

					foreach ($serialNumber as $serialNumberKey => $serialNumberVal) {

						$inventorysql = "INSERT INTO stocklink_inventory(product_id,product_name,serialNumber, availabilityStatus,activityStatus,created_at)
						VALUES('$product_id','$productName','$serialNumberVal','available','Active','$datetime')";

						mysqli_query($connect, $inventorysql);
					}


					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}
			} else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		

	$connect->close();

	echo json_encode($valid);
} // /if $_POST