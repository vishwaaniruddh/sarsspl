<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
	$productId = $_POST['productId'];
	$productName 		= $_POST['editProductName'];
	$quantity 			= $_POST['editQuantity'];
	$rate 					= $_POST['editRate'];
	$brandName 			= $_POST['editBrandName'];
	//   $categoryName 	= $_POST['editCategoryName'];
	$productStatus 	= $_POST['editProductStatus'];

	$totalAmount = $quantity * $rate;
	$sql = "UPDATE stocklink_product SET product_name = '$productName', brand_id = '$brandName', quantity = '$quantity', rate = '$rate', active = '$productStatus', status = 1, totalAmount='$totalAmount' WHERE product_id = $productId ";

	if ($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}
} // /$_POST

$connect->close();

echo json_encode($valid);
